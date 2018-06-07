<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractEntry;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class Pais extends AbstractEntry implements EntryInterface
{
    /** @var string */
    private $patronCodigoPostal;

    /** @var string */
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
        $this->patronCodigoPostal = $this->parsePatronOpcional($patronCodigoPostal);
        $this->patronIdentidadTributaria = $this->parsePatronOpcional($patronIdentidadTributaria);
        $this->validacionIdentidadTributaria = $validacionIdentidadTributaria;
        $this->agrupaciones = $agrupaciones;
    }

    private function parsePatronOpcional(string $partial): string
    {
        if ('' === $partial) {
            $partial = '\V*'; // cualquier caracter no espaciado vertial, de 0 a N veces
        }
        $pattern = '/^' . $partial . '$/';
        if (false === @preg_match($pattern, '')) {
            throw new SatCatalogosLogicException("La expresión regular '$pattern' no es válida");
        }

        return $pattern;
    }

    public function patronCodigoPostal(): string
    {
        return $this->patronCodigoPostal;
    }

    public function patronIdentidadTributaria(): string
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
