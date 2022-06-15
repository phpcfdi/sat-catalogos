<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Municipio;
use PhpCfdi\SatCatalogos\CFDI40\Municipios;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

class MunicipiosTest extends UsingTestingDatabaseTestCase
{
    /** @var Municipios */
    protected $municipios;

    protected function setUp(): void
    {
        parent::setUp();
        $this->municipios = new Municipios();
        $this->municipios->withRepository($this->getRepository());
    }

    public function testObtainExistentEntry(): void
    {
        $municipio = $this->municipios->obtain('004', 'BCN');

        $this->assertSame('004', $municipio->codigo());
        $this->assertSame('BCN', $municipio->estado());
        $this->assertSame('Tijuana', $municipio->texto());
        $this->assertSame(strtotime('2022-01-01'), $municipio->vigenteDesde());
        $this->assertSame(0, $municipio->vigenteHasta());
    }

    public function testObtainNonExistentEntry(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('No se encontró un municipio con código foo y estado bar');
        $this->municipios->obtain('foo', 'bar');
    }

    public function testObtainMunicipiosByCode(): void
    {
        $estados = array_map(
            function (Municipio $municipio): string {
                return $municipio->estado();
            },
            $this->municipios->search('210')
        );
        $this->assertContains('OAX', $estados);
        $this->assertContains('PUE', $estados);
        $this->assertContains('VER', $estados);
    }

    public function testObtainMunicipiosByEstado(): void
    {
        $codigos = array_map(
            function (Municipio $municipio): string {
                return $municipio->codigo();
            },
            $this->municipios->search('%', 'BCN')
        );
        $this->assertContains('001', $codigos);
        $this->assertContains('002', $codigos);
        $this->assertContains('003', $codigos);
        $this->assertContains('004', $codigos);
        $this->assertContains('005', $codigos);
    }

    public function testObtainMunicipiosByTexto(): void
    {
        $codigosEstados = array_map(
            function (Municipio $municipio): string {
                return sprintf('%s-%s', $municipio->codigo(), $municipio->estado());
            },
            $this->municipios->search('%', '%', 'Tijuana')
        );
        $this->assertContains('004-BCN', $codigosEstados);
    }
}
