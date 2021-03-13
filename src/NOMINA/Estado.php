<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\NOMINA;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;

class Estado extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    /** @var string */
    public $estado;

    /** @var string */
    public $pais;

    public function __construct(string $estado, string $pais)
    {
        $this->estado   = $estado;
        $this->pais     = $pais;
    }
}
