<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\Helpers;

use PhpCfdi\SatCatalogos\Exceptions\PatronException;
use PhpCfdi\SatCatalogos\Helpers\Patron;
use PHPUnit\Framework\TestCase;

class PatronTest extends TestCase
{
    public function testPatronCreate()
    {
        $origen = '[0-9]{6}';
        $regularExpression = '/^[0-9]{6}$/u';
        $correcto = '987654';
        $incorrecto = 'xxxxxx';

        $patron = new Patron($origen);
        $this->assertSame($origen, $patron->origen());
        $this->assertSame($regularExpression, $patron->expresion());
        $this->assertSame(Patron::VACIO_PERMITE_TODO, $patron->alEstarVacio());
        $this->assertTrue($patron->evalua($correcto));
        $this->assertFalse($patron->evalua($incorrecto));
    }

    public function testPatronWithInvalidSource()
    {
        $this->expectException(PatronException::class);
        new Patron('/');
    }

    public function testPatronWhenEmptyMeansForbidden()
    {
        $patron = new Patron('', Patron::VACIO_PERMITE_NADA);
        $this->assertSame(Patron::VACIO_PERMITE_NADA, $patron->alEstarVacio());
        $this->assertTrue($patron->evalua(''));
        $this->assertFalse($patron->evalua('xxx'));
    }

    public function testPatronWhenEmptyMeansAnything()
    {
        $patron = new Patron('', Patron::VACIO_PERMITE_TODO);
        $this->assertSame(Patron::VACIO_PERMITE_TODO, $patron->alEstarVacio());
        $this->assertTrue($patron->evalua(''));
        $this->assertTrue($patron->evalua('xxx'));
    }

    public function testPatronWithLettterEnie()
    {
        $patron = new Patron('\w');
        $this->assertTrue($patron->evalua('N'));
        $this->assertTrue($patron->evalua('Ñ'));
    }
}
