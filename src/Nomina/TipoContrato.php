<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class TipoContrato extends AbstractEntryIdentifiable
{
    // phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
    public function __construct(string $id, string $texto)
    {
        parent::__construct($id, $texto, 0, 0);
    }
}
