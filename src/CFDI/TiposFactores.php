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
        return Repository::CFDI_TIPOS_FACTORES;
    }

    /**
     * @param array $data
     * @return TipoFactor
     */
    public function create(array $data): EntryInterface
    {
        return new TipoFactor(
            $data['id']
        );
    }
}
