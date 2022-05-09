<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;

class ProductoServicio extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    /** @var bool */
    private $requiereIvaTrasladado;

    /** @var bool */
    private $requiereIepsTrasladado;

    /** @var bool */
    private $requiereComplemento;

    /** @var string */
    private $complemento;

    /** @var string */
    private $similares;

    /** @var bool */
    private $estimuloFrontera;

    public function __construct(
        string $id,
        string $texto,
        bool $requiereIvaTrasladado,
        bool $requiereIepsTrasladado,
        string $complemento,
        string $similares,
        bool $estimuloFrontera,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->requiereIvaTrasladado = $requiereIvaTrasladado;
        $this->requiereIepsTrasladado = $requiereIepsTrasladado;
        $this->requiereComplemento = ('' !== $complemento);
        $this->complemento = $complemento;
        $this->similares = $similares;
        $this->estimuloFrontera = $estimuloFrontera;
    }

    public function requiereIvaTrasladado(): bool
    {
        return $this->requiereIvaTrasladado;
    }

    public function requiereIepsTrasladado(): bool
    {
        return $this->requiereIepsTrasladado;
    }

    public function requiereComplemento(): bool
    {
        return $this->requiereComplemento;
    }

    public function complemento(): string
    {
        return $this->complemento;
    }

    public function similares(): string
    {
        return $this->similares;
    }

    public function estimuloFrontera(): bool
    {
        return $this->estimuloFrontera;
    }
}
