<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\OrigenesRecursos;
use PHPUnit\Framework\TestCase;

final class OrigenesRecursosTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'id' => 'IP',
        'texto' => 'Ingresos propios',
        'vigencia_desde' => '01-01-1970',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $origenesRecursos = new OrigenesRecursos();
        $created = $origenesRecursos->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime((string) $this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
