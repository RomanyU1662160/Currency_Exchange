# Currency Converter

## Built With

- [Laravel](https://laravel.com/) - The PHP framework for building the API endpoints needed for the application
- [Vue](https://vuejs.org/) - The Progressive JavaScript Framework for building interactive interfaces
- The application consumes  the  [Floatrate API ](http://www.floatrates.com/)  to get the data.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software.

- Git.
- PHP.
- Composer.
- Laravel CLI.
- A webserver like Nginx or Apache.
- A Node Package Manager ( npm or yarn ).

### Install

Clone the git repository on your computer

```
$ git clone https://github.com/RomanyU1662160/Currency_Exchange.git
```

You can also download the entire repository as a zip file and unpack in on your computer if you do not have git

After cloning the application, you need to install it's dependencies.

```
$ cd currency_exchange
$ composer install
```

### Setup

- When you are done with installation, copy the `.env.example` file to `.env`

  `$ cp .env.example .env`

- Generate the application key

  `$ php artisan key:generate`

- No need to config the DB (application get data from the API)

- Install node modules

  `$ npm install`

### Run the application

```
$ php artisan serve
```



## Acknowledgments

- [Laravel](https://laravel.com/) - The excellent documentation explaining how to get started with Laravel and Laravel Passport made it easy to provide a step by step guide for beginners to follow the application
- [Vue](https://vuejs.org/) - Concise documentation
- [FloatRates](http://www.floatrates.com/)   Currency exchange rates provider 

