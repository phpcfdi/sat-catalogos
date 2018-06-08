<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class Paises
 * @method Pais obtain(string $id)
 */
class Paises extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_PAISES;
    }

    /**
     * @param array $data
     * @return Pais
     */
    public function create(array $data): EntryInterface
    {
        return new Pais(
            $data['id'],
            $data['texto'],
            $data['patron_codigo_postal'],
            $data['patron_identidad_tributaria'],
            $data['validacion_identidad_tributaria'],
            $data['agrupaciones']
        );
    }
}
