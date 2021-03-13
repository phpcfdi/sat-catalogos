<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de incapacidades
 * @method TiposIncapacidades obtain(string $id)
 */
class TiposIncapacidades extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_TIPOS_INCAPACIDADES;
    }

    /**
     * @param array<string, mixed> $data
     * @return TipoIncapacidad
     */
    public function create(array $data): EntryIdentifiable
    {
        return new TipoIncapacidad(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
