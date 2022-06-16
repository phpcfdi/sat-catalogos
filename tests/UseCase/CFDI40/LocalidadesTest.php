<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Localidad;
use PhpCfdi\SatCatalogos\CFDI40\Localidades;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

class LocalidadesTest extends UsingTestingDatabaseTestCase
{
    /** @var Localidades */
    protected $localidades;

    protected function setUp(): void
    {
        parent::setUp();
        $this->localidades = new Localidades();
        $this->localidades->withRepository($this->getRepository());
    }

    public function testObtainExistentEntry(): void
    {
        $localidad = $this->localidades->obtain('55', 'VER');

        $this->assertSame('55', $localidad->codigo());
        $this->assertSame('VER', $localidad->estado());
        $this->assertSame('Tihuatlán', $localidad->texto());
        $this->assertSame(strtotime('2022-01-01'), $localidad->vigenteDesde());
        $this->assertSame(0, $localidad->vigenteHasta());
    }

    public function testObtainNonExistentEntry(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('No se encontró una localidad con código foo y estado bar');
        $this->localidades->obtain('foo', 'bar');
    }

    public function testObtainLocalidadesByCode(): void
    {
        $estados = array_map(
            function (Localidad $localidad): string {
                return $localidad->estado();
            },
            $this->localidades->search('55'),
        );
        $this->assertContains('JAL', $estados);
        $this->assertContains('OAX', $estados);
        $this->assertContains('VER', $estados);
    }

    public function testObtainLocalidadesByEstado(): void
    {
        $codigos = array_map(
            function (Localidad $localidad): string {
                return $localidad->codigo();
            },
            $this->localidades->search('%', 'QUE'),
        );
        $this->assertContains('01', $codigos);
        $this->assertContains('02', $codigos);
        $this->assertContains('04', $codigos);
    }

    public function testObtainLocalidadesByTexto(): void
    {
        $codigosEstados = array_map(
            function (Localidad $localidad): string {
                return sprintf('%s-%s', $localidad->codigo(), $localidad->estado());
            },
            $this->localidades->search('%', '%', '%domingo%'),
        );
        $this->assertContains('55-OAX', $codigosEstados);
    }
}
