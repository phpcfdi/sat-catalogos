<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de aduanas
 * @method PatenteAduanal obtain(string $id)
 */
class PatentesAduanales extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_PATENTES_ADUANALES;
    }

    /**
     * @param array<string, mixed> $data
     * @return PatenteAduanal
     */
    public function create(array $data): EntryIdentifiable
    {
        return new PatenteAduanal(
            $data['id'],
            $data['id'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
