<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Fixtures;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;

class CatalogIdentifiableImplementation extends AbstractCatalogIdentifiable
{
    public function create(array $data): EntryIdentifiable
    {
        return new EntryIdentifiableImplementation(
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
