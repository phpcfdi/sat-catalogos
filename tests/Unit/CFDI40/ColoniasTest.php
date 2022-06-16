<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Colonias;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ColoniasTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'colonia' => '2793',
        'codigo_postal' => '04510',
        'texto' => 'Universidad Nacional Autónoma de México',
    ];

    public function testObtainWithMock(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryRowsByFields')->willReturn([$this->validRow]);

        $colonias = new Colonias();
        $colonias->withRepository($repository);

        $colonia = $colonias->obtain('2793', '04510');
        $this->assertSame('2793', $colonia->colonia());
        $this->assertSame('04510', $colonia->codigoPostal());
        $this->assertSame('Universidad Nacional Autónoma de México', $colonia->asentamiento());
    }

    public function testCreate(): void
    {
        $colonias = new Colonias();
        $created = $colonias->create($this->validRow);

        $this->assertSame($created->colonia(), $this->validRow['colonia']);
        $this->assertSame($created->codigoPostal(), $this->validRow['codigo_postal']);
        $this->assertSame($created->asentamiento(), $this->validRow['texto']);
    }

    public function testFindInexistent(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryRowsByFields')->willReturn([]);

        $colonias = new Colonias();
        $colonias->withRepository($repository);

        $found = $colonias->find('foo', 'bar');
        $this->assertNull($found);

        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('No se encontró una colonia foo con código postal bar');
        $colonias->obtain('foo', 'bar');
    }
}
