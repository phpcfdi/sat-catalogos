<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Periodicidades Pagos
 * @method PeriodicidadPago obtain(string $id)
 */
class PeriodicidadesPagos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_PERIODICIDADES_PAGOS;
    }

    /**
     * @param array<string, scalar> $data
     * @return PeriodicidadPago
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new PeriodicidadPago(
            $values->string('id'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
