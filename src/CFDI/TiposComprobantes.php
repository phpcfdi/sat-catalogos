<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de comprobante
 * @method TipoComprobante obtain(string $id)
 */
class TiposComprobantes extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_TIPOS_COMPROBANTES;
    }

    /**
     * @param array $data
     * @return TipoComprobante
     */
    public function create(array $data): EntryInterface
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
