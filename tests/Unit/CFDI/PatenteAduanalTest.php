<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\PatenteAduanal;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

class PatenteAduanalTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '0000';
        $texto = '0000';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $patenteAduanal = new PatenteAduanal($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $patenteAduanal);
        $this->assertSame($id, $patenteAduanal->id());
        $this->assertSame($texto, $patenteAduanal->texto());
        $this->assertSame($vigenteDesde, $patenteAduanal->vigenteDesde());
        $this->assertSame($vigenteHasta, $patenteAduanal->vigenteHasta());
    }
}
