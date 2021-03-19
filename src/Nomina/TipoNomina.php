<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;

class TipoNomina extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    // phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
    public function __construct(string $id, string $texto)
    {
        parent::__construct($id, $texto, 0, 0);
    }
}
