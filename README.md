[![Continuous Integration](https://github.com/KrivanRaulAdrian/Doctrine-API-project/actions/workflows/continuous-integration.yml/badge.svg)](https://github.com/KrivanRaulAdrian/Doctrine-API-project/actions/workflows/continuous-integration.yml)

<p align="center">
  <img align="center" height="200" src=" public/elephpant.png">
</p>

<h1 align="center">Module 5 API Project</h1>

<p align="center">
An API that lets the user create posts, categories, and posts categories. The API is using the full OOP paradigms. Also this API is having routes to create, read, update, and delete posts and create, read, update, and delete categories.
</p>

## Design Patterns

The design patterns used in this project are:

- Model-View-Controller (MVC)
- Repository
- Dependency Injection
- Fluent Interface

## App Routes

## Home

- [GET] /

## OpenApi

- [GET] /openapi

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
