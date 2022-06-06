<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Exportacion;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class ExportacionTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '01';
        $texto = 'No aplica';
        $vigenteDesde = strtotime('2022-01-01');
        $vigenteHasta = 0;

        $exportacion = new Exportacion($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $exportacion);
        $this->assertSame($id, $exportacion->id());
        $this->assertSame($texto, $exportacion->texto());
        $this->assertSame($vigenteDesde, $exportacion->vigenteDesde());
        $this->assertSame($vigenteHasta, $exportacion->vigenteHasta());
    }
}