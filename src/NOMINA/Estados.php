<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\NOMINA;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class Estados
 * @method Estado obtain($estado, $pais, $texto)
 */
class Estados extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_ESTADOS;
    }

    /**
     * @param array<string, mixed> $data
     * @return Estado
     */
    public function create(array $data): EntryIdentifiable
    {
        return new Estado(
            $data['estado'],
            $data['pais'],
            $data['texto']
        );
    }
}
