<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Mes;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class MesTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '01';
        $texto = 'Enero';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = 0;

        $mes = new Mes($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $mes);
        $this->assertSame($id, $mes->id());
        $this->assertSame($texto, $mes->texto());
        $this->assertSame($vigenteDesde, $mes->vigenteDesde());
        $this->assertSame($vigenteHasta, $mes->vigenteHasta());
    }
}
