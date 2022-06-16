<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
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
     * @param array<string, scalar> $data
     * @return RiesgoPuesto
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new RiesgoPuesto(
            $values->string('id'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
