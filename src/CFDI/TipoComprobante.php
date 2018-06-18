<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractEntry;

class TipoComprobante extends AbstractEntry
{
    /** @var string */
    private $valorMaximo;

    public function __construct(string $id, string $texto, string $valorMaximo, int $vigenteDesde, int $vigenteHasta)
    {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->valorMaximo = $valorMaximo;
    }

    public function valorMaximo(): string
    {
        return $this->valorMaximo;
    }
}
