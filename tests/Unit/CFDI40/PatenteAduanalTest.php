<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\PatenteAduanal;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class PatenteAduanalTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '0000';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $patenteAduanal = new PatenteAduanal($id, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $patenteAduanal);
        $this->assertSame($id, $patenteAduanal->id());
        $this->assertSame($id, $patenteAduanal->texto());
        $this->assertSame($vigenteDesde, $patenteAduanal->vigenteDesde());
        $this->assertSame($vigenteHasta, $patenteAduanal->vigenteHasta());
    }
}
