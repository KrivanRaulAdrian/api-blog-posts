<?php

use Slim\Factory\AppFactory;
use Api\Controller\HomeController;
use Api\Controller\GetByIdController;
use Api\Controller\OpenApiController;
use Api\Controller\CreatePostsController;
use Api\Controller\DeletePostsController;
use Api\Controller\GetAllPostsController;
use Api\Controller\UpdatePostsController;
use Api\Controller\GetCategoryByIdController;
use Api\Controller\CreateCategoriesController;
use Api\Controller\DeleteCategoriesController;
use Api\Controller\GetAllCategoriesController;
use Api\Controller\UpdateCategoriesController;

require __DIR__ . '/../boot.php';

$container = require __DIR__ . '/../config/container.php';

$app = AppFactory::create();

$app->get('/post-docs', fn () => file_get_contents(__DIR__ . '/post-docs/index.html'));
$app->get('/', HomeController::class);
$app->get('/openapi', OpenApiController::class);
$app->post('/v1/posts/create', new CreatePostsController($container));
$app->get('/v1/posts/all', new GetAllPostsController($container));
$app->get('/v1/posts/{post_id}', new GetByIdController($container));
$app->delete('/v1/posts/{post_id}', new DeletePostsController($container));
$app->put('/v1/posts/{post_id}', new UpdatePostsController($container));
$app->post('/v1/categories/create', new CreateCategoriesController($container));
$app->get('/v1/categories/all', new GetAllCategoriesController($container));
$app->get('/v1/categories/{category_id}', new GetCategoryByIdController($container));
$app->delete('/v1/categories/{category_id}', new DeleteCategoriesController($container));
$app->put('/v1/categories/{category_id}', new UpdateCategoriesController($container));

$app->addErrorMiddleware(true, true, true);

$app->run();
