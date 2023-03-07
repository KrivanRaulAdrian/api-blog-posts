<?php

use DI\Container;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Doctrine\UuidType;
use Api\Repository\PostsRepository;
use Api\Repository\CategoriesRepository;
use Api\Repository\PostsRepositoryFromDoctrine;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Api\Repository\CategoriesRepositoryFromDoctrine;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Level;

$container = new Container();

$container->set('settings', require __DIR__ . '/doctrine-settings.php');

$container->set(PostsRepository::class, static function (Container $container) {
    $entityManager = $container->get(EntityManager::class);
    return new PostsRepositoryFromDoctrine($entityManager);
});
$container->set(CategoriesRepository::class, static function (Container $container) {
    $entityManager = $container->get(EntityManager::class);
    return new CategoriesRepositoryFromDoctrine($entityManager);
});

$container->set(EntityManager::class,  function (Container $c): EntityManager {
    /** @var array $settings */
    $settings = $c->get('settings');

    // Use the ArrayAdapter or the FilesystemAdapter depending on the value of the 'dev_mode' setting
    // You can substitute the FilesystemAdapter for any other cache you prefer from the symfony/cache library
    $cache = $settings['doctrine']['dev_mode'] ?
        DoctrineProvider::wrap(new ArrayAdapter()) :
        DoctrineProvider::wrap(new FilesystemAdapter(directory: $settings['doctrine']['cache_dir']));

    Type::addType(UuidType::NAME, UuidType::class);

    $config = Setup::createAttributeMetadataConfiguration(
        $settings['doctrine']['metadata_dirs'],
        $settings['doctrine']['dev_mode'],
        null,
        $cache
    );

    return EntityManager::create($settings['doctrine']['connection'], $config);
});

$container->set('logger', function () {
    $logger = new Logger('api');
    $logger->pushHandler(new StreamHandler(__DIR__ . '/../data/logs/error.log', level::Error));
    $logger->pushHandler(new StreamHandler(__DIR__ . '/../data/logs/debug.log', level::Debug));
    return $logger;
});

return $container;
