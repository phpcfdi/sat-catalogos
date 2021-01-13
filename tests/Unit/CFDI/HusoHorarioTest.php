<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\HusoHorario;
use PhpCfdi\SatCatalogos\CFDI\HusoHorarioEstacion;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PHPUnit\Framework\TestCase;

final class HusoHorarioTest extends TestCase
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

    public function testConstructSummerAndWinterMustEqualDst(): void
    {
        $verano = new HusoHorarioEstacion('', '', '', -5);
        $invierno = new HusoHorarioEstacion('Octubre', 'Último domingo', '02:00', -6);

        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage(
            'No se puede crear un huso horario con estaciones donde solo una tiene cambio de horario'
        );
        new HusoHorario('', $verano, $invierno);
    }

    public function testConstructSummerAndWinterDifferenceMustEqualWhenNoDstIsSet(): void
    {
        $verano = new HusoHorarioEstacion('', '', '', -5);
        $invierno = new HusoHorarioEstacion('', '', '', -6);

        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage(
            'El huso horario no tiene cambio de horario de verano pero tiene no tiene la misma diferencia horaria'
        );
        new HusoHorario('', $verano, $invierno);
    }

    /**
     * Verify that SAT Time Zone can convert from partial date to a DateTime with DateTimeZone
     * including skipping the "non-existent" time at the beginning of the summer.
     *
     * @param string $partialDate
     * @param string $expected
     *
     * @testWith ["2020-02-14T15:16:17", "2020-02-14T15:16:17-08:00"]
     *           ["2020-03-08T01:59:59", "2020-03-08T01:59:59-08:00"]
     *           ["2020-03-08T02:00:00", "2020-03-08T03:00:00-07:00"]
     *           ["2020-03-08T02:00:01", "2020-03-08T03:00:01-07:00"]
     *           ["2020-03-08T03:00:00", "2020-03-08T03:00:00-07:00"]
     *           ["2020-06-14T15:16:17", "2020-06-14T15:16:17-07:00"]
     *           ["2020-11-01T01:59:59", "2020-11-01T01:59:59-07:00"]
     *           ["2020-11-01T02:00:00", "2020-11-01T02:00:00-08:00"]
     *           ["2020-11-01T02:00:01", "2020-11-01T02:00:01-08:00"]
     *           ["2020-12-14T15:16:17", "2020-12-14T15:16:17-08:00"]
     */
    public function testConvertToDateTime(string $partialDate, string $expected): void
    {
        // Tiempo del Noroeste en Frontera|Marzo|Segundo domingo|02:00|-7|Noviembre|Primer domingo|02:00|-8
        // El horario "normal" es UTC-8, el de verano es UTC-7 desde 2020-03-08 02:00 hasta 2020-11-01 02:00
        $huso = new HusoHorario(
            'Tiempo del Noroeste en Frontera',
            new HusoHorarioEstacion('Marzo', 'Segundo domingo', '02:00', -7),
            new HusoHorarioEstacion('Noviembre', 'Primer domingo', '02:00', -8),
        );

        $converted = $huso->convertToDateTime($partialDate);

        $this->assertSame($expected, $converted->format('c'));
    }

    public function testConvertToDateTimeWhenDoesNotHaveDailySavingTimesUseDefaultTimeZone(): void
    {
        $husoWithoutDst = new HusoHorario(
            'Tiempo Sin DST de Verano',
            new HusoHorarioEstacion('', '', '', 0),
            new HusoHorarioEstacion('', '', '', 0),
        );
        $currentTimeZone = date_default_timezone_get();
        date_default_timezone_set('America/Mexico_City');
        try {
            $converted = $husoWithoutDst->convertToDateTime('2021-01-13T14:15:16');
            $this->assertSame('2021-01-13T14:15:16-06:00', $converted->format('c'));
        } finally {
            date_default_timezone_set($currentTimeZone);
        }
    }

    public function testConvertToDateTimeWhenInputIsInvalidText(): void
    {
        $huso = new HusoHorario(
            'Tiempo del Noroeste en Frontera',
            new HusoHorarioEstacion('Marzo', 'Segundo domingo', '02:00', -7),
            new HusoHorarioEstacion('Noviembre', 'Primer domingo', '02:00', -8),
        );

        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('"foo"');
        $huso->convertToDateTime('foo');
    }
}
