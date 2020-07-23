<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

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
}
