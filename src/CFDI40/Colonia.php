<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\BaseEntry;

class Colonia implements BaseEntry
{
    /** @var string */
    private $colonia;

    /** @var string */
    private $codigoPostal;

    /** @var string*/
    private $asentamiento;

    public function __construct(string $colonia, string $codigoPostal, string $asentamiento)
    {
        $this->colonia = $colonia;
        $this->codigoPostal = $codigoPostal;
        $this->asentamiento = $asentamiento;
    }

    public function colonia(): string
    {
        return $this->colonia;
    }

    public function codigoPostal(): string
    {
        return $this->codigoPostal;
    }

    public function asentamiento(): string
    {
        return $this->asentamiento;
    }
}
