<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\OrigenesRecursos;
use PHPUnit\Framework\TestCase;

final class OrigenesRecursosTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => 'IP',
        'texto' => 'Ingresos propios',
        'vigencia_desde' => '2017-07-29',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $tiposNominas = new OrigenesRecursos();
        $created = $tiposNominas->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
