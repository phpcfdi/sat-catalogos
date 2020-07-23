<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class Paises
 * @method Pais obtain(string $id)
 */
class Paises extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_PAISES;
    }

    /**
     * @param array<string, mixed> $data
     * @return Pais
     */
    public function create(array $data): EntryIdentifiable
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
