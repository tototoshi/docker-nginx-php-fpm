<?php

use App\Controller\HomeController;
use App\DB\ConnectionFactory;
use App\DB\MySQLInformationDao;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);
$connectionFactory = new ConnectionFactory(
    'mysql:host=mysql;dbname=example',
    'my_user',
    'my_password',
);

$app = AppFactory::create();

$app->get('/', new HomeController($connectionFactory, $twig, new MySQLInformationDao()));

$app->run();
