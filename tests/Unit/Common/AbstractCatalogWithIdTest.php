<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Common;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\CatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\Tests\Fixtures\CatalogIdentifiableImplementation;
use PhpCfdi\SatCatalogos\Tests\Fixtures\EntryIdentifiableImplementation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AbstractCatalogWithIdTest extends TestCase
{
    /** @var MockObject&Repository $repository */
    protected $repository;

    /** @var CatalogIdentifiableImplementation */
    protected $catalog;

    protected function setUp(): void
    {
        parent::setUp();
        /** @var MockObject&Repository $repository */
        $repository = $this->createMock(Repository::class);
        $this->repository = $repository;
        $this->catalog = new CatalogIdentifiableImplementation();
        $this->catalog->withRepository($this->repository);
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(AbstractCatalogIdentifiable::class, $this->catalog);
        $this->assertInstanceOf(CatalogIdentifiable::class, $this->catalog);
        $this->assertSame($this->repository, $this->catalog->repository());
    }

    public function testCreate(): void
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

    public function testObtainWithData(): void
    {
        $this->repository->method('queryById')->willReturn([
            'id' => 'foo',
            'texto' => 'bar',
            'vigencia_desde' => '2017-01-01',
            'vigencia_hasta' => '2018-01-01',
        ]);

        $obtained = $this->catalog->obtain('foo');
        $this->assertInstanceOf(EntryIdentifiable::class, $obtained);
    }

    public function testExists(): void
    {
        $this->repository->method('existsId')->willReturnMap([
            ['catalog', 'existent', true],
            ['catalog', 'non-existent', false],
        ]);

        $this->assertFalse($this->catalog->exists('non-existent'));
        $this->assertTrue($this->catalog->exists('existent'));
    }

    public function testObtainByIds(): void
    {
        $this->repository->method('queryByIds')->willReturnCallback(
            function (string $catalogName, array $ids): array {
                unset($catalogName);
                $content = [
                    [
                        'id' => '01',
                        'texto' => 'foo',
                        'vigencia_desde' => '2017-01-01',
                        'vigencia_hasta' => '2018-01-01',
                    ],
                    [
                        'id' => '02',
                        'texto' => 'bar',
                        'vigencia_desde' => '2017-01-01',
                        'vigencia_hasta' => '2018-01-01',
                    ],
                ];
                return array_values(
                    array_filter($content, function (array $row) use ($ids): bool {
                        return in_array($row['id'], $ids, true);
                    }),
                );
            },
        );

        $this->assertCount(0, $this->catalog->obtainByIds(['none']));
        /** @var EntryIdentifiableImplementation[] $search */
        $search = $this->catalog->obtainByIds(['01']);
        $this->assertCount(1, $search);
        $this->assertSame('foo', $search[0]->texto());

        $search = $this->catalog->obtainByIds(['02']);
        $this->assertCount(1, $search);
        $this->assertSame('bar', $search[0]->texto());

        $search = $this->catalog->obtainByIds(['01', '02']);
        $this->assertCount(2, $search);
        $this->assertSame('foo', $search[0]->texto());
        $this->assertSame('bar', $search[1]->texto());
    }
}
