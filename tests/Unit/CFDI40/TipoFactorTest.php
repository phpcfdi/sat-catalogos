<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\TipoFactor;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PHPUnit\Framework\TestCase;

final class TipoFactorTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'Tasa';

        $tipoFactor = new TipoFactor($id);

        $this->assertInstanceOf(EntryIdentifiable::class, $tipoFactor);
        $this->assertSame($id, $tipoFactor->id());
    }
}
