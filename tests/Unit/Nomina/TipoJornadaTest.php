<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\TipoJornada;
use PHPUnit\Framework\TestCase;

final class TipoJornadaTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '01';
        $texto = 'Diurna';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $tipoJornada = new TipoJornada($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoJornada);
        $this->assertSame($id, $tipoJornada->id());
        $this->assertSame($texto, $tipoJornada->texto());
        $this->assertSame($vigenteDesde, $tipoJornada->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoJornada->vigenteHasta());
    }
}
