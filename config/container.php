<?php

use DI\Container;
use Api\Repository\PostsRepository;
use Api\Repository\CategoriesRepository;
use Api\Repository\PostsRepositoryFromPdo;
use Api\Repository\PostsCategoriesRepository;
use Api\Repository\CategoriesRepositoryFromPdo;
use Api\Repository\PostsCategoriesRepositoryFromPdo;

$container = new Container();

$container->set('settings', static function () {
    return [
        'app' => [
            'domain' => $_ENV['APP_URL'],
        ],
        'db' => [
            'host' => $_ENV['DB_HOST'],
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'pass' => $_ENV['DB_PASS'],
        ]
    ];
});

$container->set('db', static function (Container $container) {
    $db = $container->get('settings')['db'];
    $pdo = new PDO(
        'mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'],
        $db['pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
});

$container->set(PostsRepository::class, static function (Container $container) {
    $pdo = $container->get('db');
    return new PostsRepositoryFromPdo($pdo);
});
$container->set(CategoriesRepository::class, static function (Container $container) {
    $pdo = $container->get('db');
    return new CategoriesRepositoryFromPdo($pdo);
});
$container->set(PostsCategoriesRepository::class, static function (Container $container) {
    $pdo = $container->get('db');
    return new PostsCategoriesRepositoryFromPdo($pdo);
});

return $container;
