<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Impuestos
 * @method Impuesto obtain(string $id)
 */
class Impuestos extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_IMPUESTOS;
    }

    /**
     * @param array $data
     * @return Impuesto
     */
    public function create(array $data): EntryInterface
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
