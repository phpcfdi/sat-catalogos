<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class UsoCfdi extends AbstractEntryIdentifiable
{
    /** @var bool */
    private $aplicaFisica;

    /** @var bool */
    private $aplicaMoral;

    /** @var string */
    private $regimenesFiscalesReceptores;

    public function __construct(
        string $id,
        string $texto,
        bool $aplicaFisica,
        bool $aplicaMoral,
        string $regimenesFiscalesReceptores,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->aplicaFisica = $aplicaFisica;
        $this->aplicaMoral = $aplicaMoral;
        $this->regimenesFiscalesReceptores = $regimenesFiscalesReceptores;
    }

    public function aplicaFisica(): bool
    {
        return $this->aplicaFisica;
    }

    public function aplicaMoral(): bool
    {
        return $this->aplicaMoral;
    }

    public function regimenesFiscalesReceptores(): string
    {
        return $this->regimenesFiscalesReceptores;
    }

    /**
     * Return the list of "regimenes fiscales receptores"
     *
     * @return string[]
     */
    public function regimenesFiscalesReceptoresList(): array
    {
        return array_filter(array_map('trim', explode(',', $this->regimenesFiscalesReceptores)));
    }
}
