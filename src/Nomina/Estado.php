<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

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
        int $vigenteDesde = 0,
        int $vigenteHasta = 0
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
