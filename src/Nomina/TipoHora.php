<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class TipoHora extends AbstractEntryIdentifiable
{
    public function __construct(string $id, string $texto, int $vigenteDesde, int $vigenteHasta)
    {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
    }
}
