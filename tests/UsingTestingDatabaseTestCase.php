<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests;

use PDO;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\TestCase;

class UsingTestingDatabaseTestCase extends TestCase
{
    /** @var PDO */
    private $pdo;

    /** @var Repository */
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pdo = new PDO('sqlite::memory:', '', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $this->repository = new Repository($this->pdo);
        $this->seedPdo($this->pdo);
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function seedPdo(PDO $pdo): void
    {
        $pdo->exec(strval(file_get_contents(__DIR__ . '/database-seed.sql')));
    }
}
