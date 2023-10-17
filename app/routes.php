<?php
declare(strict_types=1);

use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });


    $app->get('/users[/]', \CaterpillarOS\Controllers\GetUsersController::class);
    $app->get('/users/{userId}', \CaterpillarOS\Controllers\GetUserController::class);
    $app->post('/checkPassword', \CaterpillarOS\Controllers\CheckPasswordController::class);
};
