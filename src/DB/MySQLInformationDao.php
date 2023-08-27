<?php

declare(strict_types=1);

namespace App\DB;

use PDO;

class MySQLInformationDao
{
    public function getMysqlVersion(PDO $conn): string
    {
        $stmt = $conn->prepare('SELECT version() as v');
        $stmt->execute();
        $row = $stmt->fetch();
        assert(is_array($row));
        $mysql_version = $row['v'];
        return $mysql_version;
    }

}
