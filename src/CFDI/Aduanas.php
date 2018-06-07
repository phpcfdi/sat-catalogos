<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de aduanas
 * @method Aduana obtain(string $id)
 */
class Aduanas extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_ADUANAS;
    }

    /**
     * @param array $data
     * @return Aduana
     */
    public function create(array $data): EntryInterface
    {
        return new Aduana(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
