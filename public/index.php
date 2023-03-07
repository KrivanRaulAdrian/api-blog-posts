<?php

use Slim\Factory\AppFactory;
use Api\Controller\HomeController;
use Api\Controller\GetByIdController;
use Api\Controller\OpenApiController;
use Api\Middleware\CustomErrorHandler;
use Api\Controller\GetBySlugController;
use Api\Controller\DeletePostsController;
use Api\Controller\GetAllPostsController;
use Api\Controller\UpdatePostsController;
use Tuupola\Middleware\JwtAuthentication;
use Api\Controller\GetCategoryByIdController;
use Api\Controller\CreateCategoriesController;
use Api\Controller\DeleteCategoriesController;
use Api\Controller\GenerateJwtTokenController;
use Api\Controller\GetAllCategoriesController;
use Api\Controller\UpdateCategoriesController;
use Api\Controller\CreatePostsCategoriesController;

require __DIR__ . '/../bootstrap.php';

$container = require __DIR__ . '/../config/container.php';

$authMiddleware = new JwtAuthentication([
    'secret' => $container->get('settings')['jwt_secret']
]);

AppFactory::setContainer($container);

$app = AppFactory::create();

$customErrorHandler = new CustomErrorHandler($app);

$app->post('/jwt', new GenerateJwtTokenController($container));
$app->get('/v1/posts/all', new GetAllPostsController($container));
$app->get('/v1/posts/getSlug/{slug}', new GetBySlugController($container));
$app->get('/post-docs', fn () => file_get_contents(__DIR__ . '/post-docs/index.html'));
$app->get('/', HomeController::class);
$app->get('/openapi', OpenApiController::class);
$app->post('/v1/posts/create', new CreatePostsCategoriesController($container))->add($authMiddleware);
$app->get('/v1/posts/{id}', new GetByIdController($container));
$app->delete('/v1/posts/{id}', new DeletePostsController($container))->add($authMiddleware);
$app->put('/v1/posts/{id}', new UpdatePostsController($container))->add($authMiddleware);
$app->post('/v1/categories/create', new CreateCategoriesController($container));
$app->get('/v1/categories/all', new GetAllCategoriesController($container));
$app->get('/v1/categories/{id}', new GetCategoryByIdController($container));
$app->delete('/v1/categories/{id}', new DeleteCategoriesController($container));
$app->put('/v1/categories/{id}', new UpdateCategoriesController($container));

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

$app->run();
