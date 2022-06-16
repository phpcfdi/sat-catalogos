<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\ObjetoImpuesto;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class ObjetoImpuestoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '02';
        $texto = 'Sí objeto de impuesto.';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = 0;

        $objetoImpuesto = new ObjetoImpuesto($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $objetoImpuesto);
        $this->assertSame($id, $objetoImpuesto->id());
        $this->assertSame($texto, $objetoImpuesto->texto());
        $this->assertSame($vigenteDesde, $objetoImpuesto->vigenteDesde());
        $this->assertSame($vigenteHasta, $objetoImpuesto->vigenteHasta());
    }
}
