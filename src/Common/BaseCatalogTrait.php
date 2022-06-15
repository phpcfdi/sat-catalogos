<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Common;

use LogicException;
use PhpCfdi\SatCatalogos\Repository;

trait BaseCatalogTrait
{
    /**
     * @var Repository|null
     * @internal
     */
    private $repository;

    public function withRepository(Repository $repository): void
    {
        if ($repository === $this->repository) {
            return;
        }

        if (null !== $this->repository) {
            throw new LogicException(
                sprintf('This instance of %s already contains a repository', get_class($this)),
            );
        }

        $this->repository = $repository;
    }

    public function repository(): Repository
    {
        if (null === $this->repository) {
            throw new LogicException(
                sprintf('This instance of %s does not contains a repository', get_class($this)),
            );
        }

        return $this->repository;
    }
}
