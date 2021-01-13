<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Helpers;

use PhpCfdi\SatCatalogos\Exceptions\PatronException;
use PhpCfdi\SatCatalogos\Helpers\Patron;
use PHPUnit\Framework\TestCase;

final class PatronTest extends TestCase
{
    public function testPatronCreate(): void
    {
        $origen = '[0-9]{6}';
        $regularExpression = '/^[0-9]{6}$/u';
        $correcto = '987654';
        $incorrecto = 'xxxxxx';

        $patron = new Patron($origen);
        $this->assertSame($origen, $patron->origen());
        $this->assertSame($origen, strval($patron));
        $this->assertSame($regularExpression, $patron->expresion());
        $this->assertSame(Patron::VACIO_PERMITE_TODO, $patron->alEstarVacio());
        $this->assertTrue($patron->evalua($correcto));
        $this->assertFalse($patron->evalua($incorrecto));
    }

    public function testPatronWithInvalidSource(): void
    {
        $this->expectException(PatronException::class);
        new Patron('/');
    }

    public function testPatronWhenEmptyMeansForbidden(): void
    {
        $patron = new Patron('', Patron::VACIO_PERMITE_NADA);
        $this->assertSame(Patron::VACIO_PERMITE_NADA, $patron->alEstarVacio());
        $this->assertTrue($patron->evalua(''));
        $this->assertFalse($patron->evalua('xxx'));
    }

    public function testPatronWhenEmptyMeansAnything(): void
    {
        $patron = new Patron('', Patron::VACIO_PERMITE_TODO);
        $this->assertSame(Patron::VACIO_PERMITE_TODO, $patron->alEstarVacio());
        $this->assertTrue($patron->evalua(''));
        $this->assertTrue($patron->evalua('xxx'));
    }

    public function testPatronWithLettterEnie(): void
    {
        $patron = new Patron('\w');
        $this->assertTrue($patron->evalua('N'));
        $this->assertTrue($patron->evalua('Ñ'));
    }
}
