<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Fixtures;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;

class CatalogImplementation extends AbstractCatalog
{
    public function create(array $data): EntryInterface
    {
        return new EntryImplementation(
            $data['id'],
            $data['texto'],
            strtotime($data['vigencia_desde']),
            strtotime($data['vigencia_hasta'])
        );
    }

    protected function catalogName(): string
    {
        return 'catalog';
    }
}
