<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class Impuesto extends AbstractEntryIdentifiable
{
    /** @var bool */
    private $retencion;

    /** @var bool */
    private $traslado;

    /** @var string */
    private $ambito;

    /** @var string */
    private $entidad;

    public function __construct(
        string $id,
        string $texto,
        bool $retencion,
        bool $traslado,
        string $ambito,
        string $entidad
    ) {
        parent::__construct($id, $texto, 0, 0);
        $this->retencion = $retencion;
        $this->traslado = $traslado;
        $this->ambito = $ambito;
        $this->entidad = $entidad;
    }

    public function retencion(): bool
    {
        return $this->retencion;
    }

    public function traslado(): bool
    {
        return $this->traslado;
    }

    public function ambito(): string
    {
        return $this->ambito;
    }

    public function entidad(): string
    {
        return $this->entidad;
    }
}
