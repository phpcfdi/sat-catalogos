<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\HusoHorario;
use PhpCfdi\SatCatalogos\CFDI\HusoHorarioEstacion;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PHPUnit\Framework\TestCase;

class HusoHorarioTest extends TestCase
{
    public function testConstructEmpty(): void
    {
        $verano = new HusoHorarioEstacion('', '', '', -5);
        $invierno = new HusoHorarioEstacion('', '', '', -5);
        $huso = new HusoHorario('', $verano, $invierno);

        $this->assertSame('', $huso->nombre());
        $this->assertSame($verano, $huso->verano());
        $this->assertSame($invierno, $huso->invierno());
    }

    public function testConstructNonEmpty(): void
    {
        $verano = new HusoHorarioEstacion('Abril', 'Primer domingo', '02:00', -5);
        $invierno = new HusoHorarioEstacion('Octubre', 'Último domingo', '02:00', -6);
        $huso = new HusoHorario('Tiempo del Centro', $verano, $invierno);

        $this->assertSame('Tiempo del Centro', $huso->nombre());
        $this->assertSame($verano, $huso->verano());
        $this->assertSame($invierno, $huso->invierno());
    }

    public function testConstructSummerAndWinterMustEqualSummerTimeFeature(): void
    {
        $verano = new HusoHorarioEstacion('', '', '', -5);
        $invierno = new HusoHorarioEstacion('Octubre', 'Último domingo', '02:00', -6);

        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage(
            'No se puede crear un huso horario con estaciones donde solo una tiene cambio de horario'
        );
        new HusoHorario('', $verano, $invierno);
    }

    public function testConstructSummerAndWinterDifferenceMustEqualWhenNoSummerTimeFeatureIsSet(): void
    {
        $verano = new HusoHorarioEstacion('', '', '', -5);
        $invierno = new HusoHorarioEstacion('', '', '', -6);

        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage(
            'El huso horario no tiene cambio de horario de verano pero tiene no tiene la misma diferencia horaria'
        );
        new HusoHorario('', $verano, $invierno);
    }
}
