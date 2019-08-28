<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class Monedas
 * @method Moneda obtain(string $id)
 */
class Monedas extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_MONEDAS;
    }

    /**
     * @param array $data
     * @return Moneda
     */
    public function create(array $data): EntryIdentifiable
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
