<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Localidad;
use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PHPUnit\Framework\TestCase;

final class LocalidadTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $codigo = '02';
        $estado = 'QUE';
        $texto = 'San Juan del Rio';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = 0;

        $localidad = new Localidad($codigo, $estado, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryWithVigencias::class, $localidad);
        $this->assertSame($codigo, $localidad->codigo());
        $this->assertSame($estado, $localidad->estado());
        $this->assertSame($texto, $localidad->texto());
        $this->assertSame($vigenteDesde, $localidad->vigenteDesde());
        $this->assertSame($vigenteHasta, $localidad->vigenteHasta());
    }
}
