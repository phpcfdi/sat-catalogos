<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\SatCatalogos;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

class SatCatalogosTest extends UsingTestingDatabaseTestCase
{
    /** @var SatCatalogos */
    protected $satCatalogos;

    public function setUp()
    {
        parent::setUp();
        $this->satCatalogos = new SatCatalogos($this->getRepository());
    }

    public function testWithACatalogBadName()
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage("No se pudo encontrar el catálogo 'weird-name'");
        $this->satCatalogos->{'weird-name'}();
    }

    public function testWithACatalogNonExistent()
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage("No se pudo encontrar el catálogo 'thisCatalogDoesNotExists'");
        $this->satCatalogos->{'thisCatalogDoesNotExists'}();
    }

    public function testRetrieveACatalogTwiceReturnTheSameInstance()
    {
        $first = $this->satCatalogos->aduanas();
        $second = $this->satCatalogos->aduanas();
        $this->assertSame($first, $second);
    }

    public function testWithAnObjectThatIsNotACatalog()
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage("No se pudo encontrar el catálogo 'aduana'");
        $this->satCatalogos->{'aduana'}();
    }

    public function testCanObtainExistentAduana()
    {
        $aduana = $this->satCatalogos->aduanas()->obtain('24');
        $this->assertSame('24', $aduana->id());
    }

    public function testCanObtainExistentClaveUnidad()
    {
        $claveUnidad = $this->satCatalogos->clavesUnidades()->obtain('MTK');
        $this->assertSame('MTK', $claveUnidad->id());
    }

    public function testCanObtainExistentProductoServicio()
    {
        $productoServicio = $this->satCatalogos->productosServicios()->obtain('10101511');
        $this->assertSame('10101511', $productoServicio->id());
    }

    public function testCanObtainExistentCodigoPostal()
    {
        $productoServicio = $this->satCatalogos->codigosPostales()->obtain('52000');
        $this->assertSame('52000', $productoServicio->id());
    }

    public function testCanObtainExistentImpuesto()
    {
        $impuesto = $this->satCatalogos->impuestos()->obtain('002');
        $this->assertSame('002', $impuesto->id());
    }

    public function testCanObtainExistentFormaDePago()
    {
        $formaDePago = $this->satCatalogos->formasDePago()->obtain('03');
        $this->assertSame('03', $formaDePago->id());
    }

    public function testCanObtainExistentMetodoDePago()
    {
        $metodoDePago = $this->satCatalogos->metodosDePago()->obtain('PUE');
        $this->assertSame('PUE', $metodoDePago->id());
    }

    public function testCanObtainExistentMoneda()
    {
        $moneda = $this->satCatalogos->monedas()->obtain('MXN');
        $this->assertSame('MXN', $moneda->id());
    }

    public function testCanObtainExistentPais()
    {
        $pais = $this->satCatalogos->paises()->obtain('MEX');
        $this->assertSame('MEX', $pais->id());
    }

    public function testCanObtainExistentRegimenFiscal()
    {
        $regimenFiscal = $this->satCatalogos->regimenesFiscales()->obtain('601');
        $this->assertSame('601', $regimenFiscal->id());
    }

    public function testCanObtainExistentTipoRelacion()
    {
        $tipoRelacion = $this->satCatalogos->tiposRelaciones()->obtain('05');
        $this->assertSame('05', $tipoRelacion->id());
    }

    public function testCanObtainExistentUsoCfdi()
    {
        $usoCfdi = $this->satCatalogos->usosCfdi()->obtain('G02');
        $this->assertSame('G02', $usoCfdi->id());
    }
}
