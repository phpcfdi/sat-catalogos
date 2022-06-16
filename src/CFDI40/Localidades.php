<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Common\BaseCatalogTrait;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de Localidades
 */
class Localidades implements BaseCatalog
{
    use BaseCatalogTrait;

    public function obtain(string $codigo, string $estado): Localidad
    {
        $localidad = $this->find($codigo, $estado);
        if (null === $localidad) {
            throw new SatCatalogosNotFoundException(
                "No se encontró una localidad con código $codigo y estado $estado",
            );
        }
        return $localidad;
    }

    public function find(string $codigo, string $estado): ?Localidad
    {
        /** @var array<array<string, scalar>> $data */
        $data = $this->repository()->queryRowsByFields(Repository::CFDI_40_LOCALIDADES, [
            'localidad' => $codigo,
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
     * @return Localidad[]
     */
    public function search(string $codigo = '%', string $estado = '%', string $texto = '%'): array
    {
        $filters = [
            'localidad' => $codigo,
            'estado' => $estado,
            'texto' => $texto,
        ];

        return array_map(
            function (array $data): Localidad {
                return $this->create($data);
            },
            $this->repository()->queryRowsByFields(Repository::CFDI_40_LOCALIDADES, $filters, 0, false),
        );
    }

    /**
     * @param array<string, scalar> $data
     * @return Localidad
     */
    public function create(array $data): Localidad
    {
        $values = new ScalarValues($data);
        return new Localidad(
            $values->string('localidad'),
            $values->string('estado'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
