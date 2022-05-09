<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * ProductosServicios
 *
 * @method ProductoServicio obtain(string $id)
 * @method ProductoServicio[] obtainByIds(array $ids): array;
 * @method ProductoServicio[] searchByText(string $search, int $limit = 0): array;
 * @method ProductoServicio[] searchByField(string $fieldName, string $search, int $limit = 0): array;
 */
class ProductosServicios extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_PRODUCTOS_SERVICIOS;
    }

    /**
     * @param array<string, mixed> $data
     * @return ProductoServicio
     */
    public function create(array $data): EntryIdentifiable
    {
        return new ProductoServicio(
            $data['id'],
            $data['texto'],
            (bool) $data['iva_trasladado'],
            (bool) $data['ieps_trasladado'],
            $data['complemento'],
            $data['similares'],
            (bool) $data['estimulo_frontera'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
