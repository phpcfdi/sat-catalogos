<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\ClaveUnidad;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

class ClaveUnidadTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'MTK';
        $texto = 'Metro cuadrado';
        $descripcion = 'Es la unidad básica de superficie en el Sistema Internacional de Unidades.';
        $nota = 'Nota de ejemplo';
        $simbolo = 'm²';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $claveUnidad = new ClaveUnidad($id, $texto, $descripcion, $nota, $simbolo, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $claveUnidad);
        $this->assertSame($id, $claveUnidad->id());
        $this->assertSame($texto, $claveUnidad->texto());
        $this->assertSame($descripcion, $claveUnidad->descripcion());
        $this->assertSame($nota, $claveUnidad->nota());
        $this->assertSame($simbolo, $claveUnidad->simbolo());
        $this->assertSame($vigenteDesde, $claveUnidad->vigenteDesde());
        $this->assertSame($vigenteHasta, $claveUnidad->vigenteHasta());
    }
}
