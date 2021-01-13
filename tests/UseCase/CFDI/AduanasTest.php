<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Aduanas;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

final class AduanasTest extends UsingTestingDatabaseTestCase
{
    /** @var Aduanas */
    protected $aduanas;

    protected function setUp(): void
    {
        parent::setUp();
        $this->aduanas = new Aduanas();
        $this->aduanas->withRepository($this->getRepository());
    }

    public function testObtainExistentEntry(): void
    {
        $aduana = $this->aduanas->obtain('24');

        $this->assertSame('24', $aduana->id());
        $this->assertStringContainsString('NUEVO LAREDO', $aduana->texto());
        $this->assertSame('2017-01-01', date('Y-m-d', $aduana->vigenteDesde()));
        $this->assertSame(0, $aduana->vigenteHasta());
    }

    public function testObtainNonExistentEntry(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage(Repository::CFDI_ADUANAS);
        $this->aduanas->obtain('foo');
    }

    public function testEntryExists(): void
    {
        $this->assertTrue($this->aduanas->exists('24'));
        $this->assertFalse($this->aduanas->exists('foo'));
    }
}
