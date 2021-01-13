<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Helpers;

use PhpCfdi\SatCatalogos\Exceptions\PatronException;

class Patron
{
    /** @var string */
    private $origen;

    /** @var string */
    private $expresion;

    /** @var string */
    private $alEstarVacio;

    public const VACIO_PERMITE_NADA = 'NADA';

    public const VACIO_PERMITE_TODO = 'TODO';

    public function __construct(string $origen, string $alEstarVacio = self::VACIO_PERMITE_TODO)
    {
        if ('' === $origen && self::VACIO_PERMITE_TODO === $alEstarVacio) {
            // cualquier caracter no espaciado vertical, de 0 a N veces
            $expresion = '\V*';
        } else {
            $expresion = $origen;
        }
        $expresion = '/^' . $expresion . '$/u';
        if (! $this->expresionEsValida($expresion)) {
            throw new PatronException($expresion);
        }

        $this->origen = $origen;
        $this->expresion = $expresion;
        $this->alEstarVacio = $alEstarVacio;
    }

    public function origen(): string
    {
        return $this->origen;
    }

    public function expresion(): string
    {
        return $this->expresion;
    }

    public function alEstarVacio(): string
    {
        return $this->alEstarVacio;
    }

    public function evalua(string $texto): bool
    {
        $expresion = $this->expresion();
        return (bool) preg_match($expresion, $texto);
    }

    public function expresionEsValida(string $expresion): bool
    {
        /** @noinspection PhpUsageOfSilenceOperatorInspection */
        return (false !== @preg_match($expresion, ''));
    }

    public function __toString(): string
    {
        return $this->origen();
    }
}
