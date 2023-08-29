<?php

declare(strict_types=1);

namespace App\Config;

use App\DB\ConnectionFactory;

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

    public function getConnectionFactory(): ConnectionFactory
    {
        return new ConnectionFactory(
            $_ENV['DB_DSN'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD'],
        );
    }

}
