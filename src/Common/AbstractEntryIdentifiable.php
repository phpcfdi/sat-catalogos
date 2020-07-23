<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Common;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

abstract class AbstractEntryIdentifiable implements EntryIdentifiable
{
    use EntryWithVigenciasTrait;

    /** @var string */
    private $id;

    /** @var string */
    private $texto;

    public function __construct(string $id, string $texto, int $vigenteDesde, int $vigenteHasta)
    {
        if ('' === $id) {
            throw new SatCatalogosLogicException('El campo ID no puede ser una cadena de caracteres vacía');
        }
        if ('' === $texto) {
            throw new SatCatalogosLogicException('El campo texto no puede ser una cadena de caracteres vacía');
        }
        $this->id = $id;
        $this->texto = $texto;
        $this->setUpVigencias($vigenteDesde, $vigenteHasta);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function texto(): string
    {
        return $this->texto;
    }
}
