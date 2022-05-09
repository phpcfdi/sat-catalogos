<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de comprobante
 * @method TipoComprobante obtain(string $id)
 */
class TiposComprobantes extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_TIPOS_COMPROBANTES;
    }

    /**
     * @param array<string, mixed> $data
     * @return TipoComprobante
     */
    public function create(array $data): EntryIdentifiable
    {
        return new TipoComprobante(
            $data['id'],
            $data['texto'],
            $data['valor_maximo'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
