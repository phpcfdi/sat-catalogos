<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI40;

use PhpCfdi\SatCatalogos\CFDI40\Colonia;
use PhpCfdi\SatCatalogos\Common\BaseEntry;
use PHPUnit\Framework\TestCase;

final class ColoniaTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $colonia = '2793';
        $codigoPostal = '04510';
        $asentamiento = 'Universidad Nacional Autónoma de México';

        $object = new Colonia($colonia, $codigoPostal, $asentamiento);

        $this->assertInstanceOf(BaseEntry::class, $object);
        $this->assertSame($colonia, $object->colonia());
        $this->assertSame($asentamiento, $object->asentamiento());
        $this->assertSame($codigoPostal, $object->codigoPostal());
    }
}
