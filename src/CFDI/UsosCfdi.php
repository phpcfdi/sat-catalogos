<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class UsosCfdi
 * @method UsoCfdi obtain(string $id)
 */
class UsosCfdi extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_USOS_CFDI;
    }

    /**
     * @param array $data
     * @return UsoCfdi
     */
    public function create(array $data): EntryInterface
    {
        return new UsoCfdi(
            $data['id'],
            $data['texto'],
            (bool) $data['aplica_fisica'],
            (bool) $data['aplica_moral'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
