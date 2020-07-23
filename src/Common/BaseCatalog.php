<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Common;

use PhpCfdi\SatCatalogos\Repository;

interface BaseCatalog
{
    public function withRepository(Repository $repository): void;

    public function repository(): Repository;
}
