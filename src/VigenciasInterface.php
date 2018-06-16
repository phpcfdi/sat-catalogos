<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

interface VigenciasInterface
{
    public function vigenteDesde(): int;

    public function vigenteHasta(): int;
}
