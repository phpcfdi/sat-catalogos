<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Fixtures;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;

final class CatalogIdentifiableImplementation extends AbstractCatalogIdentifiable
{
    /**
     * @param array<string, scalar> $data
     * @return EntryIdentifiable
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new EntryIdentifiableImplementation(
            $values->string('id'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }

    protected function catalogName(): string
    {
        return 'catalog';
    }
}
