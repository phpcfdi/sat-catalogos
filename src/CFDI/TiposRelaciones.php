<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de tipos de relaciones
 * @method TipoRelacion obtain(string $id)
 */
class TiposRelaciones extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_TIPOS_RELACIONES;
    }

    /**
     * @param array $data
     * @return TipoRelacion
     */
    public function create(array $data): EntryInterface
    {
        return new TipoRelacion(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
