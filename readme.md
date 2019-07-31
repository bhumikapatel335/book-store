# Book Store
 It is book store PHP Laravel api to manage book information.

## Prerequisites

You will need the following things properly installed on your computer.

* [Git](http://git-scm.com/)
* [PHP](https://www.php.net/downloads.php) 
* [MySQL](https://dev.mysql.com/downloads/mysql/)
* [Composer](https://getcomposer.org/download/)
* [Laravel](https://laravel.com/docs/5.8/installation)
* [Postman](https://www.getpostman.com/downloads/)

## Installation

* `git clone <repository-url>` this repository
* Change into the new directory
* Run `composer global require laravel/installer` on terminal to install laravel
* Enter correct MYSQL DB information to .env file
* Create `bookstore` datbase in MySQL
* Run `php artisan migrate` on terminal to migrate DB tables

## Running

* Run `php artisan serve` to start api

## Testing

* Import file 'book-store-api-testing.postman_collection' to Postman
* Run test cases
