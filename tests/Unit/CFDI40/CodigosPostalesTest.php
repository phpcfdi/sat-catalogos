<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\CodigosPostales;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

final class CodigosPostalesTest extends UsingTestingDatabaseTestCase
{
    public function testObtainCodigoPostal00000(): void
    {
        $codigosPostales = new CodigosPostales();
        $generic = $codigosPostales->obtain('00000');

        $this->assertSame('00000', $generic->id());
        $this->assertSame('00000', $generic->texto());
        $this->assertSame('*', $generic->estado());
        $this->assertSame('000', $generic->municipio());
        $this->assertSame('00', $generic->localidad());
    }
}
