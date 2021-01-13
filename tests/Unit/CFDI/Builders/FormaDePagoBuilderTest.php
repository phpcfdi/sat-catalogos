<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI\Builders;

use PhpCfdi\SatCatalogos\CFDI\Builders\FormaDePagoBuilder;
use PhpCfdi\SatCatalogos\CFDI\FormaDePago;
use PHPUnit\Framework\TestCase;

final class FormaDePagoBuilderTest extends TestCase
{
    public function testBuilderCanCreateADefaultFormaDePago(): void
    {
        $builder = new FormaDePagoBuilder();
        $formaDePago = $builder->make('03', []);
        $this->assertInstanceOf(FormaDePago::class, $formaDePago);
    }

    public function testMakePassingIdAsValue(): void
    {
        $builder = new FormaDePagoBuilder();
        $formaDePago = $builder->make('03', ['id' => '05']);
        $this->assertSame('03', $formaDePago->id());
    }

    public function testMakePassingaProperty(): void
    {
        $builder = new FormaDePagoBuilder();
        $formaDePagoA = $builder->make('03', ['esBancarizado' => false]);
        $formaDePagoB = $builder->make('03', ['esBancarizado' => true]);
        $this->assertFalse($formaDePagoA->esBancarizado());
        $this->assertTrue($formaDePagoB->esBancarizado());
    }
}
