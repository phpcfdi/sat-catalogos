<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de comprobante
 * @method TipoDeComprobante obtain(string $id)
 */
class TiposDeComprobante extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_TIPOS_COMPROBANTE;
    }

    /**
     * @param array $data
     * @return TipoDeComprobante
     */
    public function create(array $data): EntryInterface
    {
        return new TipoDeComprobante(
            $data['id'],
            $data['texto'],
            $data['valor_maximo'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
