<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Pais;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PHPUnit\Framework\TestCase;

class PaisTest extends TestCase
{
    public function testCreateInstance()
    {
        $id = 'MEX';
        $texto = 'Cerdos';
        $patronCodigoPostal = '[0-9]{5}';
        $patronIdentidadTributaria = '[A-Z&Ñ]{3,4}[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{2}[0-9A]';
        $validacionIdentidadTributaria = 'Lista del SAT';
        $agrupaciones = 'TLCAN';

        $pais = new Pais(
            $id,
            $texto,
            $patronCodigoPostal,
            $patronIdentidadTributaria,
            $validacionIdentidadTributaria,
            $agrupaciones
        );

        $this->assertInstanceOf(EntryInterface::class, $pais);
        $this->assertSame($id, $pais->id());
        $this->assertSame($texto, $pais->texto());
        $this->assertContains($patronCodigoPostal, $pais->patronCodigoPostal());
        $this->assertContains($patronIdentidadTributaria, $pais->patronIdentidadTributaria());
        $this->assertSame($validacionIdentidadTributaria, $pais->validacionIdentidadTributaria());
        $this->assertSame($agrupaciones, $pais->agrupaciones());
    }

    /**
     * @param string $value
     * @param string $expected
     * @testWith ["", "/^\\V*$/"]
     *           ["[0-9]{10}", "/^[0-9]{10}$/"]
     */
    public function testPatronCodigoPostal(string $value, string $expected)
    {
        $pais = new Pais('x', 'x', $value, '', '', '');
        $this->assertSame($expected, $pais->patronCodigoPostal());
    }

    public function testPatronCodigoPostalInvalidPattern()
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('expresión regular');
        new Pais('x', 'x', ') invalid regexp (', '', '', '');
    }

    /**
     * @param string $value
     * @param string $expected
     * @testWith ["", "/^\\V*$/"]
     *           ["[0-9]{10}", "/^[0-9]{10}$/"]
     */
    public function testPatronIdentidadTributaria(string $value, string $expected)
    {
        $pais = new Pais('x', 'x', '', $value, '', '');
        $this->assertSame($expected, $pais->patronIdentidadTributaria());
    }

    public function testPatronIdentidadTributariaInvalidPattern()
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('expresión regular');
        new Pais('x', 'x', '', ') invalid regexp (', '', '');
    }
}
