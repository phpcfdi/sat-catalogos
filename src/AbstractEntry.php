<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

abstract class AbstractEntry implements EntryInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $texto;

    /** @var int */
    private $vigenteDesde;

    /** @var int */
    private $vigenteHasta;

    public function __construct(string $id, string $texto, int $vigenteDesde, int $vigenteHasta)
    {
        if ('' === $id) {
            throw new SatCatalogosLogicException('El campo ID no puede ser una cadena de caracteres vacía');
        }
        if ('' === $texto) {
            throw new SatCatalogosLogicException('El campo texto no puede ser una cadena de caracteres vacía');
        }
        if ($vigenteDesde < 0) {
            throw new SatCatalogosLogicException('El campo vigente desde no puede ser menor a cero');
        }
        if ($vigenteHasta < 0) {
            throw new SatCatalogosLogicException('El campo vigente hasta no puede ser menor a cero');
        }
        $this->id = $id;
        $this->texto = $texto;
        $this->vigenteDesde = $vigenteDesde;
        $this->vigenteHasta = $vigenteHasta;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function texto(): string
    {
        return $this->texto;
    }

    public function vigenteDesde(): int
    {
        return $this->vigenteDesde;
    }

    public function vigenteHasta(): int
    {
        return $this->vigenteHasta;
    }
}
