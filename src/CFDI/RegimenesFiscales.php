<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class RegimenesFiscales
 * @method RegimenFiscal obtain(string $id)
 */
class RegimenesFiscales extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_REGIMENES_FISCALES;
    }

    /**
     * @param array $data
     * @return RegimenFiscal
     */
    public function create(array $data): EntryInterface
    {
        return new RegimenFiscal(
            $data['id'],
            $data['texto'],
            (bool) $data['aplica_fisica'],
            (bool) $data['aplica_moral'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
