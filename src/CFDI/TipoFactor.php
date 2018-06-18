<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractEntry;
use PhpCfdi\SatCatalogos\EntryInterface;

class TipoFactor extends AbstractEntry implements EntryInterface
{
    public function __construct(string $id)
    {
        parent::__construct($id, $id, 0, 0);
    }
}
