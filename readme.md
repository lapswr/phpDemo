# phpDemo

The project was build using [Laravel]  5.6 Framework which is the framework of my choice and using it the past 2 years developing projects for my work. It offers great tools out of the box and also it's offering great extensibility with many libraries making a laravel version.

## Installation

The Project needs the following requirements to run :

* PHP >= 7.0.0
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Composer Dependency Manager

Install the dependencies by issuing issuing the Composer command in your terminal in the project folder:

```sh
composer install
```

Install the sqlite migrations by issuing this command in your terminal:

```sh
php artisan migrate
```

Seed the slqite with the json file by issuing this command in your terminal:

```sh
php artisan db:seed
```

And you can also generate more recipes in the database with this command:

```sh
php artisan db:seed --class=RecipesTableSeeder
```


###Serve
Optional if you don't have a local server, this command will start a development server at http://localhost:8000:

```sh
php artisan serve
```

###Test 
All the test related files are in the test folder.
The tests are auto migrating an SQLite database in memory and seedthe json test data in it (all the migration and feed files can be found in the database folder).

To run the Unit tests issue this command :

```sh
 ./vendor/bin/phpunit
```

### Api Routes
- Returns a total price for the basket provided in the request data, Also implement the meal deal based on the product categories.
#####Request Url
```sh
POST http://localhost:8000/api/totals
```
#####Request Headers
```sh
Content-Type: application/json
Accept: application/json
```
#####Request Data
```sh
{
  "products": [
    {
      "product_id": 1,
      "qty": 1
    },
    {
      "product_id": 2,
      "qty": 1
    },
    {
      "product_id": 3,
      "qty": 1
    }
  ]
}
```
#####Response
```sh
{
  "total": 6.5
}
```

## Further reading

In the near future I'm planing to use another php framework [Apiato] , based on the core of [Laravel], which is more api centric and it goes beyond the classic MVC Model by using [Porto] Software Architectural Pattern.

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen.)
   [Laravel]: <https://laravel.com>
   [Apiato]: <https://github.com/apiato/apiato>
   [Porto]: <https://github.com/Mahmoudz/Porto>
