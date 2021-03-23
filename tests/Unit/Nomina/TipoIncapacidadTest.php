<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\TipoIncapacidad;
use PHPUnit\Framework\TestCase;

final class TipoIncapacidadTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '02';
        $texto = 'Enfermedad en general.';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $TipoIncapacidad = new TipoIncapacidad($id, $texto);

        $this->assertInstanceOf(EntryIdentifiable::class, $TipoIncapacidad);
        $this->assertSame($id, $TipoIncapacidad->id());
        $this->assertSame($texto, $TipoIncapacidad->texto());
        $this->assertSame($vigenteDesde, $TipoIncapacidad->vigenteDesde());
        $this->assertSame($vigenteHasta, $TipoIncapacidad->vigenteHasta());
    }
}
