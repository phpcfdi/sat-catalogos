<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
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
     * @param array<string, scalar> $data
     * @return ProductoServicio
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new ProductoServicio(
            $values->string('id'),
            $values->string('texto'),
            $values->bool('iva_trasladado'),
            $values->bool('ieps_trasladado'),
            $values->string('complemento'),
            $values->string('similares'),
            $values->bool('estimulo_frontera'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
