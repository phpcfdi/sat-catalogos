<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de aduanas
 * @method PatenteAduanal obtain(string $id)
 */
class PatentesAduanales extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_PATENTES_ADUANALES;
    }

    /**
     * @param array<string, scalar> $data
     * @return PatenteAduanal
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new PatenteAduanal(
            $values->string('id'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
