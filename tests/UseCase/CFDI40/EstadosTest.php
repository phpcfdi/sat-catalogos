<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Estado;
use PhpCfdi\SatCatalogos\CFDI40\Estados;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

class EstadosTest extends UsingTestingDatabaseTestCase
{
    /** @var Estados */
    protected $estados;

    protected function setUp(): void
    {
        parent::setUp();
        $this->estados = new Estados();
        $this->estados->withRepository($this->getRepository());
    }

    public function testObtainExistentEntry(): void
    {
        $estado = $this->estados->obtain('MOR', 'MEX');

        $this->assertSame('MOR', $estado->codigo());
        $this->assertSame('MEX', $estado->pais());
        $this->assertSame('Morelos', $estado->texto());
        $this->assertSame(strtotime('2022-01-01'), $estado->vigenteDesde());
        $this->assertSame(0, $estado->vigenteHasta());
    }

    public function testObtainNonExistentEntry(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('No se encontró un estado con código foo y país bar');
        $this->estados->obtain('foo', 'bar');
    }

    public function testObtainEstadosByPais(): void
    {
        $codes = array_map(
            function (Estado $estado): string {
                return $estado->codigo();
            },
            $this->estados->obtainEstadosByPais('MEX'),
        );
        $this->assertContains('MEX', $codes);
        $this->assertContains('MIC', $codes);
        $this->assertContains('MOR', $codes);
    }

    public function testSearchEstadosAll(): void
    {
        $codes = array_map(
            function (Estado $estado): string {
                return $estado->codigo();
            },
            $this->estados->searchEstados(),
        );
        $this->assertContains('MEX', $codes); // MEX México
        $this->assertContains('MI', $codes);  // US Michigan
        $this->assertContains('MA', $codes); // CA Manitoba
    }

    public function testSearchEstadosFilterByText(): void
    {
        $texts = array_unique(array_map(
            function (Estado $estado): string {
                return $estado->texto();
            },
            $this->estados->searchEstados('M%', '%'),
        ));
        $textsNotStartWithM = array_filter($texts, function (string $code): bool {
            return 'M' !== substr($code, 0, 1);
        });

        $this->assertContains('Morelos', $texts); // MEX Morelos
        $this->assertSame([], $textsNotStartWithM, 'Found an state with a non-matching text criteria');
    }

    public function testSearchEstadosFilterByCountry(): void
    {
        $countries = array_unique(array_map(
            function (Estado $estado): string {
                return $estado->pais();
            },
            $this->estados->searchEstados('%', 'M%'),
        ));
        $countriesNotStartWithM = array_filter($countries, function (string $code): bool {
            return 'M' !== substr($code, 0, 1);
        });

        $this->assertContains('MEX', $countries); // MEX
        $this->assertSame([], $countriesNotStartWithM, 'Found an state with a non-matching country criteria');
    }

    public function testSearchEstadosFilterByCode(): void
    {
        $codes = array_map(
            function (Estado $estado): string {
                return $estado->codigo();
            },
            $this->estados->searchEstados('%', '%', 'M%'),
        );
        $codesNotStartWithM = array_filter($codes, function (string $code): bool {
            return 'M' !== substr($code, 0, 1);
        });

        $this->assertContains('MOR', $codes); // MEX Morelos
        $this->assertContains('MI', $codes);  // USA Michigan
        $this->assertContains('MA', $codes);  // CAN Manitoba
        $this->assertSame([], $codesNotStartWithM, 'Found an state with a non-matching code criteria');
    }
}
