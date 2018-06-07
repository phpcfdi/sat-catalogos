<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class ProductosServicios
 * @method ProductoServicio obtain(string $id)
 */
class ProductosServicios extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_PRODUCTOS_SERVICIOS;
    }

    /**
     * @param array $data
     * @return ProductoServicio
     */
    public function create(array $data): EntryInterface
    {
        return new ProductoServicio(
            $data['id'],
            $data['texto'],
            (bool) $data['iva_trasladado'],
            (bool) $data['ieps_trasladado'],
            $data['complemento'],
            $data['similares'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
