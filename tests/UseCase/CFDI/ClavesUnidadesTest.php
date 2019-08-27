<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase\CFDI;

use PhpCfdi\SatCatalogos\CFDI\ClavesUnidades;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

class ClavesUnidadesTest extends UsingTestingDatabaseTestCase
{
    /** @var ClavesUnidades */
    protected $clavesUnidades;

    protected function setUp(): void
    {
        parent::setUp();
        $this->clavesUnidades = new ClavesUnidades();
        $this->clavesUnidades->withRepository($this->getRepository());
    }

    public function testObtainExistentEntry(): void
    {
        $claveUnidad = $this->clavesUnidades->obtain('MTK');

        $this->assertSame('MTK', $claveUnidad->id());
        $this->assertSame('Metro cuadrado', $claveUnidad->texto());
        $this->assertContains('unidad básica de superficie en el Sistema Internacional', $claveUnidad->descripcion());
        $this->assertSame('', $claveUnidad->nota());
        $this->assertSame('m²', $claveUnidad->simbolo());
        $this->assertSame('2017-01-01', date('Y-m-d', $claveUnidad->vigenteDesde()));
        $this->assertSame(0, $claveUnidad->vigenteHasta());
    }

    public function testObtainNonExistentEntry(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage(Repository::CFDI_CLAVES_UNIDADES);
        $this->clavesUnidades->obtain('foo');
    }

    public function testEntryExists(): void
    {
        $this->assertTrue($this->clavesUnidades->exists('MTK'));
        $this->assertFalse($this->clavesUnidades->exists('foo'));
    }
}
