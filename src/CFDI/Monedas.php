<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class Monedas
 * @method Moneda obtain(string $id)
 */
class Monedas extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_MONEDAS;
    }

    /**
     * @param array $data
     * @return Moneda
     */
    public function create(array $data): EntryInterface
    {
        return new Moneda(
            $data['id'],
            $data['texto'],
            (int) $data['decimales'],
            (int) $data['porcentaje_variacion'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
