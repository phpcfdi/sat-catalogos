<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Aduanas;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AduanasTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => '24',
        'texto' => 'NUEVO LAREDO',
        'vigencia_desde' => '2017-01-01',
        'vigencia_hasta' => 0,
    ];

    public function testObtain(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryById')->willReturn($this->validRow);

        $aduanas = new Aduanas();
        $aduanas->withRepository($repository);

        $aduana = $aduanas->obtain('24');
        $this->assertStringContainsString('LAREDO', $aduana->texto());
    }

    public function testCreate(): void
    {
        $aduanas = new Aduanas();
        $created = $aduanas->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
