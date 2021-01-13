<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\NumeroPedimentoAduana;
use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PHPUnit\Framework\TestCase;

final class NumeroPedimentoAduanaTest extends TestCase
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

        $this->assertInstanceOf(EntryWithVigencias::class, $numeroPedimentoAduana);

        $this->assertSame($aduana, $numeroPedimentoAduana->aduana());
        $this->assertSame($patente, $numeroPedimentoAduana->patente());
        $this->assertSame($ejercicio, $numeroPedimentoAduana->ejercicio());
        $this->assertSame($cantidad, $numeroPedimentoAduana->cantidad());
        $this->assertSame($vigenteDesde, $numeroPedimentoAduana->vigenteDesde());
        $this->assertSame($vigenteHasta, $numeroPedimentoAduana->vigenteHasta());
    }

    public function testConstructWithoutAduana(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo aduana no puede ser una cadena de caracteres vacía');
        new NumeroPedimentoAduana('', '', 0, 0, 0, 0);
    }

    public function testConstructWithoutPatente(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo patente no puede ser una cadena de caracteres vacía');
        new NumeroPedimentoAduana('24', '', 0, 0, 0, 0);
    }

    public function testConstructWithoutEjercicio(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo ejercicio no puede ser menor a cero');
        new NumeroPedimentoAduana('24', '9876', -1, 0, 0, 0);
    }

    public function testConstructWithoutCantidad(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo cantidad no puede ser menor a cero');
        new NumeroPedimentoAduana('24', '9876', 0, -1, 0, 0);
    }
}
