<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class Banco extends AbstractEntryIdentifiable
{
    /** @var string */
    private $razonSocial;

    public function __construct(string $id, string $texto, string $razonSocial, int $vigenteDesde, int $vigenteHasta)
    {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->razonSocial = $razonSocial;
    }

    public function razonSocial(): string
    {
        return $this->razonSocial;
    }
}
