
## Description




## How to install


##1.0 Mac OS:


* Install Xammp Server.
 * run xammp, start mysql and apache server
 * Go to browser to verify localhost. If its show something, we are done with the server setup.
* Go to its htdocs, clone the project from github.
* Install composer into your system. [Composer Guide Link] (https://duvien.com/blog/installing-composer-mac-osx).
* After Installing Composer, go to project directory and write the following commands by opening terminal into current direcotry.

```
sudo composer update
sudo composer install
```

After Successfull installation, write the following commands.

```
php artisan config:clear
php artisan config:cache
```

to run above commands php must be installed on your system.

* Now you have to make a copy of .env.example to .env and fill the database credentials. after that generate your key, php artisan key:generate

* run the following command now:

```
php artisan migrate
```

it will deploy the database schema.


* Now type: 

```
php artisan serve
```

click the link that will show into the terminal, you all done.

Note: In Mac OS, it require additional permissions, if you get permission denied error, then type in terminal(in project directory).

```
sudo chmod -R 777 storage
```


##2.0 For windows

* Install Xammp Server.
 * run xammp, start mysql and apache server
 * 1.2 Go to browser to verify localhost. If its show something, we are done with the server setup.
* Go to its htdocs, clone the project from github.
* Install composer into your system.
* After Installing Composer, go to project directory and write the following commands by opening terminal into current direcotry.

```
 composer update
 composer install
```

After Successfull installation, write the following commands.

```
php artisan config:clear
php artisan config:cache
```

to run above commands php must be installed on your system.

* Now you have to make a copy of .env.example to .env and fill the database credentials.

* run the following command now:

```
php artisan migrate
```

it will deploy the database schema.


* Now type: 

```
php artisan serve
```
