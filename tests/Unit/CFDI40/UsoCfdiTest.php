<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\UsoCfdi;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class UsoCfdiTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'G02';
        $texto = 'Devoluciones, descuentos o bonificaciones';
        $aplicaFisica = true;
        $aplicaMoral = true;
        $vigenteDesde = 0;
        $vigenteHasta = 0;
        $regimenes = '601,603';
        $regimenesList = ['601', '603'];

        $usoCfdi = new UsoCfdi($id, $texto, $aplicaFisica, $aplicaMoral, $regimenes, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $usoCfdi);
        $this->assertSame($id, $usoCfdi->id());
        $this->assertSame($texto, $usoCfdi->texto());
        $this->assertSame($aplicaFisica, $usoCfdi->aplicaFisica());
        $this->assertSame($aplicaMoral, $usoCfdi->aplicaMoral());
        $this->assertSame($regimenes, $usoCfdi->regimenesFiscalesReceptores());
        $this->assertSame($regimenesList, $usoCfdi->regimenesFiscalesReceptoresList());
        $this->assertSame($vigenteDesde, $usoCfdi->vigenteDesde());
        $this->assertSame($vigenteHasta, $usoCfdi->vigenteHasta());
    }

    /**
     * @param bool $aplicaFisica
     * @testWith [true]
     *           [false]
     */
    public function testPropertyAplicaFisica(bool $aplicaFisica): void
    {
        $usoCfdi = new UsoCfdi('x', 'x', $aplicaFisica, false, '', 0, 0);

        $this->assertSame($aplicaFisica, $usoCfdi->aplicaFisica());
    }

    /**
     * @param bool $aplicaMoral
     * @testWith [true]
     *           [false]
     */
    public function testPropertyAplicaMoral(bool $aplicaMoral): void
    {
        $usoCfdi = new UsoCfdi('x', 'x', false, $aplicaMoral, '', 0, 0);

        $this->assertSame($aplicaMoral, $usoCfdi->aplicaMoral());
    }

    /**
     * @param string $regimenes
     * @param string[] $expected
     * @return void
     * @testWith ["601, 602", ["601", "602"]]
     * @testWith ["        ", []]
     * @testWith ["601; 602", ["601; 602"]]
     * @testWith ["   601   ,, ,   602", ["601", "602"]]
     */
    public function testPropertyRegimenesFiscalesReceptoresList(string $regimenes, array $expected): void
    {
        $usoCfdi = new UsoCfdi('x', 'x', false, true, $regimenes, 0, 0);

        $this->assertSame($expected, $usoCfdi->regimenesFiscalesReceptoresList());
    }
}
