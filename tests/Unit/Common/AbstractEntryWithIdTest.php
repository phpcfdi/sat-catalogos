<?php

/** @noinspection PhpExpressionResultUnusedInspection */

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Common;

use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\Tests\Fixtures\EntryIdentifiableImplementation;
use PHPUnit\Framework\TestCase;

final class AbstractEntryWithIdTest extends TestCase
{
    public function testCreateInstance(): void
    {
        $id = 'FOO';
        $texto = 'BAR BAZ';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $entry = new EntryIdentifiableImplementation($id, $texto, $vigenteDesde, $vigenteHasta);

        $this->assertInstanceOf(EntryIdentifiable::class, $entry);
        $this->assertSame($id, $entry->id());
        $this->assertSame($texto, $entry->texto());
        $this->assertSame($vigenteDesde, $entry->vigenteDesde());
        $this->assertSame($vigenteHasta, $entry->vigenteHasta());
    }

    public function testCreateWithInvalidId(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo ID');
        new EntryIdentifiableImplementation('', 'foo', 0, 0);
    }

    public function testCreateWithInvalidTexto(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo texto');
        new EntryIdentifiableImplementation('foo', '', 0, 0);
    }

    public function testCreateWithInvalidVigenciaDesde(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo vigente desde');
        new EntryIdentifiableImplementation('foo', 'bar', -1, 0);
    }

    public function testCreateWithInvalidVigenciaHasta(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo vigente hasta');
        new EntryIdentifiableImplementation('foo', 'bar', 0, -1);
    }
}
