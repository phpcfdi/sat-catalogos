<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\PatentesAduanales;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PatentesAduanalesTest extends TestCase
{
    protected $validRow = [
        'id' => '0000',
        'texto' => '0000',
        'vigencia_desde' => '2000-01-01',
        'vigencia_hasta' => '',
    ];

    public function testObtainWithMock()
    {
        /** @var MockObject|\PhpCfdi\SatCatalogos\Repository $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryById')->willReturn($this->validRow);

        $patentesAduanales = new PatentesAduanales();
        $patentesAduanales->withRepository($repository);

        $patenteAduanal = $patentesAduanales->obtain('0000');
        $this->assertContains('0000', $patenteAduanal->texto());
    }

    public function testCreate()
    {
        $patentesAduanales = new PatentesAduanales();
        $created = $patentesAduanales->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
