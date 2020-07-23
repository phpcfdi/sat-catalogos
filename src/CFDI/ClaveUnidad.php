<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;

class ClaveUnidad extends AbstractEntryIdentifiable
{
    /** @var string */
    private $descripcion;

    /** @var string */
    private $nota;

    /** @var string */
    private $simbolo;

    public function __construct(
        string $id,
        string $texto,
        string $descripcion,
        string $nota,
        string $simbolo,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->descripcion = $descripcion;
        $this->nota = $nota;
        $this->simbolo = $simbolo;
    }

    public function descripcion(): string
    {
        return $this->descripcion;
    }

    public function nota(): string
    {
        return $this->nota;
    }

    public function simbolo(): string
    {
        return $this->simbolo;
    }
}
