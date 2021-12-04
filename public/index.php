<?php

use App\Controller\HomeController;
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$container->set(Twig::class, Twig::create(__DIR__ . '/../templates', ['cache' => false]));
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/', HomeController::class);

$app->run();
