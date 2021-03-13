<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\NOMINA;

use PhpCfdi\SatCatalogos\NOMINA\TipoNomina;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class TipoNominaTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'O';
        $texto = 'Nómina ordinaria';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $tipoNomina = new TipoNomina($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoNomina);
        $this->assertSame($id, $tipoNomina->id());
        $this->assertSame($texto, $tipoNomina->texto());
        $this->assertSame($vigenteDesde, $tipoNomina->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoNomina->vigenteHasta());
    }
}
