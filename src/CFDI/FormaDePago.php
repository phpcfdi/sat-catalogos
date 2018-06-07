<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractEntry;
use PhpCfdi\SatCatalogos\EntryInterface;

class FormaDePago extends AbstractEntry implements EntryInterface
{
    /** @var bool */
    private $esBancarizado;

    /** @var bool */
    private $requiereNumeroDeOperacion;

    public function __construct(
        string $id,
        string $texto,
        bool $esBancarizado,
        bool $requiereNumeroDeOperacion,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->esBancarizado = $esBancarizado;
        $this->requiereNumeroDeOperacion = $requiereNumeroDeOperacion;
    }

    public function esBancarizado(): bool
    {
        return $this->esBancarizado;
    }

    public function requiereNumeroDeOperacion(): bool
    {
        return $this->requiereNumeroDeOperacion;
    }
}
