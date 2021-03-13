<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Nomina\Estado;
use PHPUnit\Framework\TestCase;

final class EstadoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $estado = 'Aguascalientes';
        $pais = 'MEX';

        $estado = new Estado(
            $estado,
            $pais,
        );

        $this->assertInstanceOf(EntryIdentifiable::class, $estado);
        $this->assertSame($estado, $estado->texto());
    }
}
