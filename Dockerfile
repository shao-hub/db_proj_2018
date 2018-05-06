FROM alpine:latest
MAINTAINER hare1039 hare39393@gmail.com

RUN apk update && apk add --no-cache \
    curl                             \
    php7 php7-intl php7-openssl php7-dba php7-sqlite3 php7-common php7-oauth php7-fpm php7-mysqlnd php7-fileinfo php7-json php7-iconv php7-curl php7-phar php7-ssh2 php7-mysqli php7-gd php7-zlib php7-opcache

RUN curl -o caddy.tar.gz https://caddyserver.com/download/linux/amd64?license=personal ;\
    tar zxf caddy.tar.gz                                                               ;\
    rm caddy.tar.gz *.txt

RUN sh -c 'echo -e ":80 :443 { \n root /src \n fastcgi / 127.0.0.1:9000 php \n errors stdout \n log stdout\n }" > /Caddyfile'
WORKDIR /src

RUN sh -c 'echo -e "php-fpm7 --allow-to-run-as-root; /caddy -conf /Caddyfile;" > /run.sh'; \
    chmod +x /run.sh

ENTRYPOINT ["sh", "-c", "/run.sh"]