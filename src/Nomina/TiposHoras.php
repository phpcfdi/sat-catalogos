<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de horas
 * @method TipoHora obtain(string $id)
 */
class TiposHoras extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_TIPOS_HORAS;
    }

    /**
     * @param array<string, scalar> $data
     * @return TipoHora
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new TipoHora(
            $values->string('id'),
            $values->string('texto'),
        );
    }
}
