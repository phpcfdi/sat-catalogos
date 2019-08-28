<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;

class TipoFactor extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    public function __construct(string $id)
    {
        parent::__construct($id, $id, 0, 0);
    }
}
