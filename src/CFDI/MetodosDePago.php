<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de MetodosDePago
 * @method MetodoDePago obtain(string $id)
 */
class MetodosDePago extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_METODOS_PAGO;
    }

    /**
     * @param array<string, scalar> $data
     * @return MetodoDePago
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new MetodoDePago(
            $values->string('id'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
