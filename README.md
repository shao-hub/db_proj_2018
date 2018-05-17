# db_proj_2018

Apache2 mod_rewrite must be enabled. <br>
See the below link for how to enable it on Ubuntu 16.04.<br>
https://www.digitalocean.com/community/tutorials/how-to-rewrite-urls-with-mod_rewrite-for-apache-on-ubuntu-16-04 

Install the database by `_install/db_install.sql`

<h2>accounts (id,passowrd,name) :</h2>
admin account: (777,123456,root)

other accounts: (0400000,0400000,ZERO) (0400001,0400001,ONE)

File `application/config/config.php` is no longer tracked. Please copy `application/config/config_example.php` into `application/config/config.php` and change MySQL username and password in copied file.
