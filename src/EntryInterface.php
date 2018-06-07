<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

interface EntryInterface
{
    public function id(): string;

    public function texto(): string;

    public function vigenteDesde(): int;

    public function vigenteHasta(): int;
}
