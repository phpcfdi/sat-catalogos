<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit;

use PDO;
use PhpCfdi\SatCatalogos\Factory;
use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\SatCatalogos;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class FactoryTest extends TestCase
{
    public function testCatalogosFromDsn(): void
    {
        $factory = new Factory();
        $catalogs = $factory->catalogosFromDsn('sqlite::memory:');
        $this->assertInstanceOf(SatCatalogos::class, $catalogs);
    }

    public function testCreatePdoFromDsn(): void
    {
        $factory = new Factory();
        $pdo = $factory->createPdoFromDsn('sqlite::memory:');
        $this->assertInstanceOf(PDO::class, $pdo);
    }

    public function testCreateRepositoryWithPdo(): void
    {
        /** @var PDO&MockObject $pdo */
        $pdo = $this->createMock(PDO::class);
        $factory = new Factory();
        $repository = $factory->createRepositoryWithPdo($pdo);
        $this->assertInstanceOf(Repository::class, $repository);
    }
}
