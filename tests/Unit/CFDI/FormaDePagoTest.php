<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Builders\FormaDePagoBuilder;
use PhpCfdi\SatCatalogos\CFDI\FormaDePago;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Helpers\Patron;
use PHPUnit\Framework\TestCase;

class FormaDePagoTest extends TestCase
{
    protected function makeFormaDePago(array $values, string $id = 'foo')
    {
        return (new FormaDePagoBuilder())->make($id, $values);
    }

    public function testCreateInstance()
    {
        $id = '03';
        $texto = 'Transferencia electrónica de fondos';
        $esBancarizado = false;
        $requiereNumeroDeOperacion = false;
        $permiteBancoOrdenanteRfc = false;
        $permiteCuentaOrdenante = false;
        $patronCuentaOrdenante = '';
        $permiteBancoBeneficiarioRfc = false;
        $permiteCuentaBeneficiario = false;
        $patronCuentaBeneficiario = '';
        $permiteTipoCadenaPago = false;
        $requiereBancoOrdenanteNombreExt = false;
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = strtotime('2018-12-31');

        $FormaDePago = new FormaDePago(
            $id,
            $texto,
            $esBancarizado,
            $requiereNumeroDeOperacion,
            $permiteBancoOrdenanteRfc,
            $permiteCuentaOrdenante,
            $patronCuentaOrdenante,
            $permiteBancoBeneficiarioRfc,
            $permiteCuentaBeneficiario,
            $patronCuentaBeneficiario,
            $permiteTipoCadenaPago,
            $requiereBancoOrdenanteNombreExt,
            $vigenteDesde,
            $vigenteHasta
        );
        $this->assertInstanceOf(EntryInterface::class, $FormaDePago);

        $this->assertSame($id, $FormaDePago->id());
        $this->assertSame($texto, $FormaDePago->texto());
        $this->assertSame($esBancarizado, $FormaDePago->esBancarizado());
        $this->assertSame($requiereNumeroDeOperacion, $FormaDePago->requiereNumeroDeOperacion());
        $this->assertSame($vigenteDesde, $FormaDePago->vigenteDesde());
        $this->assertSame($vigenteHasta, $FormaDePago->vigenteHasta());
    }

    public function testEsBancarizado()
    {
        $this->assertTrue($this->makeFormaDePago(['esBancarizado' => true])->esBancarizado());
        $this->assertFalse($this->makeFormaDePago(['esBancarizado' => false])->esBancarizado());
    }

    public function testRequiereNumeroDeOperacion()
    {
        $this->assertTrue($this->makeFormaDePago(['requiereNumeroDeOperacion' => true])->requiereNumeroDeOperacion());
        $this->assertFalse($this->makeFormaDePago(['requiereNumeroDeOperacion' => false])->requiereNumeroDeOperacion());
    }

    public function testPermiteBancoOrdenanteRfc()
    {
        $this->assertTrue($this->makeFormaDePago(['permiteBancoOrdenanteRfc' => true])->permiteBancoOrdenanteRfc());
        $this->assertFalse($this->makeFormaDePago(['permiteBancoOrdenanteRfc' => false])->permiteBancoOrdenanteRfc());
    }

    public function testPermiteCuentaOrdenante()
    {
        $this->assertTrue($this->makeFormaDePago(['permiteCuentaOrdenante' => true])->permiteCuentaOrdenante());
        $this->assertFalse($this->makeFormaDePago(['permiteCuentaOrdenante' => false])->permiteCuentaOrdenante());
    }

    /**
     * @param string $value
     * @testWith ["", "/^$/"]
     *           ["[0-9]{10}", "/^[0-9]{10}$/"]
     */
    public function testPatronCuentaOrdenante(string $value)
    {
        $formaDePago = $this->makeFormaDePago(['patronCuentaOrdenante' => $value]);
        $this->assertSame($value, $formaDePago->patronCuentaOrdenante()->origen());
        $this->assertSame(Patron::VACIO_PERMITE_NADA, $formaDePago->patronCuentaOrdenante()->alEstarVacio());
    }

    public function testPermiteBancoBeneficiarioRfc()
    {
        $this->assertTrue(
            $this->makeFormaDePago(['permiteBancoBeneficiarioRfc' => true])->permiteBancoBeneficiarioRfc()
        );
        $this->assertFalse(
            $this->makeFormaDePago(['permiteBancoBeneficiarioRfc' => false])->permiteBancoBeneficiarioRfc()
        );
    }

    public function testPermiteCuentaBeneficiario()
    {
        $this->assertTrue($this->makeFormaDePago(['permiteCuentaBeneficiario' => true])->permiteCuentaBeneficiario());
        $this->assertFalse($this->makeFormaDePago(['permiteCuentaBeneficiario' => false])->permiteCuentaBeneficiario());
    }

    /**
     * @param string $value
     * @testWith [""]
     *           ["[0-9]{10}"]
     */
    public function testPatronCuentaBeneficiario(string $value)
    {
        $formaDePago = $this->makeFormaDePago(['patronCuentaBeneficiario' => $value]);
        $this->assertSame($value, $formaDePago->patronCuentaBeneficiario()->origen());
        $this->assertSame(Patron::VACIO_PERMITE_NADA, $formaDePago->patronCuentaBeneficiario()->alEstarVacio());
    }

    public function testPermiteTipoCadenaPago()
    {
        $this->assertTrue($this->makeFormaDePago(['permiteTipoCadenaPago' => true])->permiteTipoCadenaPago());
        $this->assertFalse($this->makeFormaDePago(['permiteTipoCadenaPago' => false])->permiteTipoCadenaPago());
    }

    public function testRequiereBancoOrdenanteNombreExt()
    {
        $this->assertTrue(
            $this->makeFormaDePago(['requiereBancoOrdenanteNombreExt' => true])->requiereBancoOrdenanteNombreExt()
        );
        $this->assertFalse(
            $this->makeFormaDePago(['requiereBancoOrdenanteNombreExt' => false])->requiereBancoOrdenanteNombreExt()
        );
    }
}
