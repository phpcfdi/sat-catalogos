<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\Banco;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Bancos
 * @method Bancos obtain(int $id, string $texto, string $razon_social, string $vigencia_desde, string $vigencia_hasta)
 */
class Bancos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_BANCOS;
    }

    /**
     * @param array<string, mixed> $data
     * @return Banco
     */
    public function create(array $data): EntryIdentifiable
    {
        return new Banco(
            $data['id'],
            $data['texto'],
            $data['razon_social'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
