<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos otros pagos
 * @method TiposOtrosPagos obtain(string $id)
 */
class TiposOtrosPagos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_TIPOS_OTROS_PAGOS;
    }

    /**
     * @param array<string, mixed> $data
     * @return TipoOtroPago
     */
    public function create(array $data): EntryIdentifiable
    {
        return new TipoOtroPago(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
