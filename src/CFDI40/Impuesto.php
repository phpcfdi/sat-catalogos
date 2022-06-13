<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class Impuesto extends AbstractEntryIdentifiable
{
    /** @var bool */
    private $retencion;

    /** @var bool */
    private $traslado;

    /** @var string */
    private $ambito;

    public function __construct(
        string $id,
        string $texto,
        bool $retencion,
        bool $traslado,
        string $ambito,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->retencion = $retencion;
        $this->traslado = $traslado;
        $this->ambito = $ambito;
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
}
