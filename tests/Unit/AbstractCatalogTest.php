<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\CatalogInterface;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\Tests\Unit\Fixtures\CatalogImplementation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AbstractCatalogTest extends TestCase
{
    /** @var MockObject&Repository $repository */
    protected $repository;

    /** @var CatalogImplementation */
    protected $catalog;

    protected function setUp()
    {
        parent::setUp();
        /** @var MockObject&Repository $repository */
        $repository = $this->createMock(Repository::class);
        $this->repository = $repository;
        $this->catalog = new CatalogImplementation();
        $this->catalog->withRepository($this->repository);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(AbstractCatalog::class, $this->catalog);
        $this->assertInstanceOf(CatalogInterface::class, $this->catalog);
        $this->assertSame($this->repository, $this->catalog->repository());
    }

    public function testCreate()
    {
        $created = $this->catalog->create([
            'id' => 'foo',
            'texto' => 'bar',
            'vigencia_desde' => '2017-01-01',
            'vigencia_hasta' => '2018-01-01',
        ]);

        $this->assertSame('foo', $created->id());
        $this->assertSame('bar', $created->texto());
        $this->assertSame('2017-01-01', date('Y-m-d', $created->vigenteDesde()));
        $this->assertSame('2018-01-01', date('Y-m-d', $created->vigenteHasta()));
    }

    public function testObtainWithData()
    {
        $this->repository->method('queryById')->willReturn([
            'id' => 'foo',
            'texto' => 'bar',
            'vigencia_desde' => '2017-01-01',
            'vigencia_hasta' => '2018-01-01',
        ]);

        $obtained = $this->catalog->obtain('foo');
        $this->assertInstanceOf(EntryInterface::class, $obtained);
    }

    public function testExists()
    {
        $this->repository->method('existsId')->willReturnMap([
            ['catalog', 'existent', true],
            ['catalog', 'non-existent', false],
        ]);

        $this->assertFalse($this->catalog->exists('non-existent'));
        $this->assertTrue($this->catalog->exists('existent'));
    }
}
