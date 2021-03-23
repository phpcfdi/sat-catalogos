<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\RiesgoPuesto;
use PHPUnit\Framework\TestCase;

final class RiesgoPuestoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '1';
        $texto = 'Clase I';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $riesgoPuesto = new RiesgoPuesto($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $riesgoPuesto);
        $this->assertSame($id, $riesgoPuesto->id());
        $this->assertSame($texto, $riesgoPuesto->texto());
        $this->assertSame($vigenteDesde, $riesgoPuesto->vigenteDesde());
        $this->assertSame($vigenteHasta, $riesgoPuesto->vigenteHasta());
    }
}
