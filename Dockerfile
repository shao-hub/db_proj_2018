FROM ubuntu:16.04

ENV HOST=":80 :443"

RUN apt-get update && apt-get install -y \
    curl apache2 php-common libapache2-mod-php php-mcrypt php-mysql

RUN sed -i 's/<VirtualHost [*]:80>/<VirtualHost *:8080>/g' /etc/apache2/sites-available/000-default.conf; \
    sed -i 's/Listen 80/Listen 8080/g' /etc/apache2/ports.conf;  \
    sed	-i 's/Listen 443/Listen 4443/g' /etc/apache2/ports.conf; \
    sed -i 's/index.html index.cgi index.pl index.php index.xhtml index.htm/index.php index.html index.cgi index.pl index.xhtml index.htm/g' /etc/apache2/mods-enabled/dir.conf; \
    a2enmod rewrite;

RUN rm -rf /var/www/html && ln -s /html /var/www;

RUN curl https://getcaddy.com | bash -s personal;

RUN sh -c "echo \"${HOST} { \n proxy / localhost:8080 { \n transparent \n } \n errors stdout \n log stdout\n }\" > /Caddyfile"

EXPOSE 80 443
VOLUME ["/root/.caddy", "/html"]
WORKDIR /html
RUN sh -c 'echo "service apache2 restart; caddy -conf /Caddyfile;" > /run.sh'; \
    chmod +x /run.sh

ENTRYPOINT ["sh", "-c", "/run.sh"]
