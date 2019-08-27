<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * ProductosServicios
 *
 * @method ProductoServicio obtain(string $id)
 * @method ProductoServicio[] obtainByIds(array $ids): array;
 * @method ProductoServicio[] searchByText(string $search, int $limit = 0): array;
 * @method ProductoServicio[] searchByField(string $fieldName, string $search, int $limit = 0): array;
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
