<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class Monedas
 * @method Moneda obtain(string $id)
 */
class Monedas extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_MONEDAS;
    }

    /**
     * @param array<string, scalar> $data
     * @return Moneda
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new Moneda(
            $values->string('id'),
            $values->string('texto'),
            $values->int('decimales'),
            $values->int('porcentaje_variacion'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
