<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\Banco;
use PHPUnit\Framework\TestCase;

final class BancoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '002';
        $texto = 'BANAMEX';
        $razonSocial = 'Banco Nacional de México, S.A., Institución de Banca Múltiple, Grupo Financiero Banamex';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $banco = new Banco($id, $texto, $razonSocial, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $banco);
        $this->assertSame($id, $banco->id());
        $this->assertSame($texto, $banco->texto());
        $this->assertSame($razonSocial, $banco->razonSocial());
        $this->assertSame($vigenteDesde, $banco->vigenteDesde());
        $this->assertSame($vigenteHasta, $banco->vigenteHasta());
    }
}
