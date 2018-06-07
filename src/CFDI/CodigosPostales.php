<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de CodigosPostales
 * @method CodigoPostal obtain(string $id)
 */
class CodigosPostales extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_CODIGOS_POSTALES;
    }

    /**
     * @param array $data
     * @return CodigoPostal
     */
    public function create(array $data): EntryInterface
    {
        return new CodigoPostal($data['id'], $data['estado'], $data['municipio'], $data['localidad']);
    }
}
