<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Common;

interface CatalogIdentifiable extends BaseCatalog
{
    /**
     * @param array<string, scalar> $data
     * @return EntryIdentifiable
     */
    public function create(array $data): EntryIdentifiable;

    public function obtain(string $id): EntryIdentifiable;

    public function exists(string $id): bool;

    /**
     * Retrieve an array of catalog entries where fieldname is like search string
     *
     * @param string $fieldName
     * @param string $search
     * @param int $limit
     * @return EntryIdentifiable[]
     */
    public function searchByField(string $fieldName, string $search, int $limit = 0): array;

    /**
     * Retrieve an array of catalog entries where text (texto) is like search string
     *
     * @param string $search
     * @param int $limit
     * @return EntryIdentifiable[]
     */
    public function searchByText(string $search, int $limit = 0): array;

    /**
     * Retrieve an array of catalog entries with matching identifiers
     *
     * @param string[] $ids
     * @return EntryIdentifiable[]
     */
    public function obtainByIds(array $ids): array;
}
