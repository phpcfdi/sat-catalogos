<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\TiposRegimenes;
use PHPUnit\Framework\TestCase;

final class TiposRegimenesTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'id' => '02',
        'texto' => 'Sueldos (Incluye ingresos señalados en la fracción I del artículo 94 de LISR)',
        'vigencia_desde' => '01-01-1970',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $tiposRegimenes = new TiposRegimenes();
        $created = $tiposRegimenes->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime((string) $this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
