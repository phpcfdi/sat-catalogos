<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
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
     * @param array<string, scalar> $data
     * @return Pais
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new Pais(
            $values->string('id'),
            $values->string('texto'),
            $values->string('patron_codigo_postal'),
            $values->string('patron_identidad_tributaria'),
            $values->string('validacion_identidad_tributaria'),
            $values->string('agrupaciones'),
        );
    }
}
