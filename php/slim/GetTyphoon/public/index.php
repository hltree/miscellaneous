<?php
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

AppFactory::setContainer($container);

$container->set('view', function() {
    return new Twig('./templates'/*, ['cache' => './cache']*/);
});

$app = AppFactory::create();
$app->add(TwigMiddleware::createFromContainer($app));

require __DIR__ . '/../app/routes.php';
$app->run();
