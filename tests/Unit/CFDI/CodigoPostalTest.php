<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\CodigoPostal;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PHPUnit\Framework\TestCase;

class CodigoPostalTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '52000';
        $texto = '52000';
        $estado = 'MEX';
        $municipio = '051';
        $localidad = '';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $codigoPostal = new CodigoPostal($id, $estado, $municipio, $localidad);

        $this->assertInstanceOf(EntryInterface::class, $codigoPostal);
        $this->assertSame($id, $codigoPostal->id());
        $this->assertSame($texto, $codigoPostal->texto());
        $this->assertSame($estado, $codigoPostal->estado());
        $this->assertSame($municipio, $codigoPostal->municipio());
        $this->assertSame($localidad, $codigoPostal->localidad());
        $this->assertSame($vigenteDesde, $codigoPostal->vigenteDesde());
        $this->assertSame($vigenteHasta, $codigoPostal->vigenteHasta());
    }

    public function testPropertyEstadoCannotBeEmpty(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo estado no puede ser una cadena de caracteres vacía');
        new CodigoPostal('52000', '', '', '');
    }
}
