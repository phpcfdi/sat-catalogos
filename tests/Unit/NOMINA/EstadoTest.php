<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\NOMINA;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\NOMINA\Estado;
use PHPUnit\Framework\TestCase;

final class EstadoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $estado = 'AGU';
        $pais = 'MEX';
        $texto = 'Aguascalientes';

        $estado = new Estado(
            $estado,
            $pais,
            $texto,
        );

        $this->assertInstanceOf(EntryIdentifiable::class, $estado);
        $this->assertSame($estado, $estado->estado);
        $this->assertSame($pais, $estado->pais);
        $this->assertSame($texto, $estado->texto);
    }
}
