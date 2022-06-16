<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Class UsosCfdi
 * @method UsoCfdi obtain(string $id)
 */
class UsosCfdi extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_USOS_CFDI;
    }

    /**
     * @param array<string, scalar> $data
     * @return UsoCfdi
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new UsoCfdi(
            $values->string('id'),
            $values->string('texto'),
            $values->bool('aplica_fisica'),
            $values->bool('aplica_moral'),
            $values->string('regimenes_fiscales_receptores'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
