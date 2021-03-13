<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\NOMINA;

use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Common\BaseCatalogTrait;
use PhpCfdi\SatCatalogos\NOMINA\Estado;
use PhpCfdi\SatCatalogos\Repository;

class Estados implements BaseCatalog
{
    use BaseCatalogTrait;

    public function obtain(string $estado, string $pais): Estado
    {
        $data = $this->repository()->queryRowByFields(Repository::NOMINA_ESTADOS, [
            'estado' => $estado,
            'pais' => $pais,
        ]);
        return $this->create($data);
    }

    /**
     * @param array<string, mixed> $data
     * @return Estado
     */
    public function create(array $data): Estado
    {
        return new Estado(
            (string) $data['estado'],
            (string) $data['pais']
        );
    }
}
