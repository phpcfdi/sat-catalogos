<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

interface WithRepositoryInterface
{
    public function withRepository(Repository $repository);

    public function repository(): Repository;
}
