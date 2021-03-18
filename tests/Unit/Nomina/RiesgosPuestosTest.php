<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\RiesgosPuestos;
use PHPUnit\Framework\TestCase;

final class RiesgosPuestosTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => '1',
        'texto' => 'Clase I',
        'vigencia_desde' => '2017-01-01',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $riesgosPuestos = new RiesgosPuestos();
        $created = $riesgosPuestos->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
