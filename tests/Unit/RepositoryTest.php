<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit;

use LogicException;
use PDO;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;
use PhpCfdi\SatCatalogos\Repository;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;
use PHPUnit\Framework\MockObject\MockObject;

final class RepositoryTest extends UsingTestingDatabaseTestCase
{
    public function testQueryById(): void
    {
        $data = $this->getRepository()->queryById(Repository::CFDI_ADUANAS, '24');

        $this->assertIsArray($data);
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

    public function testThrowExceptionOnInvalidCatalogName(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('catalog name');
        $this->getRepository()->queryById('foo_bar_baz', '');
    }

    /** @return array<array<int>> */
    public function providerQueryThrowExceptionWhenStatementPrepareFails(): array
    {
        return [
            'PDO::ERRMODE_SILENT' => [PDO::ERRMODE_SILENT],
            'PDO::ERRMODE_WARNING' => [PDO::ERRMODE_WARNING],
            'PDO::ERRMODE_EXCEPTION' => [PDO::ERRMODE_EXCEPTION],
        ];
    }

    /**
     * @param int $mode
     * @dataProvider providerQueryThrowExceptionWhenStatementPrepareFails
     */
    public function testQueryThrowExceptionWhenStatementPrepareFails(int $mode): void
    {
        /*
         * This test produces the error on query by id to CFDI_NUMEROS_PEDIMENTO_ADUANA
         * since the table does not contains id
         */
        $pdo = new PDO('sqlite::memory:', '', '', [
            PDO::ATTR_ERRMODE => $mode,
        ]);
        $this->seedPdo($pdo);
        $repository = new Repository($pdo);

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Cannot prepare the statement');
        $repository->queryById(Repository::CFDI_NUMEROS_PEDIMENTO_ADUANA, 'foo');
    }

    public function testThrowExceptionWhenQueryByIdAndNotFound(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('FooBar');
        $this->getRepository()->queryById(Repository::CFDI_PAISES, 'FooBar');
    }

    public function testQueryRowByFields(): void
    {
        $data = $this->getRepository()->queryRowByFields(Repository::CFDI_PAISES, ['texto' => 'México']);

        $expected = [
            'id' => 'MEX',
            'texto' => 'México',
        ];
        $this->assertEquals($expected, array_intersect_key($data, $expected));
    }

    public function testThrowExceptionWhenQueryRowByFieldAndNotFound(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage("Cannot found cfdi_paises using texto 'Banania'");
        $this->getRepository()->queryRowByFields(Repository::CFDI_PAISES, ['texto' => 'Banania']);
    }

    public function testThrowExceptionWhenQueryRowByFieldsAndNotFound(): void
    {
        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('Cannot found cfdi_paises using (texto, id) with values (Banania, ###)');
        $this->getRepository()->queryRowByFields(Repository::CFDI_PAISES, ['texto' => 'Banania', 'id' => '###']);
    }

    public function testThrowExceptionWhenQueryRowByFieldsWithoutFilter(): void
    {
        /** @var Repository&MockObject $repository */
        $repository = $this->getMockBuilder(Repository::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['queryRowByFields'])
            ->getMock();
        $repository->method('queryRowsByFields')->willReturn([]);

        $this->expectException(SatCatalogosNotFoundException::class);
        $this->expectExceptionMessage('Cannot found any cfdi_paises without filter');
        $repository->queryRowByFields(Repository::CFDI_PAISES, []);
    }

    public function testQueryByIds(): void
    {
        $entries = $this->getRepository()->queryByIds(
            Repository::CFDI_PRODUCTOS_SERVICIOS,
            ['10101511', '10109999', '10122101'] // only 10101511 and 10122101 must exists
        );
        $this->assertCount(2, $entries);
        $this->assertSame('10101511', $entries[0]['id']);
        $this->assertSame('10122101', $entries[1]['id']);
    }
}
