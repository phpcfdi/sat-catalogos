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
        'primer domingo' => 'first sunday of this month',
        'segundo domingo' => 'second sunday of this month',
        'último domingo' => 'last sunday of this month',
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
    private $time;

    /** @var int */
    private $timeHour;

    /** @var int */
    private $utcDiff;

    public function __construct(string $month, string $weekDay, string $time, int $utcDiff)
    {
        $this->month = mb_strtolower($month);
        $this->weekDay = mb_strtolower($weekDay);
        $this->time = $time;
        $this->timeHour = 0;
        $this->utcDiff = $utcDiff;

        $empties = intval('' !== $month) + intval('' !== $weekDay) + intval('' !== $time);
        if (0 !== $empties && 3 !== $empties) {
            throw new SatCatalogosLogicException('La definición del momento del cambio de horario está incompleta');
        }

        if (abs($utcDiff) > 12) {
            throw new SatCatalogosLogicException(
                'La definición de diferencia de horario absoluta no puede ser mayor a 12',
            );
        }

        $this->monthNumber = self::MONTH_NUMBERS[$this->month] ?? 0;
        if (0 === $this->monthNumber && '' !== $month) {
            throw new SatCatalogosLogicException(sprintf('El mes del huso horario "%s" es desconocido', $month));
        }

        $this->weekDayToTime = self::WEEK_DAYS[$this->weekDay] ?? '';
        if ('' === $this->weekDayToTime && '' !== $weekDay) {
            throw new SatCatalogosLogicException(
                sprintf('El día de la semana del huso horario "%s" es desconocido', $weekDay),
            );
        }

        if ('' !== $this->time) {
            if (! boolval(preg_match('/^\d\d:00$/', $this->time))) {
                throw new SatCatalogosLogicException(
                    sprintf('La hora a la que inicia el cambio de horario "%s" no es válida', $this->time),
                );
            }
            $this->timeHour = intval(substr($this->time, 0, 2));
            if ($this->timeHour > 23) {
                throw new SatCatalogosLogicException(
                    sprintf('La hora a la que inicia el cambio de horario "%s" no puede ser mayor a 23', $this->time),
                );
            }
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
        return $this->time;
    }

    public function horaNumero(): int
    {
        return $this->timeHour;
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
