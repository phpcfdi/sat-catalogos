<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Tipos de contratos
 * @method TipoContrato obtain(string $id)
 */
class TiposContratos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_TIPOS_CONTRATOS;
    }

    /**
     * @param array<string, scalar> $data
     * @return TipoContrato
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new TipoContrato(
            $values->string('id'),
            $values->string('texto'),
        );
    }
}
