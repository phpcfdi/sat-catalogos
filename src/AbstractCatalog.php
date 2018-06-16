<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

abstract class AbstractCatalog implements CatalogInterface
{
    use WithRepositoryTrait;

    abstract public function create(array $data): EntryInterface;

    abstract protected function catalogName(): string;

    public function obtain(string $id): EntryInterface
    {
        $data = $this->repository()->queryById($this->catalogName(), $id);
        return $this->create($data);
    }

    public function exists(string $id): bool
    {
        return $this->repository()->existsId($this->catalogName(), $id);
    }
}
