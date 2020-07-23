<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class HusoHorarioEstacion
{
    /** @var array<string, int> */
    private const MONTH_NUMBERS = [
        'enero' => 1,
        'febrero' => 2,
        'marzo' => 3,
        'abril' => 4,
        'mayo' => 5,
        'junio' => 6,
        'julio' => 7,
        'agosto' => 8,
        'septiembre' => 9,
        'octubre' => 10,
        'noviembre' => 11,
        'diciembre' => 12,
    ];

    private const WEEK_DAYS = [
        'primer domingo' => 'first sunday',
        'segundo domingo' => 'second sunday',
        'último domingo' => 'last sunday',
    ];

    /** @var string */
    private $month;

    /** @var int */
    private $monthNumber;

    /** @var string */
    private $weekDay;

    /** @var string */
    private $weekDayToTime;

    /** @var string */
    private $hour;

    /** @var int */
    private $utcDiff;

    public function __construct(string $month, string $weekDay, string $hour, int $utcDiff)
    {
        $this->month = mb_strtolower($month);
        $this->weekDay = mb_strtolower($weekDay);
        $this->hour = $hour;
        $this->utcDiff = $utcDiff;

        $empties = intval('' !== $month) + intval('' !== $weekDay) + intval('' !== $hour);
        if (0 !== $empties && 3 !== $empties) {
            throw new SatCatalogosLogicException('La definición del momento del cambio de horario está incompleta');
        }

        if (abs($utcDiff) > 12) {
            throw new SatCatalogosLogicException(
                'La definición de diferencia de horario absoluta no puede ser mayor a 12'
            );
        }

        $this->monthNumber = self::MONTH_NUMBERS[$this->month] ?? 0;
        if (0 === $this->monthNumber && '' !== $month) {
            throw new SatCatalogosLogicException(sprintf('El mes del huso horario "%s" es desconocido', $month));
        }

        $this->weekDayToTime = self::WEEK_DAYS[$this->weekDay] ?? '';
        if ('' === $this->weekDayToTime && '' !== $weekDay) {
            throw new SatCatalogosLogicException(
                sprintf('El día de la semana del huso horario "%s" es desconocido', $weekDay)
            );
        }
    }

    public function mes(): string
    {
        return $this->month;
    }

    public function mesNumerico(): int
    {
        return $this->monthNumber;
    }

    public function dia(): string
    {
        return $this->weekDay;
    }

    public function diaExpresion(): string
    {
        return $this->weekDayToTime;
    }

    public function hora(): string
    {
        return $this->hour;
    }

    public function diferencia(): int
    {
        return $this->utcDiff;
    }

    public function tieneCambioHorario(): bool
    {
        return (0 !== $this->monthNumber);
    }
}
