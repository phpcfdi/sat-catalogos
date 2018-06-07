<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

abstract class AbstractCatalog implements CatalogInterface
{
    /** @var Repository */
    private $repository;

    abstract public function create(array $data): EntryInterface;

    abstract protected function catalogName(): string;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function obtain(string $id): EntryInterface
    {
        $data = $this->repository->queryById($this->catalogName(), $id);
        return $this->create($data);
    }

    public function exists(string $id): bool
    {
        return $this->repository->existsId($this->catalogName(), $id);
    }
}
