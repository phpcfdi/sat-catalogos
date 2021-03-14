<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\TiposNominas;
use PHPUnit\Framework\TestCase;

final class TiposNominasTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => 'O',
        'texto' => 'Nómina ordinaria',
        'vigencia_desde' => '01-01-1970',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $tiposNominas = new TiposNominas();
        $created = $tiposNominas->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->vigenteDesde(), strtotime($this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
