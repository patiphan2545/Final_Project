# Laravel 9 AdminLTE 3 - Admin Dashboard Template with CRUD

<span style="color:blue;">**Versions**</span>
- Laravel v9.19.0 
- AdminLTE-3.2.0
- Bootstrap 4

<span style="color:red;">*PHP v8.1 Required*</span>

## Features
**Admin LTE** - AdminLTE is a fully responsive administration template. Based on Bootstrap 4.6 framework and also the JS/jQuery plugin. Highly customizable and easy to use. Fits many screen resolutions from small mobile devices to large desktops.


**Posts CRUD** - Posts can be created, read, updated, deleted, published or unpublished using this installation. Posts include a post name, content and an image.

##### Installation
1. Clone this repository
````sh
gh repo clone kiguta/Laravel9AdminLTE_adminTemplate
````

2. Add Database Configuration
Rename the ***.env.example*** file to ***.env***

3. Install Dependencies
````sh
$ composer install
````

4. Create your database and user. Enter details on the .env details below
```php
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

5. Run Migration
````sh
$ php artisan migrate
````

6. Run Seeds
````sh
$ php artisan db:seed
````

7. To send email, adjust your **.env** mail settings below
```php
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
```

8. Run Server
````sh
$ php artisan serve
````

Your application will be ready to use

**User**
***Email: user@gmail.com
Password: 12345***
