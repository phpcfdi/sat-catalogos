<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Common\BaseCatalogTrait;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

class NumerosPedimentoAduana implements BaseCatalog
{
    use BaseCatalogTrait;

    public function obtain(string $aduana, string $patente, int $ejercicio): NumeroPedimentoAduana
    {
        $data = $this->repository()->queryRowByFields(Repository::CFDI_NUMEROS_PEDIMENTO_ADUANA, [
            'aduana' => $aduana,
            'patente' => $patente,
            'ejercicio' => $ejercicio,
        ]);
        return $this->create($data);
    }

    /**
     * @param array<string, scalar> $data
     * @return NumeroPedimentoAduana
     */
    public function create(array $data): NumeroPedimentoAduana
    {
        $values = new ScalarValues($data);
        return new NumeroPedimentoAduana(
            $values->string('aduana'),
            $values->string('patente'),
            $values->int('ejercicio'),
            $values->int('cantidad'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
