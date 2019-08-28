<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\Patron;

class Pais extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    /** @var Patron */
    private $patronCodigoPostal;

    /** @var Patron */
    private $patronIdentidadTributaria;

    /** @var string */
    private $validacionIdentidadTributaria;

    /** @var string */
    private $agrupaciones;

    public function __construct(
        string $id,
        string $texto,
        string $patronCodigoPostal,
        string $patronIdentidadTributaria,
        string $validacionIdentidadTributaria,
        string $agrupaciones
    ) {
        parent::__construct($id, $texto, 0, 0);
        $this->patronCodigoPostal = new Patron($patronCodigoPostal, Patron::VACIO_PERMITE_TODO);
        $this->patronIdentidadTributaria = new Patron($patronIdentidadTributaria, Patron::VACIO_PERMITE_TODO);
        $this->validacionIdentidadTributaria = $validacionIdentidadTributaria;
        $this->agrupaciones = $agrupaciones;
    }

    public function patronCodigoPostal(): Patron
    {
        return $this->patronCodigoPostal;
    }

    public function patronIdentidadTributaria(): Patron
    {
        return $this->patronIdentidadTributaria;
    }

    public function validacionIdentidadTributaria(): string
    {
        return $this->validacionIdentidadTributaria;
    }

    public function agrupaciones(): string
    {
        return $this->agrupaciones;
    }
}
