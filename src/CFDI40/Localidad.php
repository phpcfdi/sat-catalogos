<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PhpCfdi\SatCatalogos\Common\EntryWithVigenciasTrait;

class Localidad implements EntryWithVigencias
{
    use EntryWithVigenciasTrait;

    /** @var string */
    private $codigo;

    /** @var string */
    private $estado;

    /** @var string*/
    private $texto;

    public function __construct(string $codigo, string $estado, string $texto, int $vigenteDesde, int $vigenteHasta)
    {
        $this->codigo = $codigo;
        $this->estado = $estado;
        $this->texto = $texto;
        $this->setUpVigencias($vigenteDesde, $vigenteHasta);
    }

    public function codigo(): string
    {
        return $this->codigo;
    }

    public function estado(): string
    {
        return $this->estado;
    }

    public function texto(): string
    {
        return $this->texto;
    }
}
