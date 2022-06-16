<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Paises;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class PaisesTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'id' => 'CAN',
        'texto' => 'Canadá',
        'patron_codigo_postal' => '[A-Z][0-9][A-Z] [0-9][A-Z][0-9]',
        'patron_identidad_tributaria' => '[0-9]{9}',
        'validacion_identidad_tributaria' => '',
        'agrupaciones' => 'TLCAN',
    ];

    public function testObtainWithMock(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryById')->willReturn($this->validRow);

        $paises = new Paises();
        $paises->withRepository($repository);

        $pais = $paises->obtain('CAN');
        $this->assertSame('CAN', $pais->id());
        $this->assertSame('Canadá', $pais->texto());
        $this->assertSame('[A-Z][0-9][A-Z] [0-9][A-Z][0-9]', $pais->patronCodigoPostal()->origen());
        $this->assertSame('[0-9]{9}', $pais->patronIdentidadTributaria()->origen());
        $this->assertSame('', $pais->validacionIdentidadTributaria());
        $this->assertSame('TLCAN', $pais->agrupaciones());
    }

    public function testCreate(): void
    {
        $paises = new Paises();
        $created = $paises->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame(
            $created->patronCodigoPostal()->origen(),
            $this->validRow['patron_codigo_postal'],
        );
        $this->assertSame(
            $created->patronIdentidadTributaria()->origen(),
            $this->validRow['patron_identidad_tributaria'],
        );
        $this->assertSame(
            $created->validacionIdentidadTributaria(),
            $this->validRow['validacion_identidad_tributaria'],
        );
        $this->assertSame($created->agrupaciones(), $this->validRow['agrupaciones']);
    }
}
