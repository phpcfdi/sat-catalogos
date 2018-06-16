<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

class RepositoryTest extends UsingTestingDatabaseTestCase
{
    public function testQueryById()
    {
        $data = $this->getRepository()->queryById(Repository::CFDI_ADUANAS, '24');

        $this->assertInternalType('array', $data);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('texto', $data);
        $this->assertArrayHasKey('vigencia_desde', $data);
        $this->assertArrayHasKey('vigencia_hasta', $data);

        // this are valid values as of 2018-06-05
        $expected = [
            'id' => '24',
            'texto' => 'NUEVO LAREDO, NUEVO LAREDO, TAMAULIPAS.',
            'vigencia_desde' => '2017-01-01',
            'vigencia_hasta' => '',
        ];
        $this->assertEquals($expected, $data);
    }

    public function testThrowExceptionOnInvalidCatalogName()
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('catalog name');
        $this->getRepository()->queryById('foo_bar_baz', '');
    }

    public function testThrowExceptionWhenQueryByIdAndNotFound()
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('FooBar');
        $this->getRepository()->queryById(Repository::CFDI_PAISES, 'FooBar');
    }

    public function testQueryRowByFields()
    {
        $data = $this->getRepository()->queryRowByFields(Repository::CFDI_PAISES, ['texto' => 'México']);

        $expected = [
            'id' => 'MEX',
            'texto' => 'México',
        ];
        $this->assertArraySubset($expected, $data);
    }

    public function testThrowExceptionWhenQueryRowByFieldsAndNotFound()
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage("Cannot found cfdi_paises using texto 'Banania'");
        $this->getRepository()->queryRowByFields(Repository::CFDI_PAISES, ['texto' => 'Banania']);
    }
}
