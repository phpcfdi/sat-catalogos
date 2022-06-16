<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de jornadas
 * @method TipoJornada obtain(string $id)
 */
class TiposJornadas extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_TIPOS_JORNADAS;
    }

    /**
     * @param array<string, scalar> $data
     * @return TipoJornada
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new TipoJornada(
            $values->string('id'),
            $values->string('texto'),
        );
    }
}
