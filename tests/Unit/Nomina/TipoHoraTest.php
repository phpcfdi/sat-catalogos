<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\TipoHora;
use PHPUnit\Framework\TestCase;

final class TipoHoraTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '01';
        $texto = 'Dobles';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $tipoHora = new TipoHora($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoHora);
        $this->assertSame($id, $tipoHora->id());
        $this->assertSame($texto, $tipoHora->texto());
        $this->assertSame($vigenteDesde, $tipoHora->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoHora->vigenteHasta());
    }
}
