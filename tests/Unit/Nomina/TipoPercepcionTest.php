<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\TipoPercepcion;
use PHPUnit\Framework\TestCase;

final class TipoPercepcionTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '001';
        $texto = 'Sueldos, Salarios  Rayas y Jornales';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $tipoPercepcion = new TipoPercepcion($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoPercepcion);
        $this->assertSame($id, $tipoPercepcion->id());
        $this->assertSame($texto, $tipoPercepcion->texto());
        $this->assertSame($vigenteDesde, $tipoPercepcion->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoPercepcion->vigenteHasta());
    }
}
