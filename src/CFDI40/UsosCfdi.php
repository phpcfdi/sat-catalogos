<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class UsosCfdi
 * @method UsoCfdi obtain(string $id)
 */
class UsosCfdi extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_USOS_CFDI;
    }

    /**
     * @param array<string, mixed> $data
     * @return UsoCfdi
     */
    public function create(array $data): EntryIdentifiable
    {
        return new UsoCfdi(
            $data['id'],
            $data['texto'],
            (bool) $data['aplica_fisica'],
            (bool) $data['aplica_moral'],
            $data['regimenes_fiscales_receptores'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0,
        );
    }
}
