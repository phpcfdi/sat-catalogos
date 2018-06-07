<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\FormaDePago;
use PhpCfdi\SatCatalogos\EntryInterface;
use PHPUnit\Framework\TestCase;

class FormaDePagoTest extends TestCase
{
    public function testCreateInstance()
    {
        $id = '03';
        $texto = 'Transferencia electrónica de fondos';
        $esBancarizado = true;
        $requiereNumeroDeOperacion = true;
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = strtotime('2018-12-31');

        $FormaDePago = new FormaDePago(
            $id,
            $texto,
            $esBancarizado,
            $requiereNumeroDeOperacion,
            $vigenteDesde,
            $vigenteHasta
        );
        $this->assertInstanceOf(EntryInterface::class, $FormaDePago);

        $this->assertSame($id, $FormaDePago->id());
        $this->assertSame($texto, $FormaDePago->texto());
        $this->assertSame($esBancarizado, $FormaDePago->esBancarizado());
        $this->assertSame($requiereNumeroDeOperacion, $FormaDePago->requiereNumeroDeOperacion());
        $this->assertSame($vigenteDesde, $FormaDePago->vigenteDesde());
        $this->assertSame($vigenteHasta, $FormaDePago->vigenteHasta());
    }

    /**
     * @param bool $esBancarizado
     * @testWith [true]
     *           [false]
     */
    public function testEsBancarizado(bool $esBancarizado)
    {
        $impuesto = new FormaDePago('x', 'x', $esBancarizado, false, 0, 0);

        $this->assertSame($esBancarizado, $impuesto->esBancarizado());
    }

    /**
     * @param bool $requiereNumeroDeOperacion
     * @testWith [true]
     *           [false]
     */
    public function testRequiereNumeroDeOperacion(bool $requiereNumeroDeOperacion)
    {
        $impuesto = new FormaDePago('x', 'x', false, $requiereNumeroDeOperacion, 0, 0);

        $this->assertSame($requiereNumeroDeOperacion, $impuesto->esBancarizado());
    }
}
