<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Origenes Recursos
 * @method OrigenRecurso obtain(string $id)
 */
class OrigenesRecursos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::NOMINA_ORIGENES_RECURSOS;
    }

    /**
     * @param array<string, scalar> $data
     * @return OrigenRecurso
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new OrigenRecurso(
            $values->string('id'),
            $values->string('texto'),
        );
    }
}
