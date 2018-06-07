<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de MetodosDePago
 * @method MetodoDePago obtain(string $id)
 */
class MetodosDePago extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_METODOS_PAGO;
    }

    /**
     * @param array $data
     * @return MetodoDePago
     */
    public function create(array $data): EntryInterface
    {
        return new MetodoDePago(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
