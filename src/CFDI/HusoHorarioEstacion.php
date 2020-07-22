<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

class HusoHorarioEstacion
{
    private const MONTH_NUMBERS = [
        '',
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre',
    ];

    private const WEEK_DAYS = [
        'Primer domingo' => 'first sunday',
        'Segundo domingo' => 'second sunday',
        'Último domingo' => 'last sunday',
    ];

    /** @var string */
    private $month;

    /** @var int */
    private $monthNumber;

    /** @var string */
    private $weekDay;

    /** @var string */
    private $hour;

    /** @var int */
    private $utcDiff;

    public function __construct(string $month, string $weekDay, string $hour, int $utcDiff)
    {
        $this->month = $month;
        $this->weekDay = $weekDay;
        $this->hour = $hour;
        $this->utcDiff = $utcDiff;
        $monthNumber = array_search($month, self::MONTH_NUMBERS, true);
        if (false === $monthNumber) {
            throw new \LogicException(sprintf('El mes del huso horario "%s" es desconocido', $month));
        }
        $this->monthNumber = intval($monthNumber);
        if ('' !== $weekDay) {
            if (! array_key_exists($weekDay, self::WEEK_DAYS)) {
                throw new \LogicException('El día del huso horario "%s" es desconocido');
            }
        }
    }
}
