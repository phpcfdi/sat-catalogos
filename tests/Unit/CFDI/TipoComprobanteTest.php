<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\TipoComprobante;
use PhpCfdi\SatCatalogos\EntryInterface;
use PHPUnit\Framework\TestCase;

class TipoComprobanteTest extends TestCase
{
    public function testCreateInstance()
    {
        $id = 'I';
        $texto = 'Ingreso';
        $valorMaximo = '999999999999999999.999999';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $tipoComprobante = new TipoComprobante($id, $texto, $valorMaximo, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryInterface::class, $tipoComprobante);
        $this->assertSame($id, $tipoComprobante->id());
        $this->assertSame($texto, $tipoComprobante->texto());
        $this->assertSame($valorMaximo, $tipoComprobante->valorMaximo());
        $this->assertSame($vigenteDesde, $tipoComprobante->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoComprobante->vigenteHasta());
    }
}
