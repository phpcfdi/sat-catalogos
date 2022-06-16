<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Impuesto;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class ImpuestoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '002';
        $texto = 'IVA';
        $retencion = true;
        $traslado = true;
        $ambito = 'Federal';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = strtotime('2022-12-31');

        $impuesto = new Impuesto($id, $texto, $retencion, $traslado, $ambito, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $impuesto);
        $this->assertSame($id, $impuesto->id());
        $this->assertSame($texto, $impuesto->texto());
        $this->assertSame($retencion, $impuesto->retencion());
        $this->assertSame($traslado, $impuesto->traslado());
        $this->assertSame($ambito, $impuesto->ambito());
        $this->assertSame($vigenteDesde, $impuesto->vigenteDesde());
        $this->assertSame($vigenteHasta, $impuesto->vigenteHasta());
    }

    /**
     * @param bool $traslado
     * @testWith [true]
     *           [false]
     */
    public function testPropertyTraslado(bool $traslado): void
    {
        $impuesto = new Impuesto('x', 'x', false, $traslado, '', 0, 0);

        $this->assertSame($traslado, $impuesto->traslado());
    }

    /**
     * @param bool $retencion
     * @testWith [true]
     *           [false]
     */
    public function testPropertyRetencion(bool $retencion): void
    {
        $impuesto = new Impuesto('x', 'x', $retencion, false, '', 0, 0);

        $this->assertSame($retencion, $impuesto->retencion());
    }
}
