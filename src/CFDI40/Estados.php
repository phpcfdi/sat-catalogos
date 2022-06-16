<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Common\BaseCatalogTrait;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

class Estados implements BaseCatalog
{
    use BaseCatalogTrait;

    public function obtain(string $codigo, string $pais): Estado
    {
        $estado = $this->findEstado($codigo, $pais);
        if (null === $estado) {
            throw new SatCatalogosNotFoundException("No se encontró un estado con código $codigo y país $pais");
        }
        return $estado;
    }

    public function findEstado(string $codigo, string $pais): ?Estado
    {
        $filters = [
            'estado' => $codigo,
            'pais' => $pais,
        ];
        $data = $this->repository()->queryRowsByFields(Repository::CFDI_40_ESTADOS, $filters);
        if (! isset($data[0])) {
            return null;
        }
        return $this->createEstado($data[0]);
    }

    /**
     * @param string $pais
     * @return Estado[]
     */
    public function obtainEstadosByPais(string $pais): array
    {
        $filters = [
            'pais' => $pais,
        ];

        return array_map(
            function (array $data): Estado {
                return $this->createEstado($data);
            },
            $this->repository()->queryRowsByFields(Repository::CFDI_40_ESTADOS, $filters),
        );
    }

    /**
     * @param string $texto
     * @param string $pais
     * @param string $codigo
     * @return Estado[]
     */
    public function searchEstados(string $texto = '%', string $pais = '%', string $codigo = '%'): array
    {
        $filters = [
            'estado' => $codigo,
            'pais' => $pais,
            'texto' => $texto,
        ];

        return array_map(
            function (array $data): Estado {
                return $this->createEstado($data);
            },
            $this->repository()->queryRowsByFields(Repository::CFDI_40_ESTADOS, $filters, 0, false),
        );
    }

    /**
     * Create a Estado based on the array values
     *
     * @param array<string, scalar> $data
     * @return Estado
     */
    public function createEstado(array $data): Estado
    {
        $values = new ScalarValues($data);
        return new Estado(
            $values->string('estado'),
            $values->string('pais'),
            $values->string('texto'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
