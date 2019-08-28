<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Common;

use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\Tests\Fixtures\BaseCatalogTraitImplementation;
use PHPUnit\Framework\TestCase;

class BaseCatalogTest extends TestCase
{
    public function testSetAndGetRepository()
    {
        $repository = $this->createMock(Repository::class);
        $catalog = new BaseCatalogTraitImplementation();
        $catalog->withRepository($repository);
        $this->assertSame($repository, $catalog->repository());
    }

    public function testSetSameRepositoryTwiceDontThrowException()
    {
        $repository = $this->createMock(Repository::class);
        $catalog = new BaseCatalogTraitImplementation();
        $catalog->withRepository($repository);
        $catalog->withRepository($repository);
        $this->assertTrue(true, 'test must finish withoout exception');
    }

    public function testSetNotSameRepositoryTwice()
    {
        $repository = $this->createMock(Repository::class);
        $catalog = new BaseCatalogTraitImplementation();
        $catalog->withRepository($repository);

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('already contains a repository');
        $catalog->withRepository($this->createMock(Repository::class));
    }

    public function testGetRepositoryWithoutSetItPreviously()
    {
        $catalog = new BaseCatalogTraitImplementation();

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('does not contains a repository');
        $catalog->repository();
    }
}
