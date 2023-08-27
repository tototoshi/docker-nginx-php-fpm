<?php

declare(strict_types=1);

namespace App\Config;

use App\DB\ConnectionFactory;
use Slim\Views\Twig;
use Twig\TwigFilter;

class AppConfig
{
    public function getRootDirectory(): string
    {
        return __DIR__ . '/../../';
    }

    public function getLocaleDirectory(): string
    {
        return $this->getRootDirectory() . 'locale/';
    }

    public function getTemplatesDirectory(): string
    {
        return $this->getRootDirectory() . 'templates/';
    }

    public function getTwig(): Twig
    {
        $twig = Twig::create($this->getTemplatesDirectory(), ['cache' => false]);
        $twig->getEnvironment()->addFilter(new TwigFilter('L', function ($string) {
            return gettext($string);
        }));
        return $twig;
    }

    public function getConnectionFactory(): ConnectionFactory
    {
        return new ConnectionFactory(
            $_ENV['DB_DSN'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
        );
    }

}
