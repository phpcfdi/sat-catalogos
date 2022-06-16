<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\HusoHorarioEstacion;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PHPUnit\Framework\TestCase;

final class HusoHorarioEstacionTest extends TestCase
{
    public function testConstructRegular(): void
    {
        $estacion = new HusoHorarioEstacion('Abril', 'Primer domingo', '02:00', -5);
        $this->assertSame('abril', $estacion->mes());
        $this->assertSame(4, $estacion->mesNumerico());
        $this->assertSame('primer domingo', $estacion->dia());
        $this->assertSame('first sunday of this month', $estacion->diaExpresion());
        $this->assertSame('02:00', $estacion->hora());
        $this->assertSame(-5, $estacion->diferencia());
        $this->assertTrue($estacion->tieneCambioHorario());
    }

    public function testConstructRegularNoCase(): void
    {
        $estacion = new HusoHorarioEstacion('ABRIL', 'PRIMER DOMINGO', '02:00', -5);
        $this->assertSame('abril', $estacion->mes());
        $this->assertSame(4, $estacion->mesNumerico());
        $this->assertSame('primer domingo', $estacion->dia());
        $this->assertSame('first sunday of this month', $estacion->diaExpresion());
        $this->assertSame('02:00', $estacion->hora());
        $this->assertSame(-5, $estacion->diferencia());
        $this->assertTrue($estacion->tieneCambioHorario());
    }

    public function testConstructEmpty(): void
    {
        $estacion = new HusoHorarioEstacion('', '', '', -7);
        $this->assertSame('', $estacion->mes());
        $this->assertSame(0, $estacion->mesNumerico());
        $this->assertSame('', $estacion->dia());
        $this->assertSame('', $estacion->diaExpresion());
        $this->assertSame('', $estacion->hora());
        $this->assertSame(-7, $estacion->diferencia());
        $this->assertFalse($estacion->tieneCambioHorario());
    }

    /**
     * Test that "mes, dia, hora" must be all or none defined
     *
     * @param string $mes
     * @param string $dia
     * @param string $hora
     * @testWith ["", "Primer domingo", "02:00"]
     * @testWith ["Abril", "", "02:00"]
     * @testWith ["Abril", "Primer domingo", ""]
     */
    public function testConstructMissingOne(string $mes, string $dia, string $hora): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('La definición del momento del cambio de horario está incompleta');
        new HusoHorarioEstacion($mes, $dia, $hora, -5);
    }

    /**
     * @param string $hour
     * @testWith ["02:01"]
     *           ["02:00 am"]
     *           ["2:00"]
     *           ["99:99"]
     *           ["0200"]
     */
    public function testConstructInvalidHour(string $hour): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage("La hora a la que inicia el cambio de horario \"$hour\" no es válida");
        new HusoHorarioEstacion('Abril', 'Primer domingo', $hour, -5);
    }

    public function testConstructInvalidHourGratherThan23(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('La hora a la que inicia el cambio de horario "24:00" no puede ser mayor a 23');
        new HusoHorarioEstacion('Abril', 'Primer domingo', '24:00', -5);
    }

    /**
     * @param int $diferencia
     * @param bool $expectException
     * @testWith [13, true]
     * @testWith [-13, true]
     * @testWith [12, false]
     * @testWith [-12, false]
     */
    public function testConstructWithDiffGreaterThanZero(int $diferencia, bool $expectException): void
    {
        if ($expectException) {
            $this->expectException(SatCatalogosLogicException::class);
            $this->expectExceptionMessage('La definición de diferencia de horario absoluta no puede ser mayor a 12');
            new HusoHorarioEstacion('', '', '', $diferencia);
            return;
        }

        $estacion = new HusoHorarioEstacion('', '', '', $diferencia);
        $this->assertSame($diferencia, $estacion->diferencia());
    }

    public function testConstructWithInvalidMonth(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El mes del huso horario "Foo" es desconocido');
        new HusoHorarioEstacion('Foo', 'Primer domingo', '02:00', -5);
    }

    public function testConstructWithInvalidDay(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El día de la semana del huso horario "Foo" es desconocido');
        new HusoHorarioEstacion('Abril', 'Foo', '02:00', -5);
    }
}
