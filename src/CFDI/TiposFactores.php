<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class TiposFactores
 * @method TipoFactor obtain(string $id)
 */
class TiposFactores extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_TIPOS_FACTOR;
    }

    /**
     * @param array $data
     * @return TipoFactor
     */
    public function create(array $data): EntryInterface
    {
        return new TipoFactor(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
