<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\ProductosServicios;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

final class ProductosServiciosTest extends UsingTestingDatabaseTestCase
{
    /** @var ProductosServicios */
    protected $productosServicios;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productosServicios = new ProductosServicios();
        $this->productosServicios->withRepository($this->getRepository());
    }

    public function testSearchProductosServicios(): void
    {
        $searchResults = $this->productosServicios->searchByText('%cerdo%');
        $this->assertGreaterThanOrEqual(2, count($searchResults));
        foreach ($searchResults as $productoServicio) {
            $this->assertStringContainsStringIgnoringCase('cerdo', $productoServicio->texto());
        }
    }
}
