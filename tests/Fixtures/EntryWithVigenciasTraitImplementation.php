<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Fixtures;

use PhpCfdi\SatCatalogos\Common\EntryWithVigenciasTrait;

class EntryWithVigenciasTraitImplementation
{
    use EntryWithVigenciasTrait;

    public function __construct(int $since, int $until)
    {
        $this->setUpVigencias($since, $until);
    }
}
