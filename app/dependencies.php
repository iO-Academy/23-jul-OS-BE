<?php
declare(strict_types=1);

use CaterpillarOS\Factories\LoggerFactory;
use CaterpillarOS\Factories\PDOFactory;
use CaterpillarOS\Factories\RendererFactory;
use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

return function (ContainerBuilder $containerBuilder) {
    $container = [];

    $container[LoggerInterface::class] = DI\factory(LoggerFactory::class);
    $container[PhpRenderer::class] = DI\factory(RendererFactory::class);
    $container[PDO::class] = DI\factory(PDOFactory::class);
    $containerBuilder->addDefinitions($container);
};
