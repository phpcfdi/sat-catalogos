<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Estado;
use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PHPUnit\Framework\TestCase;

final class EstadoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $codigo = 'MOR';
        $pais = 'MEX';
        $texto = 'Morelos';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = 0;

        $estado = new Estado($codigo, $pais, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryWithVigencias::class, $estado);
        $this->assertSame($codigo, $estado->codigo());
        $this->assertSame($pais, $estado->pais());
        $this->assertSame($texto, $estado->texto());
        $this->assertSame($vigenteDesde, $estado->vigenteDesde());
        $this->assertSame($vigenteHasta, $estado->vigenteHasta());
    }
}
