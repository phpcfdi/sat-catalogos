<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\TipoDeduccion;
use PHPUnit\Framework\TestCase;

final class TipoDeduccionTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '01';
        $texto = 'Contrato de trabajo por tiempo indeterminado';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $tipoDeduccion = new TipoDeduccion($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoDeduccion);
        $this->assertSame($id, $tipoDeduccion->id());
        $this->assertSame($texto, $tipoDeduccion->texto());
        $this->assertSame($vigenteDesde, $tipoDeduccion->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoDeduccion->vigenteHasta());
    }
}