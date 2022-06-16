<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class Exportaciones
 * @method Exportacion obtain(string $id)
 */
class Exportaciones extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_EXPORTACIONES;
    }

    /**
     * @param array<string, scalar> $data
     * @return Exportacion
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new Exportacion(
            $values->string('id'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
