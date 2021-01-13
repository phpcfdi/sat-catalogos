<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\CodigoPostal;
use PhpCfdi\SatCatalogos\CFDI\HusoHorario;
use PhpCfdi\SatCatalogos\CFDI\HusoHorarioEstacion;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PHPUnit\Framework\TestCase;

final class CodigoPostalTest extends TestCase
{
    private function createHusoHorario(): HusoHorario
    {
        return new HusoHorario(
            'Tiempo del Centro',
            new HusoHorarioEstacion('Abril', 'Primer domingo', '02:00', -5),
            new HusoHorarioEstacion('Octubre', 'Último domingo', '02:00', -6)
        );
    }

    public function testCreateInstance(): void
    {
        $id = '52000';
        $texto = '52000';
        $estado = 'MEX';
        $municipio = '051';
        $localidad = '';
        $estimuloFrontera = false;
        $husoHorario = $this->createHusoHorario();
        $vigenteDesde = 0;
        $vigenteHasta = strtotime('2019-01-13');

        $codigoPostal = new CodigoPostal(
            $id,
            $estado,
            $municipio,
            $localidad,
            $estimuloFrontera,
            $husoHorario,
            $vigenteDesde,
            $vigenteHasta
        );

        $this->assertInstanceOf(EntryIdentifiable::class, $codigoPostal);
        $this->assertSame($id, $codigoPostal->id());
        $this->assertSame($texto, $codigoPostal->texto());
        $this->assertSame($estado, $codigoPostal->estado());
        $this->assertSame($municipio, $codigoPostal->municipio());
        $this->assertSame($localidad, $codigoPostal->localidad());
        $this->assertSame($estimuloFrontera, $codigoPostal->estimuloFrontera());
        $this->assertSame($husoHorario, $codigoPostal->husoHorario());
        $this->assertSame($vigenteDesde, $codigoPostal->vigenteDesde());
        $this->assertSame($vigenteHasta, $codigoPostal->vigenteHasta());
    }

    public function testPropertyEstadoCannotBeEmpty(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo estado no puede ser una cadena de caracteres vacía');
        new CodigoPostal('52000', '', '', '', false, $this->createHusoHorario(), 0, 0);
    }

    /**
     * @param bool $estimuloFrontera
     * @testWith [true]
     *           [false]
     */
    public function testPropertyEstimuloFrontera(bool $estimuloFrontera): void
    {
        $husoHorario = $this->createHusoHorario();
        $codigoPostal = new CodigoPostal('52000', 'MEX', '051', '', $estimuloFrontera, $husoHorario, 0, 0);
        $this->assertSame($estimuloFrontera, $codigoPostal->estimuloFrontera());
    }
}
