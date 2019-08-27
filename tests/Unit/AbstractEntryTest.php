<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit;

use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\Tests\Unit\Fixtures\EntryImplementation;
use PHPUnit\Framework\TestCase;

class AbstractEntryTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'FOO';
        $texto = 'BAR BAZ';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $entry = new EntryImplementation($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryInterface::class, $entry);
        $this->assertSame($id, $entry->id());
        $this->assertSame($texto, $entry->texto());
        $this->assertSame($vigenteDesde, $entry->vigenteDesde());
        $this->assertSame($vigenteHasta, $entry->vigenteHasta());
    }

    public function testCreateWithInvalidId(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo ID');
        new EntryImplementation('', 'foo', 0, 0);
    }

    public function testCreateWithInvalidTexto(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo texto');
        new EntryImplementation('foo', '', 0, 0);
    }

    public function testCreateWithInvalidVigenciaDesde(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo vigente desde');
        new EntryImplementation('foo', 'bar', -1, 0);
    }

    public function testCreateWithInvalidVigenciaHasta(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo vigente hasta');
        new EntryImplementation('foo', 'bar', 0, -1);
    }
}
