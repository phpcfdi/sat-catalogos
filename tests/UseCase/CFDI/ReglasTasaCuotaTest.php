<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase\CFDI;

use PhpCfdi\SatCatalogos\CFDI\ReglasTasaCuota;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

final class ReglasTasaCuotaTest extends UsingTestingDatabaseTestCase
{
    /** @var ReglasTasaCuota */
    protected $reglasTasaCuota;

    protected function setUp(): void
    {
        parent::setUp();
        $this->reglasTasaCuota = new ReglasTasaCuota();
        $this->reglasTasaCuota->withRepository($this->getRepository());
    }

    public function testHasMatchingRule(): void
    {
        $rules = $this->reglasTasaCuota;
        $this->assertTrue(
            $rules->hasMatchingRule($rules::IMPUESTO_IVA, $rules::FACTOR_TASA, $rules::USO_TRASLADO, '0.160000'),
        );
        $this->assertFalse(
            $rules->hasMatchingRule($rules::IMPUESTO_IVA, $rules::FACTOR_TASA, $rules::USO_TRASLADO, '0.16'),
        );
    }
}
