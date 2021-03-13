<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\NOMINA;

use PhpCfdi\SatCatalogos\NOMINA\TiposRegimenes;
use PHPUnit\Framework\TestCase;

final class TiposRegimenesTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => '02',
        'texto' => 'Sueldos (Incluye ingresos señalados en la fracción I del artículo 94 de LISR)',
    ];

    public function testCreate(): void
    {
        $tiposRegimenes = new TiposRegimenes();
        $created = $tiposRegimenes->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
    }
}
