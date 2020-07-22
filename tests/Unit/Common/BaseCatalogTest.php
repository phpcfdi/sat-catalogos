<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Common;

use LogicException;
use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\Tests\Fixtures\BaseCatalogTraitImplementation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BaseCatalogTest extends TestCase
{
    public function testSetAndGetRepository(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $catalog = new BaseCatalogTraitImplementation();
        $catalog->withRepository($repository);
        $this->assertSame($repository, $catalog->repository());
    }

    public function testSetSameRepositoryTwiceDontThrowException(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $catalog = new BaseCatalogTraitImplementation();
        $catalog->withRepository($repository);
        $catalog->withRepository($repository);
        $this->assertTrue(true, 'test must finish withoout exception');
    }

    public function testSetNotSameRepositoryTwice(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $catalog = new BaseCatalogTraitImplementation();
        $catalog->withRepository($repository);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('already contains a repository');
        /** @var Repository&MockObject $otherRepository */
        $otherRepository = $this->createMock(Repository::class);
        $catalog->withRepository($otherRepository);
    }

    public function testGetRepositoryWithoutSetItPreviously(): void
    {
        $catalog = new BaseCatalogTraitImplementation();

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('does not contains a repository');
        $catalog->repository();
    }
}
