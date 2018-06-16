<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Repository;

class NumerosPedimentoAduana
{
    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function obtain(string $aduana, string $patente, int $ejercicio): NumeroPedimentoAduana
    {
        $data = $this->repository->queryRowByFields(Repository::CFDI_NUMEROS_PEDIMENTO_ADUANA, [
            'aduana' => $aduana,
            'patente' => $patente,
            'ejercicio' => $ejercicio,
        ]);
        return $this->create($data);
    }

    public function create(array $data): NumeroPedimentoAduana
    {
        return new NumeroPedimentoAduana(
            (string) $data['aduana'],
            (string) $data['patente'],
            (int) $data['ejercicio'],
            (int) $data['cantidad'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
