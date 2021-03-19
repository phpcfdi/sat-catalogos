<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
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
     * @param array<string, mixed> $data
     * @return TipoHora
     */
    public function create(array $data): EntryIdentifiable
    {
        return new TipoHora(
            $data['id'],
            $data['texto'],
        );
    }
}
