<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Impuesto;
use PhpCfdi\SatCatalogos\EntryInterface;
use PHPUnit\Framework\TestCase;

class ImpuestoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '002';
        $texto = 'IVA';
        $retencion = true;
        $traslado = true;
        $ambito = 'Federal';
        $entidad = '';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $impuesto = new Impuesto($id, $texto, $retencion, $traslado, $ambito, $entidad);

        $this->assertInstanceOf(EntryInterface::class, $impuesto);
        $this->assertSame($id, $impuesto->id());
        $this->assertSame($texto, $impuesto->texto());
        $this->assertSame($retencion, $impuesto->retencion());
        $this->assertSame($traslado, $impuesto->traslado());
        $this->assertSame($ambito, $impuesto->ambito());
        $this->assertSame($entidad, $impuesto->entidad());
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
        $impuesto = new Impuesto('x', 'x', false, $traslado, '', '');

        $this->assertSame($traslado, $impuesto->traslado());
    }

    /**
     * @param bool $retencion
     * @testWith [true]
     *           [false]
     */
    public function testPropertyRetencion(bool $retencion): void
    {
        $impuesto = new Impuesto('x', 'x', $retencion, false, '', '');

        $this->assertSame($retencion, $impuesto->retencion());
    }
}
