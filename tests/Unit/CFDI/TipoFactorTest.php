<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\TipoFactor;
use PhpCfdi\SatCatalogos\EntryInterface;
use PHPUnit\Framework\TestCase;

class TipoFactorTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'Tasa';

        $tipoFactor = new TipoFactor($id);

        $this->assertInstanceOf(EntryInterface::class, $tipoFactor);
        $this->assertSame($id, $tipoFactor->id());
    }
}
