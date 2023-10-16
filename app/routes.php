<?php
declare(strict_types=1);

use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use CaterpillarOS\Controllers\GetUsersController;
use CaterpillarOS\Controllers\GetUserController;

return function (App $app) {
    $app->get('/users',\CaterpillarOS\Controllers\GetUsersController::class);
    $app->get('/user/{userId}',\CaterpillarOS\Controllers\GetUserController::class);

};
