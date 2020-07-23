<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class RegimenFiscal extends AbstractEntryIdentifiable
{
    /** @var bool */
    private $aplicaFisica;

    /** @var bool */
    private $aplicaMoral;

    public function __construct(
        string $id,
        string $texto,
        bool $aplicaFisica,
        bool $aplicaMoral,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->aplicaFisica = $aplicaFisica;
        $this->aplicaMoral = $aplicaMoral;
    }

    public function aplicaFisica(): bool
    {
        return $this->aplicaFisica;
    }

    public function aplicaMoral(): bool
    {
        return $this->aplicaMoral;
    }
}
