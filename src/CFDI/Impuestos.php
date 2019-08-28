<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Impuestos
 * @method Impuesto obtain(string $id)
 */
class Impuestos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_IMPUESTOS;
    }

    /**
     * @param array $data
     * @return Impuesto
     */
    public function create(array $data): EntryIdentifiable
    {
        return new Impuesto(
            $data['id'],
            $data['texto'],
            (bool) $data['retencion'],
            (bool) $data['traslado'],
            $data['ambito'],
            $data['entidad']
        );
    }
}
