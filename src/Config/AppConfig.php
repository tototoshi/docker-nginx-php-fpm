<?php
declare(strict_types=1);

namespace App\Config;

use App\DB\ConnectionFactory;
use Slim\Views\Twig;

class AppConfig {

    public function getTwig(): Twig
    {
        return Twig::create(__DIR__ . '/../../templates', ['cache' => false]);
    }

    public function getConnectionFactory(): ConnectionFactory
    {
        return new ConnectionFactory(
            'mysql:host=mysql;dbname=example',
            'my_user',
            'my_password',
        );
    }

}