<?php
declare(strict_types=1);

use App\Auth\AuthMiddleware;
use App\Config\AppConfig;
use App\Controller\HomeController;
use App\Controller\LoginGetController;
use App\Controller\LoginPostController;
use App\DB\MySQLInformationDao;
use App\I18N\I18NMiddleware;
use App\View\TwigFactory;
use Dotenv\Dotenv;
use Slim\Csrf\Guard;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$config = new AppConfig();

session_start();

$app = AppFactory::create();

$csrf = new Guard(responseFactory: $app->getResponseFactory(), persistentTokenMode: true);
$twig_factory = new TwigFactory($config->getTemplatesDirectory(), $csrf);
$twig = $twig_factory->create();

$app->add($csrf);
$app->add(new I18NMiddleware($config->getLocaleDirectory()));
$app->add(new AuthMiddleware());

$app->get('/', new HomeController($config->getConnectionFactory(), $twig, new MySQLInformationDao()));
$app->get('/login', new LoginGetController($twig));
$app->post('/login', new LoginPostController($twig));

$app->run();
