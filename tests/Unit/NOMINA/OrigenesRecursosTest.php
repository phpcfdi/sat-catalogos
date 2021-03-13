<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\NOMINA;

use PhpCfdi\SatCatalogos\NOMINA\OrigenesRecursos;
use PHPUnit\Framework\TestCase;

final class OrigenesRecursosTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => 'IP',
        'texto' => 'Ingresos propios',
    ];

    public function testCreate(): void
    {
        $tiposNominas = new OrigenesRecursos();
        $created = $tiposNominas->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
    }
}
