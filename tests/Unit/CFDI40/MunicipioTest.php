<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Municipio;
use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PHPUnit\Framework\TestCase;

final class MunicipioTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $codigo = '004';
        $estado = 'TAB';
        $texto = 'Centro';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = 0;

        $municipio = new Municipio($codigo, $estado, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryWithVigencias::class, $municipio);
        $this->assertSame($codigo, $municipio->codigo());
        $this->assertSame($estado, $municipio->estado());
        $this->assertSame($texto, $municipio->texto());
        $this->assertSame($vigenteDesde, $municipio->vigenteDesde());
        $this->assertSame($vigenteHasta, $municipio->vigenteHasta());
    }
}
