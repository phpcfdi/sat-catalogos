<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class RegimenesFiscales
 * @method RegimenFiscal obtain(string $id)
 */
class RegimenesFiscales extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_REGIMENES_FISCALES;
    }

    /**
     * @param array<string, mixed> $data
     * @return RegimenFiscal
     */
    public function create(array $data): EntryIdentifiable
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
