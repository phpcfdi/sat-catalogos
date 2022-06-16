<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Moneda;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PHPUnit\Framework\TestCase;

final class MonedaTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'MXN';
        $texto = 'Peso Mexicano';
        $decimales = 2;
        $porcentajeVariacion = 500;
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $moneda = new Moneda($id, $texto, $decimales, $porcentajeVariacion, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $moneda);
        $this->assertSame($id, $moneda->id());
        $this->assertSame($texto, $moneda->texto());
        $this->assertSame($decimales, $moneda->decimales());
        $this->assertSame($porcentajeVariacion, $moneda->porcentajeVariacion());
        $this->assertSame($vigenteDesde, $moneda->vigenteDesde());
        $this->assertSame($vigenteHasta, $moneda->vigenteHasta());
    }

    public function testPropertyDecimalesCannotBeLessThanZero(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo decimales no puede ser menor a cero');
        new Moneda('x', 'x', -1, 0, 0, 0);
    }

    public function testPropertyPorcentajeVariacionCannotBeLessThanZero(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo porcentaje de variación no puede ser menor a cero');
        new Moneda('x', 'x', 0, -1, 0, 0);
    }
}
