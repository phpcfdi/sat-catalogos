<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Periodicidades;
use PhpCfdi\SatCatalogos\Repository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class PeriodicidadesTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => '0000',
        'texto' => '0000',
        'vigencia_desde' => '2000-01-01',
        'vigencia_hasta' => '',
    ];

    public function testObtainWithMock(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->createMock(Repository::class);
        $repository->method('queryById')->willReturn($this->validRow);

        $periodicidades = new Periodicidades();
        $periodicidades->withRepository($repository);

        $patenteAduanal = $periodicidades->obtain('0000');
        $this->assertStringContainsString('0000', $patenteAduanal->texto());
    }

    public function testCreate(): void
    {
        $periodicidades = new Periodicidades();
        $created = $periodicidades->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
