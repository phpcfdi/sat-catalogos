<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PhpCfdi\SatCatalogos\Common\EntryWithVigenciasTrait;

class Estado implements EntryWithVigencias
{
    use EntryWithVigenciasTrait;

    /** @var string */
    private $codigo;

    /** @var string */
    private $pais;

    /** @var string */
    private $texto;

    public function __construct(
        string $codigo,
        string $pais,
        string $texto,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        $this->codigo = $codigo;
        $this->pais = $pais;
        $this->texto = $texto;
        $this->setUpVigencias($vigenteDesde, $vigenteHasta);
    }

    public function codigo(): string
    {
        return $this->codigo;
    }

    public function pais(): string
    {
        return $this->pais;
    }

    public function texto(): string
    {
        return $this->texto;
    }
}
