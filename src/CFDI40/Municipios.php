<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Common\BaseCatalogTrait;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Municipios
 */
class Municipios implements BaseCatalog
{
    use BaseCatalogTrait;

    public function obtain(string $codigo, string $estado): Municipio
    {
        $municipio = $this->find($codigo, $estado);
        if (null === $municipio) {
            throw new SatCatalogosNotFoundException(
                "No se encontró un municipio con código $codigo y estado $estado",
            );
        }
        return $municipio;
    }

    public function find(string $codigo, string $estado): ?Municipio
    {
        /** @var array<array<string, scalar>> $data */
        $data = $this->repository()->queryRowsByFields(Repository::CFDI_40_MUNICIPIOS, [
            'municipio' => $codigo,
            'estado' => $estado,
        ]);
        if (! isset($data[0])) {
            return null;
        }
        return $this->create($data[0]);
    }

    /**
     * @param string $codigo
     * @param string $estado
     * @param string $texto
     * @return Municipio[]
     */
    public function search(string $codigo = '%', string $estado = '%', string $texto = '%'): array
    {
        $filters = [
            'municipio' => $codigo,
            'estado' => $estado,
            'texto' => $texto,
        ];

        return array_map(
            function (array $data): Municipio {
                return $this->create($data);
            },
            $this->repository()->queryRowsByFields(Repository::CFDI_40_MUNICIPIOS, $filters, 0, false),
        );
    }

    /**
     * @param array<string, scalar> $data
     * @return Municipio
     */
    public function create(array $data): Municipio
    {
        $values = new ScalarValues($data);
        return new Municipio(
            $values->string('municipio'),
            $values->string('estado'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
