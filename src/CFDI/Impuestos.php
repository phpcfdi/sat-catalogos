<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
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
     * @param array<string, scalar> $data
     * @return Impuesto
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new Impuesto(
            $values->string('id'),
            $values->string('texto'),
            $values->bool('retencion'),
            $values->bool('traslado'),
            $values->string('ambito'),
            $values->string('entidad'),
        );
    }
}
