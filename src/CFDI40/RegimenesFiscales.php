<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class RegimenesFiscales
 * @method RegimenFiscal obtain(string $id)
 */
class RegimenesFiscales extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_REGIMENES_FISCALES;
    }

    /**
     * @param array<string, scalar> $data
     * @return RegimenFiscal
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new RegimenFiscal(
            $values->string('id'),
            $values->string('texto'),
            $values->bool('aplica_fisica'),
            $values->bool('aplica_moral'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
