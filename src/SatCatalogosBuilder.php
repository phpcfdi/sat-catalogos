<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

use PDO;

class SatCatalogosBuilder
{
    /** @var Repository|null */
    private $repository;

    public function build(): SatCatalogos
    {
        return new SatCatalogos($this->getRepository());
    }

    public function withRepository(Repository $repository): self
    {
        $this->repository = $repository;
        return $this;
    }

    public function getRepository(): Repository
    {
        if (null === $this->repository) {
            return $this->defaultRepository();
        }
        return $this->repository;
    }

    public function defaultRepository(): Repository
    {
        return new Repository(
            new PDO('slite:' . dirname(__DIR__) . '/lib/SatCatalogos.db', '', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ])
        );
    }

    public function register($catalogName, $className)
    {
    }
}
