<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use DateTimeImmutable;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class HusoHorario
{
    /** @var string */
    private $text;

    /** @var HusoHorarioEstacion */
    private $verano;

    /** @var HusoHorarioEstacion */
    private $invierno;

    public function __construct(string $text, HusoHorarioEstacion $verano, HusoHorarioEstacion $invierno)
    {
        $this->text = $text;
        $this->verano = $verano;
        $this->invierno = $invierno;

        if ($verano->tieneCambioHorario() !== $invierno->tieneCambioHorario()) {
            throw new SatCatalogosLogicException(
                'No se puede crear un huso horario con estaciones donde solo una tiene cambio de horario'
            );
        }

        if (! $verano->tieneCambioHorario() and $verano->diferencia() !== $invierno->diferencia()) {
            throw new SatCatalogosLogicException(
                'El huso horario no tiene cambio de horario de verano pero tiene no tiene la misma diferencia horaria'
            );
        }
    }

    public function nombre(): string
    {
        return $this->text;
    }

    public function verano(): HusoHorarioEstacion
    {
        return $this->verano;
    }

    public function invierno(): HusoHorarioEstacion
    {
        return $this->invierno;
    }

    public function convertToDateTime(string $partialDate): DateTimeImmutable
    {
        $date = $this->dateTimeFromPartial($partialDate, $this->invierno->diferencia());

        // time zone does not have DST
        if (! $this->verano->tieneCambioHorario()) {
            return $date;
        }

        $year = (int) $date->format('Y');
        $dstSince = $this->dstLimit($year, $this->verano, $this->invierno->diferencia());
        $dstUntil = $this->dstLimit($year, $this->invierno, $this->invierno->diferencia());

        // is outside DST, nothing to change
        if ($date < $dstSince || $date >= $dstUntil) {
            return $date;
        }

        // is DST
        $dstHoursDiff = $this->verano->diferencia() - $this->invierno->diferencia();
        $dstSince = $dstSince->modify(sprintf('%d hours', $dstHoursDiff));
        $altered = $this->dateTimeFromPartial($partialDate, $this->verano->diferencia());
        if ($date < $dstSince) {
            $altered = $altered->modify(sprintf('%d hours', $dstHoursDiff));
        }
        return $altered;
    }

    private function dateTimeFromPartial(string $partialDate, int $hoursDiff): DateTimeImmutable
    {
        $sign = $hoursDiff < 0 ? '-' : '+';
        $iso8601 = sprintf('%s%s%02d00', $partialDate, $sign, abs($hoursDiff));
        /** @noinspection PhpUnhandledExceptionInspection */
        return new DateTimeImmutable($iso8601);
    }

    private function dstLimit(int $year, HusoHorarioEstacion $limit, int $hoursDiff): DateTimeImmutable
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $date = new DateTimeImmutable(sprintf('%04d-%02d-01 00:00:00 UTC', $year, $limit->mesNumerico()));
        $date = $date->modify($limit->diaExpresion());
        $date = $date->modify(sprintf('%d hours', $limit->horaNumero() - $hoursDiff));
        return $date;
    }
}
