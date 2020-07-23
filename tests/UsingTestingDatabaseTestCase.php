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
        $dbfile = realpath(__DIR__ . '/catalogos.sqlite3') ?: '';
        if ('' !== $dbfile && file_exists($dbfile) && ! is_dir($dbfile)) {
            $pdo = new PDO('sqlite:' . $dbfile, '', '', [
                PDO::SQLITE_ATTR_OPEN_FLAGS => SQLITE3_OPEN_READONLY,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        } else {
            $pdo = new PDO('sqlite::memory:', '', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
            $this->seedPdo($pdo);
        }
        $this->pdo = $pdo;
        $this->repository = new Repository($pdo);
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
