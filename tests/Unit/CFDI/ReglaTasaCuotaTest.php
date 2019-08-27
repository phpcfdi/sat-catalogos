<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\ReglaTasaCuota;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\VigenciasInterface;
use PHPUnit\Framework\TestCase;

class ReglaTasaCuotaTest extends TestCase
{
    public function testCreateRango(): ReglaTasaCuota
    {
        $tipo = 'Rango';
        $impuesto = 'IEPS';
        $factor = 'Cuota';
        $traslado = true;
        $retencion = true;
        $minimo = '1.000000';
        $valor = '43.770000';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = strtotime('2018-12-31');

        $reglaTasaCuota = new ReglaTasaCuota(
            $tipo,
            $impuesto,
            $factor,
            $traslado,
            $retencion,
            $minimo,
            $valor,
            $vigenteDesde,
            $vigenteHasta
        );

        $this->assertInstanceOf(VigenciasInterface::class, $reglaTasaCuota);

        $this->assertSame($tipo, $reglaTasaCuota->tipo());
        $this->assertSame($impuesto, $reglaTasaCuota->impuesto());
        $this->assertSame($factor, $reglaTasaCuota->factor());
        $this->assertSame($traslado, $reglaTasaCuota->traslado());
        $this->assertSame($retencion, $reglaTasaCuota->retencion());
        $this->assertSame($minimo, $reglaTasaCuota->minimo());
        $this->assertSame($valor, $reglaTasaCuota->maximo());
        $this->assertSame($vigenteDesde, $reglaTasaCuota->vigenteDesde());
        $this->assertSame($vigenteHasta, $reglaTasaCuota->vigenteHasta());

        return $reglaTasaCuota;
    }

    public function testCreateFijo(): ReglaTasaCuota
    {
        $reglaTasaCuota = new ReglaTasaCuota('Fijo', 'IVA', 'Tasa', true, true, '', '0.160000', 0, 0);

        $this->assertSame('Fijo', $reglaTasaCuota->tipo());
        $this->assertSame('0.160000', $reglaTasaCuota->valor());

        return $reglaTasaCuota;
    }

    /**
     * @param string $input
     * @testWith ["Foo"]
     *           [""]
     */
    public function testConstructWithInvalidTipo(string $input): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo tipo no tiene uno de los valores permitidos');
        new ReglaTasaCuota($input, 'IVA', 'Tasa', true, false, '0', '1', 0, 0);
    }

    /**
     * @param string $input
     * @testWith ["Foo"]
     *           [""]
     */
    public function testConstructWithInvalidImpuesto(string $input): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo impuesto no tiene uno de los valores permitidos');
        new ReglaTasaCuota('Fijo', $input, 'Tasa', true, false, '0', '1', 0, 0);
    }

    /**
     * @param string $input
     * @testWith ["Foo"]
     *           [""]
     */
    public function testConstructWithInvalidFactor(string $input): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo factor no tiene uno de los valores permitidos');
        new ReglaTasaCuota('Fijo', 'IVA', $input, true, false, '0', '1', 0, 0);
    }

    /**
     * @param bool $traslado
     * @testWith [true]
     *           [false]
     */
    public function testPropertyTraslado(bool $traslado): void
    {
        $regimenFiscal = new ReglaTasaCuota('Fijo', 'IVA', 'Tasa', $traslado, true, '0', '1', 0, 0);

        $this->assertSame($traslado, $regimenFiscal->traslado());
    }

    /**
     * @param bool $retencion
     * @testWith [true]
     *           [false]
     */
    public function testPropertyRetencion(bool $retencion): void
    {
        $regimenFiscal = new ReglaTasaCuota('Fijo', 'IVA', 'Tasa', true, $retencion, '0', '1', 0, 0);

        $this->assertSame($retencion, $regimenFiscal->retencion());
    }

    public function testConstructWithFalseTrasladoFalseRetencion(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('Los campos retención y traslado no pueden ser falsos ambos');
        new ReglaTasaCuota('Fijo', 'IVA', 'Tasa', false, false, '0', '1', 0, 0);
    }

    /**
     * @param ReglaTasaCuota $reglaTasaCuota
     * @depends testCreateRango
     */
    public function testRangoValidValues(ReglaTasaCuota $reglaTasaCuota): void
    {
        $values = [
            'min value' => '1',
            'min value with 6 decimals' => '1.000000',
            'between value' => '12.123456',
            'max value' => '43.77',
            'max value with 6 decimals' => '43.770000',
        ];

        foreach ($values as $case => $value) {
            $this->assertTrue(
                $reglaTasaCuota->valorIsValid($value),
                sprintf('The value %s in case %s was expected to be valid', $value, $case)
            );
        }
    }

    /**
     * @param ReglaTasaCuota $reglaTasaCuota
     * @depends testCreateRango
     */
    public function testRangoInvalidValues(ReglaTasaCuota $reglaTasaCuota): void
    {
        $values = [
            'below min limit' => '0.999999',
            'above max limit' => '43.770001',
            'more integers than allowed' => '000.000000',
            'more decimals than allowed' => '00.0000000',
            'invalid negative symbol' => '-',
            'char' => 'a',
            'with spaces' => ' 10.0 ',
        ];

        foreach ($values as $case => $value) {
            $this->assertFalse(
                $reglaTasaCuota->valorIsValid($value),
                sprintf('The value %s in case %s was expected to be valid', $value, $case)
            );
        }
    }

    /**
     * @param ReglaTasaCuota $reglaTasaCuota
     * @depends testCreateFijo
     */
    public function testFijoValidValues(ReglaTasaCuota $reglaTasaCuota): void
    {
        $this->assertTrue($reglaTasaCuota->valorIsValid('0.160000'));
    }

    /**
     * @param ReglaTasaCuota $reglaTasaCuota
     * @depends testCreateFijo
     */
    public function testFijoInvalidValues(ReglaTasaCuota $reglaTasaCuota): void
    {
        $this->assertFalse($reglaTasaCuota->valorIsValid('0.160001'));
    }
}
