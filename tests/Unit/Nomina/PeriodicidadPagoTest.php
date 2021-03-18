<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\PeriodicidadPago;
use PHPUnit\Framework\TestCase;

final class PeriodicidadPagoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = '01';
        $texto = 'Diario';
        $vigenteDesde = 0;
        $vigenteHasta = 0;

        $periodicidadPago = new PeriodicidadPago($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $periodicidadPago);
        $this->assertSame($id, $periodicidadPago->id());
        $this->assertSame($texto, $periodicidadPago->texto());
        $this->assertSame($vigenteDesde, $periodicidadPago->vigenteDesde());
        $this->assertSame($vigenteHasta, $periodicidadPago->vigenteHasta());
    }
}
