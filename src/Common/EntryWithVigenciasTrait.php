<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Common;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

trait EntryWithVigenciasTrait
{
    /** @var int */
    private $vigenteDesde;

    /** @var int */
    private $vigenteHasta;

    protected function setUpVigencias(int $vigenteDesde, int $vigenteHasta): void
    {
        if ($vigenteDesde < 0) {
            throw new SatCatalogosLogicException('El campo vigente desde no puede ser menor a cero');
        }
        if ($vigenteHasta < 0) {
            throw new SatCatalogosLogicException('El campo vigente hasta no puede ser menor a cero');
        }
        $this->vigenteDesde = $vigenteDesde;
        $this->vigenteHasta = $vigenteHasta;
    }

    public function vigenteDesde(): int
    {
        return $this->vigenteDesde;
    }

    public function vigenteHasta(): int
    {
        return $this->vigenteHasta;
    }

    public function vigenteEn(int $timestamp): bool
    {
        if (0 !== $this->vigenteDesde && $timestamp < $this->vigenteDesde) {
            return false;
        }
        if (0 !== $this->vigenteHasta && $timestamp > $this->vigenteHasta) {
            return false;
        }
        return true;
    }

    public function vigenteAhora(): bool
    {
        return $this->vigenteEn(time());
    }
}
