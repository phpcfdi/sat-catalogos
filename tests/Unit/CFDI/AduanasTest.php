<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Aduanas;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AduanasTest extends TestCase
{
    protected $validRow = [
        'id' => '24',
        'texto' => 'NUEVO LAREDO',
        'vigencia_desde' => '2017-01-01',
        'vigencia_hasta' => '',
    ];

    public function testObtain()
    {
        /** @var MockObject|\PhpCfdi\SatCatalogos\Repository $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryById')->willReturn($this->validRow);

        $aduanas = new Aduanas($repository);

        $aduana = $aduanas->obtain('24');
        $this->assertContains('LAREDO', $aduana->texto());
    }

    public function testCreate()
    {
        /** @var MockObject|\PhpCfdi\SatCatalogos\Repository $repository */
        $repository = $this->createMock(Repository::class);
        $aduanas = new Aduanas($repository);
        $created = $aduanas->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
