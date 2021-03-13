<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\TipoRegimen;
use PHPUnit\Framework\TestCase;

final class TipoRegimenTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '02';
        $texto = 'Sueldos (Incluye ingresos señalados en la fracción I del artículo 94 de LISR)';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $tipoRegimen = new TipoRegimen($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoRegimen);
        $this->assertSame($id, $tipoRegimen->id());
        $this->assertSame($texto, $tipoRegimen->texto());
        $this->assertSame($vigenteDesde, $tipoRegimen->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoRegimen->vigenteHasta());
    }
}
