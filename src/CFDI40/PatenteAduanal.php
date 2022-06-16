<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;

class PatenteAduanal extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    public function __construct(string $id, int $vigenteDesde, int $vigenteHasta)
    {
        parent::__construct($id, $id, $vigenteDesde, $vigenteHasta);
    }
}
