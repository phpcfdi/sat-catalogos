<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Riesgos Puestos
 * @method RiesgoPuesto obtain(string $id)
 */
class RiesgosPuestos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_RIESGOS_PUESTOS;
    }

    /**
     * @param array<string, mixed> $data
     * @return RiesgoPuesto
     */
    public function create(array $data): EntryIdentifiable
    {
        return new RiesgoPuesto(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0,
        );
    }
}
