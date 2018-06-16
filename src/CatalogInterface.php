<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

interface CatalogInterface extends WithRepositoryInterface
{
    public function create(array $data): EntryInterface;

    public function obtain(string $id): EntryInterface;

    public function exists(string $id): bool;
}
