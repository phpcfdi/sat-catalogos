<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\ObjetoImpuesto;
use PhpCfdi\SatCatalogos\CFDI40\ObjetosImpuestos;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ObjetosImpuestosTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'id' => '02',
        'texto' => 'Sí objeto de impuesto.',
        'vigencia_desde' => '2022-01-01',
        'vigencia_hasta' => '',
    ];

    public function testObtainWithMock(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryById')->willReturn($this->validRow);

        $objetosImpuestos = new ObjetosImpuestos();
        $objetosImpuestos->withRepository($repository);

        $objetoImpuesto = $objetosImpuestos->obtain('02');
        $this->assertInstanceOf(ObjetoImpuesto::class, $objetoImpuesto);
        $this->assertStringContainsString('Sí objeto de impuesto.', $objetoImpuesto->texto());
    }

    public function testCreate(): void
    {
        $objetosImpuestos = new ObjetosImpuestos();
        $created = $objetosImpuestos->create($this->validRow);

        $this->assertInstanceOf(ObjetoImpuesto::class, $created);
        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime((string) $this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
