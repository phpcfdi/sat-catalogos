<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Common\BaseCatalogTrait;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Colonias
 */
class Colonias implements BaseCatalog
{
    use BaseCatalogTrait;

    public function obtain(string $colonia, string $codigoPostal): Colonia
    {
        $found = $this->find($colonia, $codigoPostal);
        if (null === $found) {
            throw new SatCatalogosNotFoundException(
                "No se encontró una colonia $colonia con código postal $codigoPostal",
            );
        }
        return $found;
    }

    public function find(string $colonia, string $codigoPostal): ?Colonia
    {
        /** @var array<array<string, scalar>> $data */
        $data = $this->repository()->queryRowsByFields(Repository::CFDI_40_COLONIAS, [
            'colonia' => $colonia,
            'codigo_postal' => $codigoPostal,
        ]);
        if (! isset($data[0])) {
            return null;
        }
        return $this->create($data[0]);
    }

    /**
     * @param string $colonia
     * @param string $codigoPostal
     * @param string $asentamiento
     * @return Colonia[]
     */
    public function searchColonias(string $colonia = '%', string $codigoPostal = '%', string $asentamiento = '%'): array
    {
        $filters = [
            'colonia' => $colonia,
            'codigo_postal' => $codigoPostal,
            'texto' => $asentamiento,
        ];

        return array_map(
            function (array $data): Colonia {
                return $this->create($data);
            },
            $this->repository()->queryRowsByFields(Repository::CFDI_40_COLONIAS, $filters, 0, false),
        );
    }

    /**
     * @param array<string, scalar> $data
     * @return Colonia
     */
    public function create(array $data): Colonia
    {
        $values = new ScalarValues($data);
        return new Colonia(
            $values->string('colonia'),
            $values->string('codigo_postal'),
            $values->string('texto'),
        );
    }
}
