<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\TiposPercepciones;
use PHPUnit\Framework\TestCase;

final class TiposPercepcionesTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'id' => '001',
        'texto' => 'Sueldos, Salarios  Rayas y Jornales',
        'vigencia_desde' => '2016-11-01',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $tiposPercepciones = new TiposPercepciones();
        $created = $tiposPercepciones->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime((string) $this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
