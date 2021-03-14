<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\UseCase;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\SatCatalogos;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

final class SatCatalogosTest extends UsingTestingDatabaseTestCase
{
    /** @var SatCatalogos */
    protected $satCatalogos;

    protected function setUp(): void
    {
        parent::setUp();
        $this->satCatalogos = new SatCatalogos($this->getRepository());
    }

    public function testWithACatalogBadName(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage("No se pudo encontrar el catálogo 'weird-name'");
        $this->satCatalogos->{'weird-name'}();
    }

    public function testWithACatalogNonExistent(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage("No se pudo encontrar el catálogo 'thisCatalogDoesNotExists'");
        $this->satCatalogos->{'thisCatalogDoesNotExists'}();
    }

    public function testRetrieveACatalogTwiceReturnTheSameInstance(): void
    {
        $first = $this->satCatalogos->aduanas();
        $second = $this->satCatalogos->aduanas();
        $this->assertSame($first, $second);
    }

    public function testWithAnObjectThatIsNotACatalog(): void
    {
        $this->expectException(SatCatalogosLogicException::class);
        $this->expectExceptionMessage("No se pudo encontrar el catálogo 'aduana'");
        $this->satCatalogos->{'aduana'}();
    }

    public function testCanObtainExistentAduana(): void
    {
        $aduana = $this->satCatalogos->aduanas()->obtain('24');
        $this->assertSame('24', $aduana->id());
    }

    public function testCanObtainExistentClaveUnidad(): void
    {
        $claveUnidad = $this->satCatalogos->clavesUnidades()->obtain('MTK');
        $this->assertSame('MTK', $claveUnidad->id());
    }

    public function testCanObtainExistentProductoServicio(): void
    {
        $productoServicio = $this->satCatalogos->productosServicios()->obtain('10101511');
        $this->assertSame('10101511', $productoServicio->id());
    }

    public function testCanObtainExistentCodigoPostal(): void
    {
        $productoServicio = $this->satCatalogos->codigosPostales()->obtain('52000');
        $this->assertSame('52000', $productoServicio->id());
    }

    public function testCanObtainExistentImpuesto(): void
    {
        $impuesto = $this->satCatalogos->impuestos()->obtain('002');
        $this->assertSame('002', $impuesto->id());
    }

    public function testCanObtainExistentFormaDePago(): void
    {
        $formaDePago = $this->satCatalogos->formasDePago()->obtain('03');
        $this->assertSame('03', $formaDePago->id());
    }

    public function testCanObtainExistentMetodoDePago(): void
    {
        $metodoDePago = $this->satCatalogos->metodosDePago()->obtain('PUE');
        $this->assertSame('PUE', $metodoDePago->id());
    }

    public function testCanObtainExistentMoneda(): void
    {
        $moneda = $this->satCatalogos->monedas()->obtain('MXN');
        $this->assertSame('MXN', $moneda->id());
    }

    public function testCanObtainExistentPais(): void
    {
        $pais = $this->satCatalogos->paises()->obtain('MEX');
        $this->assertSame('MEX', $pais->id());
    }

    public function testCanObtainExistentRegimenFiscal(): void
    {
        $regimenFiscal = $this->satCatalogos->regimenesFiscales()->obtain('601');
        $this->assertSame('601', $regimenFiscal->id());
    }

    public function testCanObtainExistentTipoRelacion(): void
    {
        $tipoRelacion = $this->satCatalogos->tiposRelaciones()->obtain('05');
        $this->assertSame('05', $tipoRelacion->id());
    }

    public function testCanObtainExistentUsoCfdi(): void
    {
        $usoCfdi = $this->satCatalogos->usosCfdi()->obtain('G02');
        $this->assertSame('G02', $usoCfdi->id());
    }

    public function testCanObtainExistentTipoFactor(): void
    {
        $tipoFactor = $this->satCatalogos->tiposFactores()->obtain('Tasa');
        $this->assertSame('Tasa', $tipoFactor->id());
    }

    public function testCanObtainExistentNumeroPedimentoAduana(): void
    {
        $aduana = '43'; // 43 -> c_Aduanas
        $patente = '3420'; // 3420 -> c_PatenteAduanal
        $ejercicio = 2018; // pedimento: 18

        $pedimentoAduanaPatente = $this->satCatalogos->numerosPedimentoAduana()->obtain(
            $aduana,
            $patente,
            $ejercicio
        );

        $this->assertSame($aduana, $pedimentoAduanaPatente->aduana());
        $this->assertSame($patente, $pedimentoAduanaPatente->patente());
        $this->assertSame($ejercicio, $pedimentoAduanaPatente->ejercicio());
        $this->assertSame(999999, $pedimentoAduanaPatente->cantidad());
    }

    public function testCanFindMatchingReglaTasaCuota(): void
    {
        $rules = $this->satCatalogos->reglasTasaCuota();
        $this->assertTrue(
            $rules->hasMatchingRule($rules::IMPUESTO_IVA, $rules::FACTOR_TASA, $rules::USO_TRASLADO, '0.160000')
        );
        $this->assertFalse(
            $rules->hasMatchingRule($rules::IMPUESTO_IVA, $rules::FACTOR_TASA, $rules::USO_TRASLADO, '0.16')
        );
    }

    public function testCanObtainExistentPatenteAduanal(): void
    {
        $patenteAduanal = $this->satCatalogos->patentesAduanales()->obtain('9039');
        $this->assertSame('9039', $patenteAduanal->id());
    }

    public function testCanObtainExistentTipoComprobante(): void
    {
        $tipoComprobante = $this->satCatalogos->tiposComprobantes()->obtain('I');
        $this->assertSame('I', $tipoComprobante->id());
    }

    public function testCanObtainExistentTipoNomina(): void
    {
        $tipoNomina = $this->satCatalogos->tiposNominas()->obtain('E');
        $this->assertSame('E', $tipoNomina->id());
    }

    public function testCanObtainExistentTipoJornada(): void
    {
        $tipoJornada = $this->satCatalogos->tiposJornadas()->obtain('01');
        $this->assertSame('01', $tipoJornada->id());
    }

    public function testCanObtainExistentOrigenRecurso(): void
    {
        $origenRecurso = $this->satCatalogos->origenesRecursos()->obtain('IP');
        $this->assertSame('IP', $origenRecurso->id());
    }

    public function testCanObtainExistentTipoRegimen(): void
    {
        $tipoRegimen = $this->satCatalogos->tiposRegimenes()->obtain('02');
        $this->assertSame('02', $tipoRegimen->id());
    }

    public function testSearchProductosServicios(): void
    {
        // seed database has 2 records, real database has more than 2
        $searchResults = $this->satCatalogos->productosServicios()->searchByText('%cerdo%');
        $this->assertGreaterThanOrEqual(2, count($searchResults));
    }
}
