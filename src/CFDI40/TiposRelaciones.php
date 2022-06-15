<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de tipos de relaciones
 * @method TipoRelacion obtain(string $id)
 */
class TiposRelaciones extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_TIPOS_RELACIONES;
    }

    /**
     * @param array<string, mixed> $data
     * @return TipoRelacion
     */
    public function create(array $data): EntryIdentifiable
    {
        return new TipoRelacion(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0,
        );
    }
}
