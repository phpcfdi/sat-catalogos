<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class TiposFactores
 * @method TipoFactor obtain(string $id)
 */
class TiposFactores extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_TIPOS_FACTORES;
    }

    /**
     * @param array<string, mixed> $data
     * @return TipoFactor
     */
    public function create(array $data): EntryIdentifiable
    {
        return new TipoFactor(
            $data['id'],
        );
    }
}
