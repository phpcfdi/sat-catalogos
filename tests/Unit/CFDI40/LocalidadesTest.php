<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Localidades;
use PHPUnit\Framework\TestCase;

final class LocalidadesTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'localidad' => '02',
        'estado' => 'QUE',
        'texto' => 'San Juan del Rio',
        'vigencia_desde' => '2000-01-01',
        'vigencia_hasta' => '',
    ];

    public function testCreate(): void
    {
        $localidades = new Localidades();
        $created = $localidades->create($this->validRow);

        $this->assertSame($created->codigo(), $this->validRow['localidad']);
        $this->assertSame($created->estado(), $this->validRow['estado']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
