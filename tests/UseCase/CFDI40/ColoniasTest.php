<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Colonia;
use PhpCfdi\SatCatalogos\CFDI40\Colonias;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

final class ColoniasTest extends UsingTestingDatabaseTestCase
{
    /** @var Colonias */
    protected $colonias;

    protected function setUp(): void
    {
        parent::setUp();
        $this->colonias = new Colonias();
        $this->colonias->withRepository($this->getRepository());
    }

    public function testObtainExistentEntry(): void
    {
        $colonia = $this->colonias->obtain('0002', '86000');
        $this->assertSame('0002', $colonia->colonia());
        $this->assertSame('86000', $colonia->codigoPostal());
        $this->assertSame('Villahermosa Centro', $colonia->asentamiento());
    }

    public function testObtainNonExistentEntry(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('No se encontró una colonia foo con código postal bar');
        $this->colonias->obtain('foo', 'bar');
    }

    public function testSearchColoniasByCodigoPostal(): void
    {
        $colonias = $this->colonias->searchColonias('%', '8600%');
        $codesFound = array_map(
            function (Colonia $colonia): string {
                return $colonia->colonia();
            },
            $colonias,
        );
        $this->assertContains('0001', $codesFound);
        $this->assertContains('0002', $codesFound);
        $this->assertContains('1477', $codesFound);
        $this->assertContains('0009', $codesFound);
    }

    public function testSearchColoniasByCodigoPostalAndCode(): void
    {
        $colonias = $this->colonias->searchColonias('000%', '8600%');
        $codesFound = array_map(
            function (Colonia $colonia): string {
                return $colonia->colonia();
            },
            $colonias,
        );
        $this->assertContains('0001', $codesFound);
        $this->assertContains('0002', $codesFound);
        $this->assertContains('0009', $codesFound);
        $this->assertNotContains('1477', $codesFound);
    }

    public function testSearchColoniasByCodigoPostalAndCodeAndName(): void
    {
        $colonias = $this->colonias->searchColonias('000%', '8600%', '%Centro%');
        $codesFound = array_map(
            function (Colonia $colonia): string {
                return $colonia->colonia();
            },
            $colonias,
        );
        $this->assertContains('0002', $codesFound);
        $this->assertNotContains('0001', $codesFound);
        $this->assertNotContains('0009', $codesFound);
        $this->assertNotContains('1477', $codesFound);
    }
}
