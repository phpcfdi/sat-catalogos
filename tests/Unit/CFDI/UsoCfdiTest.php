<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\UsoCfdi;
use PhpCfdi\SatCatalogos\EntryInterface;
use PHPUnit\Framework\TestCase;

class UsoCfdiTest extends TestCase
{
    public function testCreateInstance()
    {
        $id = 'G02';
        $texto = 'Devoluciones, descuentos o bonificaciones';
        $aplicaFisica = true;
        $aplicaMoral = true;
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $usoCfdi = new UsoCfdi($id, $texto, $aplicaFisica, $aplicaMoral, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryInterface::class, $usoCfdi);
        $this->assertSame($id, $usoCfdi->id());
        $this->assertSame($texto, $usoCfdi->texto());
        $this->assertSame($aplicaFisica, $usoCfdi->aplicaFisica());
        $this->assertSame($aplicaMoral, $usoCfdi->aplicaMoral());
        $this->assertSame($vigenteDesde, $usoCfdi->vigenteDesde());
        $this->assertSame($vigenteHasta, $usoCfdi->vigenteHasta());
    }

    /**
     * @param bool $aplicaFisica
     * @testWith [true]
     *           [false]
     */
    public function testPropertyAplicaFisica(bool $aplicaFisica)
    {
        $usoCfdi = new UsoCfdi('x', 'x', $aplicaFisica, false, 0, 0);

        $this->assertSame($aplicaFisica, $usoCfdi->aplicaFisica());
    }

    /**
     * @param bool $aplicaMoral
     * @testWith [true]
     *           [false]
     */
    public function testPropertyAplicaMoral(bool $aplicaMoral)
    {
        $usoCfdi = new UsoCfdi('x', 'x', false, $aplicaMoral, 0, 0);

        $this->assertSame($aplicaMoral, $usoCfdi->aplicaMoral());
    }
}
