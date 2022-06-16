<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\TiposDeducciones;
use PHPUnit\Framework\TestCase;

final class TiposDeduccionesTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'id' => '01',
        'texto' => 'Seguridad social',
        'vigencia_desde' => '2016-11-01',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $tiposDeducciones = new TiposDeducciones();
        $created = $tiposDeducciones->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime((string) $this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
