<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\ObjetosImpuestos;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ObjetosImpuestosTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => '02',
        'texto' => 'Sí objeto de impuesto.',
        'vigencia_desde' => '2000-01-01',
        'vigencia_hasta' => '',
    ];

    public function testObtainWithMock(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryById')->willReturn($this->validRow);

        $objetosImpuestos = new ObjetosImpuestos();
        $objetosImpuestos->withRepository($repository);

        $objetoImpuestos = $objetosImpuestos->obtain('02');
        $this->assertStringContainsString('Sí objeto de impuesto.', $objetoImpuestos->texto());
    }

    public function testCreate(): void
    {
        $objetosImpuestos = new ObjetosImpuestos();
        $created = $objetosImpuestos->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
