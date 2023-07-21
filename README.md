[![Continuous Integration](https://github.com/KrivanRaulAdrian/Doctrine-API-project/actions/workflows/continuous-integration.yml/badge.svg)](https://github.com/KrivanRaulAdrian/Doctrine-API-project/actions/workflows/continuous-integration.yml)

<p align="center">
  <img align="center" height="200" src="public/elephpant.png">
</p>

<h1 align="center">API Blog Posts</h1>

<p align="center">
An API that lets the user create posts, categories, and posts categories. The API is using the full OOP paradigms. Also this API is having routes to create, read, update, and delete posts and create, read, update, and delete categories.
</p>

## Design Patterns

The design patterns used in this project are:

- Model-View-Controller (MVC)
- Repository
- Dependency Injection (DI)
- Fluent Interface

## Model-View-Controller (MVC)

MVC, which stands for Model-View-Controller, is a design pattern commonly used in software engineering. It is used to separate the concerns of an application into three interconnected components: the model, the view, and the controller.

The Model represents the data and business logic of the application. It is responsible for managing the data, processing requests, and providing information to the View.

The View is responsible for rendering the data to the user. It receives input from the user, and sends it to the Controller for processing.

The Controller acts as an intermediary between the Model and the View. It receives input from the View, processes it, and sends commands to the Model to update the data or perform actions. It then sends the updated data to the View for rendering.

The MVC pattern allows for modular development, where each component can be developed and tested independently. It also promotes separation of concerns, making it easier to maintain and update the application.

## Repository

The Repository pattern is a design pattern commonly used in software engineering that provides a way to manage data storage and retrieval in a clean and modular way.

The basic idea behind the Repository pattern is to create an interface that abstracts away the details of data storage, and provides a standardized way for other parts of the application to interact with that data. This interface is implemented by a concrete repository class, which handles the actual storage and retrieval of data from the underlying data store, such as a database or file system.

Using the Repository pattern can help to decouple the application logic from the details of the data storage mechanism, making it easier to change the underlying storage implementation without affecting other parts of the application. It also promotes code reuse, as the repository can be used by multiple parts of the application to access the same data in a consistent way.

Overall, the Repository pattern is a powerful tool for managing data storage and retrieval in a clean and modular way, and is widely used in software engineering today.

## Dependency Injection (DI)

Dependency Injection (DI) is a design pattern that is used to achieve loosely coupled software components in object-oriented programming. It allows for the creation of reusable and maintainable code by reducing the dependency of a class on other classes and their concrete implementations.

In DI, the dependencies of an object are passed in as parameters to its constructor or through setters or interface methods. This way, the object does not need to know how to create its dependencies or even what those dependencies are. Instead, the dependencies are injected into the object from the outside, making the code more modular and easier to test.

The benefits of Dependency Injection include improved code maintainability, increased flexibility, and better testability. It also enables the use of interfaces and abstractions, which promotes the use of polymorphism, and makes the code more decoupled and easier to extend.

Dependency Injection is widely used in modern software development, especially in the context of frameworks such as Spring or Angular, where it is used extensively to manage the creation and configuration of objects.

## Fluent Interface

Fluent Interface is a design pattern used in object-oriented programming that allows for a more readable and intuitive API for constructing objects or calling methods. It is also known as a method chaining pattern.

In a Fluent Interface, a series of method calls are chained together in a single statement, with each method returning the object itself or a modified version of it. This allows for a more natural and readable syntax, as the method calls can be read like a sentence or a list of instructions.

Fluent Interfaces are commonly used in libraries and frameworks that provide APIs for building complex objects or executing multiple steps in a sequence. They can improve code readability and reduce errors by making the API more intuitive and easier to understand.

However, Fluent Interfaces can also make the code more complex and harder to debug, especially if the chain of method calls is too long or too nested. Careful design and testing are required to ensure that the Fluent Interface is both readable and maintainable.

## App Routes

## Home

- [GET] /

## OpenApi

- [GET] /openapi

## JWT

- [POST] /jwt

## Posts

- [POST] /v1/posts/create
- [GET] /v1/posts/all
- [GET] /v1/posts/{id}
- [GET] /v1/posts/getSlug/{slug}
- [PUT] /v1/posts/{id}
- [DELETE] /v1/posts/{id}

## Categories

- [POST] /v1/categories/create
- [GET] /v1/categories/all
- [GET] /v1/categories/{id}
- [PUT] /v1/categories/{id}
- [DELETE] /v1/categories/{id}

## Instructions for installation

- Clone repository: `git clone git@github.com:KrivanRaulAdrian/Doctrine-API-project.git`
- Create the database: `project_doctrine`
- Create the tables: `php vendor/bin/doctrine orm:schema-tool:create`
- Install the composer dependencies: `composer install`
- Configure the environment: `cp .env.example .env`
- Add your configuration to the `.env` file
- Run the application in your preferred localhost: `php -S localhost:8000 -t public`
- Run the static analysis with PHPStan: `php vendor/bin/phpstan` at least one path must be specified to analyse, example `php vendor/bin/phpstan analyze -l 1-9 src`
- Check the code style with PHPCodeSniffer: `php vendor/bin/phpcs vendor/bin/phpcs src/ --standard=psr12`
- Fix the code style with PHPCodeSniffer: `php vendor/bin/phpcbf vendor/bin/phpcs src/ --standard=psr12`
- Run the unit tests with PHPUnit: `./vendor/bin/phpunit test/ --colors `

## Required framework and packages

- Slim Framework: `composer require slim/slim:"4.*"`,
  `composer require slim/psr7`,
  `composer require nyholm/psr7 nyholm/psr7-server`,
  `composer require guzzlehttp/psr7 "^2"`,
  `composer require laminas/laminas-diactoros`,
  `composer require php-di/slim-bridge`
- Ramsey Uuid: `composer require ramsey/uuid`
- Ramsey Uuid/Doctrine: `composer require ramsey/uuid-doctrine`
- Dotenv: `composer require vlucas/phpdotenv`
- Swagger: `composer require zircote/swagger-php`
- Slugify: `composer require cocur/slugify`
- Monolog: `composer require monolog/monolog`
- JWT: `composer require firebase/php-jwt`
- Optionally, install the paragonie/sodium_compat package from composer if your php is < 7.2 or does not have libsodium installed: `composer require paragonie/sodium_compat`
- Doctrine ORM: `composer require doctrine/orm`
- Doctrine Annotations: `composer require doctrine/annotations`
- Symfony Cache: `composer require symfony/cache`
- PHP Stan: `composer require --dev phpstan/phpstan`
- PHP Code Sniffer: `composer require squizlabs/php_codesniffer` - it will recognize that it needs to be added in the require dev
- PHP Unit: `composer require --dev phpunit/phpunit ^9`
