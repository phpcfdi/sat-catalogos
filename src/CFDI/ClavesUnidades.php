<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class ClavesUnidades
 * @method ClaveUnidad obtain(string $id)
 */
class ClavesUnidades extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_CLAVES_UNIDADES;
    }

    /**
     * @param array $data
     * @return ClaveUnidad
     */
    public function create(array $data): EntryInterface
    {
        return new ClaveUnidad(
            $data['id'],
            $data['texto'],
            $data['descripcion'],
            $data['notas'],
            $data['simbolo'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
