<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
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
     * @param array<string, mixed> $data
     * @return TipoDeduccion
     */
    public function create(array $data): EntryIdentifiable
    {
        return new TipoDeduccion(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
