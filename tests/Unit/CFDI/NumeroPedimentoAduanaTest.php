<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\NumeroPedimentoAduana;
use PhpCfdi\SatCatalogos\VigenciasInterface;
use PHPUnit\Framework\TestCase;

class NumeroPedimentoAduanaTest extends TestCase
{
    public function testCreateInstance()
    {
        $aduana = '24';
        $patente = '9876';
        $ejercicio = 2018;
        $cantidad = 123456;
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = strtotime('2018-12-31');

        $NumeroPedimentoAduana = new NumeroPedimentoAduana(
            $aduana,
            $patente,
            $ejercicio,
            $cantidad,
            $vigenteDesde,
            $vigenteHasta
        );

        $this->assertInstanceOf(VigenciasInterface::class, $NumeroPedimentoAduana);

        $this->assertSame($aduana, $NumeroPedimentoAduana->aduana());
        $this->assertSame($patente, $NumeroPedimentoAduana->patente());
        $this->assertSame($ejercicio, $NumeroPedimentoAduana->ejercicio());
        $this->assertSame($cantidad, $NumeroPedimentoAduana->cantidad());
        $this->assertSame($vigenteDesde, $NumeroPedimentoAduana->vigenteDesde());
        $this->assertSame($vigenteHasta, $NumeroPedimentoAduana->vigenteHasta());
    }
}
