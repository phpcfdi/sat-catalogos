<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class ObjetosImpuestos
 * @method ObjetoImpuesto obtain(string $id)
 */
class ObjetosImpuestos extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_OBJETOS_IMPUESTOS;
    }

    /**
     * @param array<string, scalar> $data
     * @return ObjetoImpuesto
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new ObjetoImpuesto(
            $values->string('id'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
