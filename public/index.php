<?php
declare(strict_types=1);

use App\Config\AppConfig;
use App\Controller\HomeController;
use App\DB\MySQLInformationDao;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$config = new AppConfig();

$app = AppFactory::create();

$app->get('/', new HomeController($config->getConnectionFactory(), $config->getTwig(), new MySQLInformationDao()));

$app->run();
