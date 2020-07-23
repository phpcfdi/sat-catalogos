<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

use PDO;

class Factory
{
    public function catalogosFromDsn(string $dsn): SatCatalogos
    {
        $pdo = $this->createPdoFromDsn($dsn);
        $repository = $this->createRepositoryWithPdo($pdo);
        return new SatCatalogos($repository);
    }

    public function createPdoFromDsn(string $dsn, string $username = '', string $password = ''): PDO
    {
        return new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }

    public function createRepositoryWithPdo(PDO $pdo): Repository
    {
        return new Repository($pdo);
    }
}
