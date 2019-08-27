<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

interface CatalogInterface extends WithRepositoryInterface
{
    public function create(array $data): EntryInterface;

    public function obtain(string $id): EntryInterface;

    public function exists(string $id): bool;

    /**
     * @param string $fieldName
     * @param string $search
     * @param int $limit
     * @return EntryInterface[]
     */
    public function searchByField(string $fieldName, string $search, int $limit = 0): array;

    /**
     * @param array $ids
     * @return EntryInterface[]
     */
    public function obtainByIds(array $ids): array;
}
