<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\NOMINA;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class OrigenRecurso extends AbstractEntryIdentifiable
{
    public function __construct(string $id, string $texto, int $vigenteDesde, int $vigenteHasta)
    {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
    }
}
