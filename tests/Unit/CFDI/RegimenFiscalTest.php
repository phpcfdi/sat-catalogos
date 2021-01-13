<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\RegimenFiscal;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class RegimenFiscalTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '601';
        $texto = 'General de Ley Personas Morales';
        $aplicaFisica = true;
        $aplicaMoral = true;
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $regimenFiscal = new RegimenFiscal($id, $texto, $aplicaFisica, $aplicaMoral, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $regimenFiscal);
        $this->assertSame($id, $regimenFiscal->id());
        $this->assertSame($texto, $regimenFiscal->texto());
        $this->assertSame($aplicaFisica, $regimenFiscal->aplicaFisica());
        $this->assertSame($aplicaMoral, $regimenFiscal->aplicaMoral());
        $this->assertSame($vigenteDesde, $regimenFiscal->vigenteDesde());
        $this->assertSame($vigenteHasta, $regimenFiscal->vigenteHasta());
    }

    /**
     * @param bool $aplicaFisica
     * @testWith [true]
     *           [false]
     */
    public function testPropertyAplicaFisica(bool $aplicaFisica): void
    {
        $regimenFiscal = new RegimenFiscal('x', 'x', $aplicaFisica, false, 0, 0);

        $this->assertSame($aplicaFisica, $regimenFiscal->aplicaFisica());
    }

    /**
     * @param bool $aplicaMoral
     * @testWith [true]
     *           [false]
     */
    public function testPropertyAplicaMoral(bool $aplicaMoral): void
    {
        $regimenFiscal = new RegimenFiscal('x', 'x', false, $aplicaMoral, 0, 0);

        $this->assertSame($aplicaMoral, $regimenFiscal->aplicaMoral());
    }
}
