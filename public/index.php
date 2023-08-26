<?php
declare(strict_types=1);

use App\Config\AppConfig;
use App\Controller\HomeController;
use App\DB\MySQLInformationDao;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$config = new AppConfig();

$app = AppFactory::create();

$app->get('/', new HomeController($config->getConnectionFactory(), $config->getTwig(), new MySQLInformationDao()));

$app->run();
