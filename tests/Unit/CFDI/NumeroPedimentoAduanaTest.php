<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\NumeroPedimentoAduana;
use PhpCfdi\SatCatalogos\VigenciasInterface;
use PHPUnit\Framework\TestCase;

class NumeroPedimentoAduanaTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $aduana = '24';
        $patente = '9876';
        $ejercicio = 2018;
        $cantidad = 123456;
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = strtotime('2018-12-31');

        $numeroPedimentoAduana = new NumeroPedimentoAduana(
            $aduana,
            $patente,
            $ejercicio,
            $cantidad,
            $vigenteDesde,
            $vigenteHasta
        );

        $this->assertInstanceOf(VigenciasInterface::class, $numeroPedimentoAduana);

        $this->assertSame($aduana, $numeroPedimentoAduana->aduana());
        $this->assertSame($patente, $numeroPedimentoAduana->patente());
        $this->assertSame($ejercicio, $numeroPedimentoAduana->ejercicio());
        $this->assertSame($cantidad, $numeroPedimentoAduana->cantidad());
        $this->assertSame($vigenteDesde, $numeroPedimentoAduana->vigenteDesde());
        $this->assertSame($vigenteHasta, $numeroPedimentoAduana->vigenteHasta());
    }
}
