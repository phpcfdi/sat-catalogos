<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class Moneda extends AbstractEntryIdentifiable
{
    /** @var int */
    private $decimales;

    /** @var int */
    private $porcentajeVariacion;

    public function __construct(
        string $id,
        string $texto,
        int $decimales,
        int $porcentajeVariacion,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        if ($decimales < 0) {
            throw new SatCatalogosLogicException('El campo decimales no puede ser menor a cero');
        }
        if ($porcentajeVariacion < 0) {
            throw new SatCatalogosLogicException('El campo porcentaje de variación no puede ser menor a cero');
        }
        $this->decimales = $decimales;
        $this->porcentajeVariacion = $porcentajeVariacion;
    }

    public function decimales(): int
    {
        return $this->decimales;
    }

    public function porcentajeVariacion(): int
    {
        return $this->porcentajeVariacion;
    }
}
