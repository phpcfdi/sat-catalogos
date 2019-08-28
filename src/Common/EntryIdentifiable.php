<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Common;

interface EntryIdentifiable extends EntryWithVigencias
{
    public function id(): string;

    public function texto(): string;
}
