<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Common;

abstract class AbstractCatalogIdentifiable implements CatalogIdentifiable
{
    use BaseCatalogTrait;

    /**
     * @param array<string, scalar> $data
     * @return EntryIdentifiable
     */
    abstract public function create(array $data): EntryIdentifiable;

    abstract protected function catalogName(): string;

    public function obtain(string $id): EntryIdentifiable
    {
        $data = $this->repository()->queryById($this->catalogName(), $id);
        return $this->create($data);
    }

    public function exists(string $id): bool
    {
        return $this->repository()->existsId($this->catalogName(), $id);
    }

    /**
     * @param string[] $ids
     * @return EntryIdentifiable[]
     */
    public function obtainByIds(array $ids): array
    {
        return $this->arrayToEntries(
            $this->repository()->queryByIds($this->catalogName(), $ids),
        );
    }

    public function searchByField(string $fieldName, string $search, int $limit = 0): array
    {
        $results = $this->repository()->queryRowsByFields(
            $this->catalogName(),
            [$fieldName => $search],
            $limit,
            false,
        );

        return $this->arrayToEntries($results);
    }

    public function searchByText(string $search, int $limit = 0): array
    {
        return $this->searchByField('texto', $search, $limit);
    }

    /**
     * @param array<array<string, scalar>> $entries
     * @return EntryIdentifiable[]
     */
    private function arrayToEntries(array $entries): array
    {
        return array_map(function (array $data): EntryIdentifiable {
            return $this->create($data);
        }, $entries);
    }
}
