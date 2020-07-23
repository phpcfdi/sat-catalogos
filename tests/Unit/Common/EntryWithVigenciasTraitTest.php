<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Common;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\Tests\Fixtures\EntryWithVigenciasTraitImplementation;
use PHPUnit\Framework\TestCase;

class EntryWithVigenciasTraitTest extends TestCase
{
    public function testSetupObject(): void
    {
        $specimen = new EntryWithVigenciasTraitImplementation(1, 2);
        $this->assertSame(1, $specimen->vigenteDesde());
        $this->assertSame(2, $specimen->vigenteHasta());
    }

    public function testSetupObjectWithNegativeStartTime(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo vigente desde no puede ser menor a cero');
        new EntryWithVigenciasTraitImplementation(-1, 0);
    }

    public function testSetupObjectWithNegativeEndTime(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage('El campo vigente hasta no puede ser menor a cero');
        new EntryWithVigenciasTraitImplementation(0, -1);
    }

    public function testZeroStartTimeDoesNotValidateTime(): void
    {
        $time = time();
        $specimen = new EntryWithVigenciasTraitImplementation(0, $time);
        $this->assertTrue($specimen->vigenteEn(-1));
        $this->assertTrue($specimen->vigenteEn(0));
        $this->assertTrue($specimen->vigenteEn($time));
        $this->assertFalse($specimen->vigenteEn($time + 1));
    }

    public function testZeroEndTimeDoesNotValidateTime(): void
    {
        $time = strtotime('yesterday');
        $specimen = new EntryWithVigenciasTraitImplementation($time, 0);
        $this->assertFalse($specimen->vigenteEn($time - 1));
        $this->assertTrue($specimen->vigenteEn($time));
        $this->assertTrue($specimen->vigenteEn($time + 1));
    }

    public function testVigenteEn(): void
    {
        $specimen = new EntryWithVigenciasTraitImplementation(1, 2);
        $this->assertTrue($specimen->vigenteEn(1));
        $this->assertTrue($specimen->vigenteEn(2));
        $this->assertFalse($specimen->vigenteEn(0));
        $this->assertFalse($specimen->vigenteEn(3));
    }

    public function testVigenteAhora(): void
    {
        $currentTime = time();
        $specimen = new EntryWithVigenciasTraitImplementation($currentTime, $currentTime);
        $this->assertTrue($specimen->vigenteAhora());
        $specimen = new EntryWithVigenciasTraitImplementation($currentTime - 1, $currentTime - 1);
        $this->assertFalse($specimen->vigenteAhora());
        $specimen = new EntryWithVigenciasTraitImplementation($currentTime + 1, $currentTime + 1);
        $this->assertFalse($specimen->vigenteAhora());
    }
}
