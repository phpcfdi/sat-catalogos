<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

interface EntryInterface extends VigenciasInterface
{
    public function id(): string;

    public function texto(): string;
}
