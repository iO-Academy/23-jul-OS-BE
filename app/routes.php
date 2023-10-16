<?php
declare(strict_types=1);

use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/users', \CaterpillarOS\Controllers\GetUsersController::class);
    $app->get('/users/{userId}', \CaterpillarOS\Controllers\GetUserController::class);
    $app->post('/checkPassword', \CaterpillarOS\Controllers\CheckPasswordController::class);
};
