<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Exceptions;

use Throwable;

class PatronException extends SatCatalogosLogicException
{
    public function __construct(string $source, int $code = 0, Throwable $previous = null)
    {
        parent::__construct("El patrón '$source' no es válido", $code, $previous);
    }
}
