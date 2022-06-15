<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class ObjetosImpuestos
 * @method Mes obtain(string $id)
 */
class ObjetosImpuestos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_OBJETOS_IMPUESTOS;
    }

    /**
     * @param array<string, mixed> $data
     * @return Mes
     */
    public function create(array $data): EntryIdentifiable
    {
        return new Mes(
            $data['id'],
            $data['texto'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0,
        );
    }
}
