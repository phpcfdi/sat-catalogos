<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Nomina;

use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PhpCfdi\SatCatalogos\Nomina\Estado;
use PHPUnit\Framework\TestCase;

final class EstadoTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $codigo = 'MOR';
        $pais = 'MEX';
        $texto = 'Morelos';

        $estado = new Estado($codigo, $pais, $texto);

        $this->assertInstanceOf(EntryWithVigencias::class, $estado);
        $this->assertSame($codigo, $estado->codigo());
        $this->assertSame($pais, $estado->pais());
        $this->assertSame($texto, $estado->texto());
    }
}
