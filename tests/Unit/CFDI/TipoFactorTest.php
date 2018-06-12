<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\TipoFactor;
use PhpCfdi\SatCatalogos\EntryInterface;
use PHPUnit\Framework\TestCase;

class TipoFactorTest extends TestCase
{
    public function testCreateInstance()
    {
        $id = 'Tasa';
        $texto = 'Tasa';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $tipoFactor = new TipoFactor($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryInterface::class, $tipoFactor);
        $this->assertSame($id, $tipoFactor->id());
        $this->assertSame($texto, $tipoFactor->texto());
        $this->assertSame($vigenteDesde, $tipoFactor->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoFactor->vigenteHasta());
    }
}
