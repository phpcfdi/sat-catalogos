<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\TipoFactor;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class TipoFactorTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'Tasa';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = 0;

        $tipoFactor = new TipoFactor($id, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoFactor);
        $this->assertSame($id, $tipoFactor->id());
        $this->assertSame($vigenteDesde, $tipoFactor->vigenteDesde());
        $this->assertSame($vigenteHasta, $tipoFactor->vigenteHasta());
    }
}
