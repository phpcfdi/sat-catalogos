<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de aduanas
 * @method PatenteAduanal obtain(string $id)
 */
class PatentesAduanales extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_PATENTES_ADUANALES;
    }

    /**
     * @param array $data
     * @return PatenteAduanal
     */
    public function create(array $data): EntryInterface
    {
        return new PatenteAduanal(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
