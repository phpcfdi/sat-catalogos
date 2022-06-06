<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Periodicidad;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class PeriodicidadTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '01';
        $texto = 'Enero';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = 0;

        $periodicidad = new Periodicidad($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $periodicidad);
        $this->assertSame($id, $periodicidad->id());
        $this->assertSame($texto, $periodicidad->texto());
        $this->assertSame($vigenteDesde, $periodicidad->vigenteDesde());
        $this->assertSame($vigenteHasta, $periodicidad->vigenteHasta());
    }
}