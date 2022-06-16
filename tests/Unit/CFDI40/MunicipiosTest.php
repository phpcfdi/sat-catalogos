<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Municipios;
use PHPUnit\Framework\TestCase;

final class MunicipiosTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'municipio' => '004',
        'estado' => 'TAB',
        'texto' => 'Centro',
        'vigencia_desde' => '2022-01-01',
        'vigencia_hasta' => '',
    ];

    public function testCreate(): void
    {
        $municipios = new Municipios();
        $created = $municipios->create($this->validRow);

        $this->assertSame($created->codigo(), $this->validRow['municipio']);
        $this->assertSame($created->estado(), $this->validRow['estado']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime((string) $this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
