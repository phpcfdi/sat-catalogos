<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\Aduana;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class AduanaTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '24';
        $texto = 'ADUANA NUEVO LAREDO';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = strtotime('2018-12-31');

        $aduana = new Aduana($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->assertInstanceOf(EntryIdentifiable::class, $aduana);

        $this->assertSame($id, $aduana->id());
        $this->assertSame($texto, $aduana->texto());
        $this->assertSame($vigenteDesde, $aduana->vigenteDesde());
        $this->assertSame($vigenteHasta, $aduana->vigenteHasta());
    }
}
