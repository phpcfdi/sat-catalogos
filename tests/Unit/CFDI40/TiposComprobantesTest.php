<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\TiposComprobantes;
use PHPUnit\Framework\TestCase;

final class TiposComprobantesTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'id' => 'I',
        'texto' => 'Ingreso',
        'valor_maximo' => '999999999999999999.999999',
        'vigencia_desde' => '2017-07-29',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $tiposComprobantes = new TiposComprobantes();
        $created = $tiposComprobantes->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->valorMaximo(), $this->validRow['valor_maximo']);
        $this->assertSame($created->vigenteDesde(), strtotime((string) $this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
