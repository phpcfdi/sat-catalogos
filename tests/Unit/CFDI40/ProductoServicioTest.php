<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\ProductoServicio;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class ProductoServicioTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '10101511';
        $texto = 'Cerdos';
        $requiereIvaTrasladado = true;
        $requiereIepsTrasladado = true;
        $requiereComplemento = false;
        $complemento = '';
        $similares = 'Cerdo montés, Chanchos, Chanchos almizcleros';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;
        $estimuloFrontera = true;

        $productoServicio = new ProductoServicio(
            $id,
            $texto,
            $requiereIvaTrasladado,
            $requiereIepsTrasladado,
            $complemento,
            $similares,
            $estimuloFrontera,
            $vigenteDesde,
            $vigenteHasta,
        );

        $this->assertInstanceOf(EntryIdentifiable::class, $productoServicio);
        $this->assertSame($id, $productoServicio->id());
        $this->assertSame($texto, $productoServicio->texto());
        $this->assertSame($requiereIvaTrasladado, $productoServicio->requiereIvaTrasladado());
        $this->assertSame($requiereIepsTrasladado, $productoServicio->requiereIepsTrasladado());
        $this->assertSame($requiereComplemento, $productoServicio->requiereComplemento());
        $this->assertSame($complemento, $productoServicio->complemento());
        $this->assertSame($similares, $productoServicio->similares());
        $this->assertSame($estimuloFrontera, $productoServicio->estimuloFrontera());
        $this->assertSame($vigenteDesde, $productoServicio->vigenteDesde());
        $this->assertSame($vigenteHasta, $productoServicio->vigenteHasta());
    }

    /**
     * @param bool $requiereIvaTrasladado
     * @testWith [true]
     *           [false]
     */
    public function testPropertyRequiereIvaTrasladado(bool $requiereIvaTrasladado): void
    {
        $productoServicio = new ProductoServicio('x', 'x', $requiereIvaTrasladado, false, '', '', false, 0, 0);

        $this->assertSame($requiereIvaTrasladado, $productoServicio->requiereIvaTrasladado());
    }

    /**
     * @param bool $requiereIepsTrasladado
     * @testWith [true]
     *           [false]
     */
    public function testPropertyRequiereIepsTrasladado(bool $requiereIepsTrasladado): void
    {
        $productoServicio = new ProductoServicio('x', 'x', false, $requiereIepsTrasladado, '', '', false, 0, 0);

        $this->assertSame($requiereIepsTrasladado, $productoServicio->requiereIepsTrasladado());
    }

    /**
     * @param bool $expectedValue
     * @param string $complemento
     * @testWith [false, ""]
     *           [true, "Algun complemento"]
     */
    public function testPropertyRequiereComplemento(bool $expectedValue, string $complemento): void
    {
        $productoServicio = new ProductoServicio('x', 'x', false, false, $complemento, '', false, 0, 0);

        $this->assertSame($expectedValue, $productoServicio->requiereComplemento());
    }

    /**
     * @param bool $estimuloFrontera
     * @testWith [true]
     *           [false]
     */
    public function testPropertyEstimuloFrontera(bool $estimuloFrontera): void
    {
        $productoServicio = new ProductoServicio('x', 'x', false, false, '', '', $estimuloFrontera, 0, 0);
        $this->assertSame($estimuloFrontera, $productoServicio->estimuloFrontera());
    }
}
