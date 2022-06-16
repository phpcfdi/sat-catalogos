<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de deducciones
 * @method TipoDeduccion obtain(string $id)
 */
class TiposDeducciones extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_TIPOS_DEDUCCIONES;
    }

    /**
     * @param array<string, scalar> $data
     * @return TipoDeduccion
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new TipoDeduccion(
            $values->string('id'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
