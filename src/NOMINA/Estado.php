<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\NOMINA;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;

class Estado extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    public function __construct(string $estado, string $pais, string $texto)
    {
        $this->estado   = $estado;
        $this->pais     = $pais;
        $this->texto    = $texto;
    }
}
