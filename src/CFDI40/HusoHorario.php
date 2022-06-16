<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use DateTimeImmutable;
use Exception;
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
                'No se puede crear un huso horario con estaciones donde solo una tiene cambio de horario',
            );
        }

        if (! $verano->tieneCambioHorario() and $verano->diferencia() !== $invierno->diferencia()) {
            throw new SatCatalogosLogicException(
                'El huso horario no tiene cambio de horario de verano pero tiene no tiene la misma diferencia horaria',
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

    public function convertToDateTime(string $partialDateText): DateTimeImmutable
    {
        try {
            $partialDate = new DateTimeImmutable($partialDateText);
        } catch (Exception $exception) {
            throw new SatCatalogosLogicException(
                sprintf('No se puede entender la fecha hora "%s" como tal', $partialDateText),
            );
        }

        // time zone does not have DST
        if (! $this->verano->tieneCambioHorario()) {
            return $partialDate;
        }

        $date = $this->dateTimeFromPartial($partialDate, $this->invierno->diferencia());

        $year = (int) $date->format('Y');
        $dstSince = $this->dstLimit($year, $this->verano, $this->invierno->diferencia());
        $dstUntil = $this->dstLimit($year, $this->invierno, $this->invierno->diferencia());

        // is outside DST, nothing to change: NOT $dstSince <= $date < $dstUntil
        if ($date < $dstSince || $date >= $dstUntil) {
            return $date;
        }

        // is DST
        $dstHoursDiff = $this->verano->diferencia() - $this->invierno->diferencia();
        $dstSince = $dstSince->modify("{$dstHoursDiff} hours");
        $summerDate = $this->dateTimeFromPartial($partialDate, $this->verano->diferencia());
        if ($date < $dstSince) { // time is between a non-existent hour
            $summerDate = $summerDate->modify("{$dstHoursDiff} hours");
        }
        return $summerDate;
    }

    private function dateTimeFromPartial(DateTimeImmutable $partialDate, int $hoursDiff): DateTimeImmutable
    {
        $iso8601 = sprintf('%s%+02d00', $partialDate->format('Y-m-d\TH:i:s'), $hoursDiff);
        /** @noinspection PhpUnhandledExceptionInspection */
        return new DateTimeImmutable($iso8601);
    }

    private function dstLimit(int $year, HusoHorarioEstacion $limit, int $hoursDiff): DateTimeImmutable
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $date = new DateTimeImmutable(sprintf('%04d-%02d-01T00:00:00+000', $year, $limit->mesNumerico()));
        $date = $date->modify($limit->diaExpresion());
        $date = $date->modify(sprintf('%d hours', $limit->horaNumero() - $hoursDiff));
        return $date;
    }
}
