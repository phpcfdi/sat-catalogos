<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Common;

interface EntryWithVigencias extends BaseEntry
{
    public function vigenteDesde(): int;

    public function vigenteHasta(): int;
}
