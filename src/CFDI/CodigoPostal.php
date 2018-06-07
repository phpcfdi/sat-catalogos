<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractEntry;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class CodigoPostal extends AbstractEntry implements EntryInterface
{
    /** @var string */
    private $estado;

    /** @var string */
    private $municipio;

    /** @var string */
    private $localidad;

    public function __construct(string $id, string $estado, string $municipio, string $localidad)
    {
        parent::__construct($id, $id, 0, 0);
        if ('' === $estado) {
            throw new SatCatalogosLogicException('El campo estado no puede ser una cadena de caracteres vacía');
        }
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->localidad = $localidad;
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
}
