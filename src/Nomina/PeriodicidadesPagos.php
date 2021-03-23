<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
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
     * @param array<string, mixed> $data
     * @return PeriodicidadPago
     */
    public function create(array $data): EntryIdentifiable
    {
        return new PeriodicidadPago(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
