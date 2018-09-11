### Fight for Kidz

_The new website for Fight for kids, developed in PHP using the Laravel framework. - Developed by BIT Year 2 students at SIT._

* [Click here to submit a bug report](https://github.com/samuelgrant/fight4kidz/issues/new/choose) or request a feature. A github account is required.

* [View the wiki for our developers documentation](https://github.com/samuelgrant/fight4kidz/wiki/Developers-Wiki)
#### Installation 
This application is intended for the private use by Fight For Kidz. For more information please contact [Samuel Grant](mailto:samueljegrant@outlook.com)

##### Installation Requirements
_While we recommend that this application is deployed on a Linux, Apache, Mysql & PHP (LAMP) stack, this application may be deployed on any system so long as the following requirements are met_.

**Software**
- PHP 7.1
- Apache 2 
- MySQL
- [Composer](https://getcomposer.org/)

**Hardware**
- 1Ghz CPU 
- 2GB Memory
- 10GB HDD Space

_Hosting can be purchased at [Digital Ocean](https://www.digitalocean.com/) or [GoDaddy](https://nz.godaddy.com/)._

##### Installation Instructions
1. ``cd /var/www/``
2. ``git clone https://github.com/samuelgrant/fight4kidz``
3. ``composer install``
4. `` cp .env.example .env``
5. ``php artisan key:generate``
6. Fill out the .env file
	- Register a Google Invisible reCAPTCHA account [here](https://www.google.com/recaptcha/admin#list)
7. Create an Apache Virtual Hosts file. You can use the example below to test your site, but check that you update the DocumentRoot. When you publish this site to production please create a full virtual hosts file. _Refer to [Apache2 Documentation](https://httpd.apache.org/docs/2.4/vhosts/)_. Then restart apache2.
```
<VirtualHost *:80>
	ServerAdmin caitlin@viliana.space
	DocumentRoot "/var/www/fight4kidz/public"
	ServerName f4k.localhost
</VirtualHost>
```
8. Execute the following command: `php artisan migrate`

___Database Notice:__ Please create a new MySQL user __DO NOT USE ROOT__. Grant that user the following privileges_:
- Data: `SELECT, INSERT, UPDATE, DELETE, FILE`
- Structure: `CREATE, ALTER, INDEX, DROP, CREATE TEMPORARY TABLES, CREATE ROUTINE, ALTER ROUTINE, EXECUTE, EVENT, TRIGER`
###### Final Things
Please secure your site with an SSL certificate. You can get a free certificate using [Certbot](https://certbot.eff.org/lets-encrypt/ubuntuartful-apache) from Let's Encrypt.

**Windows Users**: To create the required symbolic link run the command `php artisan storage:link`.