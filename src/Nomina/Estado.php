<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PhpCfdi\SatCatalogos\Common\EntryWithVigenciasTrait;

class Estado implements EntryWithVigencias
{
    use EntryWithVigenciasTrait;

    /** @var string */
    private $codigo;

    /** @var string */
    private $pais;

    /** @var string */
    private $texto;

    /**
     * Estado constructor.
     *
     * @param string $codigo
     * @param string $pais
     * @param string $texto
     */
    public function __construct(
        string $codigo,
        string $pais,
        string $texto
    ) {
        $this->codigo = $codigo;
        $this->pais = $pais;
        $this->texto = $texto;
        $this->setUpVigencias(0, 0);
    }

    public function codigo(): string
    {
        return $this->codigo;
    }

    public function pais(): string
    {
        return $this->pais;
    }

    public function texto(): string
    {
        return $this->texto;
    }
}
