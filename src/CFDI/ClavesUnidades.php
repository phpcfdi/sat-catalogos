<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class ClavesUnidades
 * @method ClaveUnidad obtain(string $id)
 */
class ClavesUnidades extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_CLAVES_UNIDADES;
    }

    /**
     * @param array<string, scalar> $data
     * @return ClaveUnidad
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new ClaveUnidad(
            $values->string('id'),
            $values->string('texto'),
            $values->string('descripcion'),
            $values->string('notas'),
            $values->string('simbolo'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
