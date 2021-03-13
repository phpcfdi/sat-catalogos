<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de contratos
 * @method TiposContratos obtain(string $id)
 */
class TiposContratos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_TIPOS_CONTRATOS;
    }

    /**
     * @param array<string, mixed> $data
     * @return TipoContrato
     */
    public function create(array $data): EntryIdentifiable
    {
        return new TipoContrato(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
