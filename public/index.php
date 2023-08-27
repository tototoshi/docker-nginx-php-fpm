<?php
declare(strict_types=1);

use App\Auth\AuthMiddleware;
use App\Config\AppConfig;
use App\Controller\HomeController;
use App\Controller\LoginGetController;
use App\Controller\LoginPostController;
use App\DB\MySQLInformationDao;
use App\I18N\I18NMiddleware;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$config = new AppConfig();

$app = AppFactory::create();

$app->add(new I18NMiddleware($config->getLocaleDirectory()));
$app->add(new AuthMiddleware());

$app->get('/', new HomeController($config->getConnectionFactory(), $config->getTwig(), new MySQLInformationDao()));
$app->get('/login', new LoginGetController($config->getTwig()));
$app->post('/login', new LoginPostController($config->getTwig()));

$app->run();
