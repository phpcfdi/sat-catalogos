<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Builders\FormaDePagoBuilder;
use PhpCfdi\SatCatalogos\CFDI\FormaDePago;
use PhpCfdi\SatCatalogos\EntryInterface;
use PHPUnit\Framework\TestCase;

class FormaDePagoTest extends TestCase
{
    protected function makeFormaDePago(array $values, string $id = 'foo')
    {
        return (new FormaDePagoBuilder())->make($id, $values);
    }

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

    public function testEsBancarizado()
    {
        $this->assertTrue($this->makeFormaDePago(['esBancarizado' => true])->esBancarizado());
        $this->assertFalse($this->makeFormaDePago(['esBancarizado' => false])->esBancarizado());
    }

    public function testRequiereNumeroDeOperacion()
    {
        $this->assertTrue($this->makeFormaDePago(['requiereNumeroDeOperacion' => true])->requiereNumeroDeOperacion());
        $this->assertFalse($this->makeFormaDePago(['requiereNumeroDeOperacion' => false])->requiereNumeroDeOperacion());
    }
}
