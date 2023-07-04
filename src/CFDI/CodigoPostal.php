<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class CodigoPostal extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    /** @var string */
    private $estado;

    /** @var string */
    private $municipio;

    /** @var string */
    private $localidad;

    /** @var int */
    private $estimuloFrontera;

    /** @var HusoHorario */
    private $husoHorario;

    public function __construct(
        string $id,
        string $estado,
        string $municipio,
        string $localidad,
        int $estimuloFrontera,
        HusoHorario $husoHorario,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $id, $vigenteDesde, $vigenteHasta);
        if ('' === $estado) {
            throw new SatCatalogosLogicException('El campo estado no puede ser una cadena de caracteres vacía');
        }
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->localidad = $localidad;
        $this->estimuloFrontera = $estimuloFrontera;
        $this->husoHorario = $husoHorario;
    }

    public function estado(): string
    {
        return $this->estado;
    }

    public function municipio(): string
    {
        return $this->municipio;
    }

    public function localidad(): string
    {
        return $this->localidad;
    }

    public function estimuloFrontera(): int
    {
        return $this->estimuloFrontera;
    }

    public function hasEstimuloFrontera(): bool
    {
        return 0 !== $this->estimuloFrontera;
    }

    public function husoHorario(): HusoHorario
    {
        return $this->husoHorario;
    }
}
