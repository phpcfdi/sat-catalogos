<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\Estados;
use PHPUnit\Framework\TestCase;

final class EstadosTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'estado' => 'MOR',
        'pais' => 'MEX',
        'texto' => 'Morelos',
    ];

    public function testCreate(): void
    {
        $estados = new Estados();
        $created = $estados->createEstado($this->validRow);

        $this->assertSame($created->codigo(), $this->validRow['estado']);
        $this->assertSame($created->pais(), $this->validRow['pais']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
    }
}
