<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de incapacidades
 * @method TipoIncapacidad obtain(string $id)
 */
class TiposIncapacidades extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_TIPOS_INCAPACIDADES;
    }

    /**
     * @param array<string, scalar> $data
     * @return TipoIncapacidad
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new TipoIncapacidad(
            $values->string('id'),
            $values->string('texto'),
        );
    }
}
