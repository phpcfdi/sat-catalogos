<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Nomina\Bancos;
use PHPUnit\Framework\TestCase;

final class BancosTest extends TestCase
{
    /** @var array<string, scalar> */
    protected $validRow = [
        'id' => '002',
        'texto' => 'BANAMEX',
        'razon_social' => 'Banco Nacional de México, S.A., Institución de Banca Múltiple, Grupo Financiero Banamex',
        'vigencia_desde' => '2017-01-01',
        'vigencia_hasta' => 0,
    ];

    public function testCreate(): void
    {
        $bancos = new Bancos();
        $created = $bancos->create($this->validRow);

        $this->assertSame($created->id(), $this->validRow['id']);
        $this->assertSame($created->texto(), $this->validRow['texto']);
        $this->assertSame($created->razonSocial(), $this->validRow['razon_social']);
        $this->assertSame($created->vigenteDesde(), strtotime((string) $this->validRow['vigencia_desde']));
        $this->assertSame($created->vigenteHasta(), 0);
    }
}
