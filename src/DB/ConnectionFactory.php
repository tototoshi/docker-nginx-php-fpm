<?php

declare(strict_types=1);

namespace App\DB;

class ConnectionFactory
{
    public function __construct(
        private string $dsn,
        private string $username,
        private string $password,
    ) {
    }

    public function getConnection(): \PDO
    {
        $pdo = new \PDO($this->dsn, $this->username, $this->password);
        return $pdo;
    }

}
