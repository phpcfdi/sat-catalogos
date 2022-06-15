<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class Periodicidades
 * @method Periodicidad obtain(string $id)
 */
class Periodicidades extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_PERIODICIDADES;
    }

    /**
     * @param array<string, mixed> $data
     * @return Periodicidad
     */
    public function create(array $data): EntryIdentifiable
    {
        return new Periodicidad(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0,
        );
    }
}
