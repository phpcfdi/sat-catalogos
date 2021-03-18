<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\TipoContrato;
use PHPUnit\Framework\TestCase;

final class TipoContratoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '01';
        $texto = 'Contrato de trabajo por tiempo indeterminado';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $tipoContrato = new TipoContrato($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoContrato);
        $this->assertSame($id, $tipoContrato->id());
        $this->assertSame($texto, $tipoContrato->texto());
        $this->assertSame($vigenteDesde, $tipoContrato->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoContrato->vigenteHasta());
    }
}