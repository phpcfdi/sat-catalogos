<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Pais;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Exceptions\PatronException;
use PHPUnit\Framework\TestCase;

final class PaisTest extends TestCase
{
    public function testCreateInstance(): void
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

        $this->assertInstanceOf(EntryIdentifiable::class, $pais);
        $this->assertSame($id, $pais->id());
        $this->assertSame($texto, $pais->texto());
        $this->assertSame($patronCodigoPostal, $pais->patronCodigoPostal()->origen());
        $this->assertSame($patronIdentidadTributaria, $pais->patronIdentidadTributaria()->origen());
        $this->assertSame($validacionIdentidadTributaria, $pais->validacionIdentidadTributaria());
        $this->assertSame($agrupaciones, $pais->agrupaciones());
    }

    /**
     * @param string $value
     * @testWith [""]
     *           ["[0-9]{10}"]
     */
    public function testPatronCodigoPostal(string $value): void
    {
        $pais = new Pais('x', 'x', $value, '', '', '');
        $this->assertSame($value, $pais->patronCodigoPostal()->origen());
    }

    public function testPatronCodigoPostalInvalidPattern(): void
    {
        $this->expectException(PatronException::class);
        new Pais('x', 'x', ') invalid regexp (', '', '', '');
    }

    /**
     * @param string $value
     * @testWith [""]
     *           ["[0-9]{10}"]
     */
    public function testPatronIdentidadTributaria(string $value): void
    {
        $pais = new Pais('x', 'x', '', $value, '', '');
        $this->assertSame($value, $pais->patronIdentidadTributaria()->origen());
    }

    public function testPatronIdentidadTributariaInvalidPattern(): void
    {
        $this->expectException(PatronException::class);
        new Pais('x', 'x', '', ') invalid regexp (', '', '');
    }
}
