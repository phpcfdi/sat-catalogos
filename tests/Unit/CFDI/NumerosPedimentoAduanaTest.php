<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\NumerosPedimentoAduana;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class NumerosPedimentoAduanaTest extends TestCase
{
    protected $validRow = [
        'aduana' => '24',
        'patente' => '3420',
        'ejercicio' => 2018,
        'cantidad' => 999999,
        'vigencia_desde' => '2017-01-01',
        'vigencia_hasta' => '',
    ];

    public function testObtain()
    {
        /** @var MockObject|\PhpCfdi\SatCatalogos\Repository $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryRowByFields')->willReturn($this->validRow);

        $numerosPedimentoAduana = new NumerosPedimentoAduana();
        $numerosPedimentoAduana->withRepository($repository);

        $NumeroPedimentoAduana = $numerosPedimentoAduana->obtain('24', '3420', 2018);
        $this->assertSame(999999, $NumeroPedimentoAduana->cantidad());
    }

    public function testCreate()
    {
        $NumerosPedimentoAduana = new NumerosPedimentoAduana();
        $created = $NumerosPedimentoAduana->create($this->validRow);

        $this->assertSame($created->aduana(), $this->validRow['aduana']);
        $this->assertSame($created->patente(), $this->validRow['patente']);
        $this->assertSame($created->ejercicio(), $this->validRow['ejercicio']);
        $this->assertSame($created->cantidad(), $this->validRow['cantidad']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
