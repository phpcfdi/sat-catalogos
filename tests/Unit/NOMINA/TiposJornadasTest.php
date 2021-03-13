<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\NOMINA;

use PhpCfdi\SatCatalogos\NOMINA\TiposNominas;
use PHPUnit\Framework\TestCase;

final class TiposNominasTest extends TestCase
{
    /** @var array<string, mixed> */
    protected $validRow = [
        'id' => '01',
        'texto' => 'Diurna',
    ];

    public function testCreate(): void
    {
        $tiposNominas = new TiposNominas();
        $created = $tiposNominas->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
    }
}
