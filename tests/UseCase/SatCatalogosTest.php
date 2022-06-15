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

    public function testCanObtainExistentAduana40(): void
    {
        $aduana = $this->satCatalogos->aduanas40()->obtain('24');
        $this->assertSame('24', $aduana->id());
    }

    public function testCanObtainExistentClaveUnidad(): void
    {
        $claveUnidad = $this->satCatalogos->clavesUnidades()->obtain('MTK');
        $this->assertSame('MTK', $claveUnidad->id());
    }

    public function testCanObtainExistentClaveUnidad40(): void
    {
        $claveUnidad = $this->satCatalogos->clavesUnidades40()->obtain('MTK');
        $this->assertSame('MTK', $claveUnidad->id());
    }

    public function testCanObtainExistentProductoServicio(): void
    {
        $productoServicio = $this->satCatalogos->productosServicios()->obtain('10101511');
        $this->assertSame('10101511', $productoServicio->id());
    }

    public function testCanObtainExistentProductoServicio40(): void
    {
        $productoServicio = $this->satCatalogos->productosServicios40()->obtain('10101511');
        $this->assertSame('10101511', $productoServicio->id());
    }

    public function testCanObtainExistentCodigoPostal(): void
    {
        $productoServicio = $this->satCatalogos->codigosPostales()->obtain('52000');
        $this->assertSame('52000', $productoServicio->id());
    }

    public function testCanObtainExistentCodigoPostal40(): void
    {
        $productoServicio = $this->satCatalogos->codigosPostales40()->obtain('52000');
        $this->assertSame('52000', $productoServicio->id());
    }

    public function testCanObtainExistentColonias40(): void
    {
        $productoServicio = $this->satCatalogos->colonias40()->obtain('2793', '04510');
        $this->assertSame('2793', $productoServicio->colonia());
        $this->assertSame('04510', $productoServicio->codigoPostal());
    }

    public function testCanObtainExistentImpuesto(): void
    {
        $impuesto = $this->satCatalogos->impuestos()->obtain('002');
        $this->assertSame('002', $impuesto->id());
    }

    public function testCanObtainExistentImpuesto40(): void
    {
        $impuesto = $this->satCatalogos->impuestos40()->obtain('002');
        $this->assertSame('002', $impuesto->id());
    }

    public function testCanObtainExistentFormaDePago(): void
    {
        $formaDePago = $this->satCatalogos->formasDePago()->obtain('03');
        $this->assertSame('03', $formaDePago->id());
    }

    public function testCanObtainExistentFormaDePago40(): void
    {
        $formaDePago = $this->satCatalogos->formasDePago40()->obtain('03');
        $this->assertSame('03', $formaDePago->id());
    }

    public function testCanObtainExistentMes40(): void
    {
        $metodoDePago = $this->satCatalogos->meses40()->obtain('01');
        $this->assertSame('01', $metodoDePago->id());
    }

    public function testCanObtainExistentMetodoDePago(): void
    {
        $metodoDePago = $this->satCatalogos->metodosDePago()->obtain('PUE');
        $this->assertSame('PUE', $metodoDePago->id());
    }

    public function testCanObtainExistentMetodoDePago40(): void
    {
        $metodoDePago = $this->satCatalogos->metodosDePago40()->obtain('PUE');
        $this->assertSame('PUE', $metodoDePago->id());
    }

    public function testCanObtainExistentMoneda(): void
    {
        $moneda = $this->satCatalogos->monedas()->obtain('MXN');
        $this->assertSame('MXN', $moneda->id());
    }

    public function testCanObtainExistentMoneda40(): void
    {
        $moneda = $this->satCatalogos->monedas40()->obtain('MXN');
        $this->assertSame('MXN', $moneda->id());
    }

    public function testCanObtainExistentPais(): void
    {
        $pais = $this->satCatalogos->paises()->obtain('MEX');
        $this->assertSame('MEX', $pais->id());
    }

    public function testCanObtainExistentPais40(): void
    {
        $pais = $this->satCatalogos->paises40()->obtain('MEX');
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

    public function testCanObtainExistentTipoRelacion40(): void
    {
        $tipoRelacion = $this->satCatalogos->tiposRelaciones40()->obtain('05');
        $this->assertSame('05', $tipoRelacion->id());
    }

    public function testCanObtainExistentUsoCfdi40(): void
    {
        $usoCfdi = $this->satCatalogos->usosCfdi40()->obtain('G02');
        $this->assertSame('G02', $usoCfdi->id());
    }

    public function testCanObtainExistentTipoFactor(): void
    {
        $tipoFactor = $this->satCatalogos->tiposFactores()->obtain('Tasa');
        $this->assertSame('Tasa', $tipoFactor->id());
    }

    public function testCanObtainExistentTipoFactor40(): void
    {
        $tipoFactor = $this->satCatalogos->tiposFactores40()->obtain('Tasa');
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

    public function testCanObtainExistentNumeroPedimentoAduana40(): void
    {
        $aduana = '43'; // 43 -> c_Aduanas
        $patente = '3420'; // 3420 -> c_PatenteAduanal
        $ejercicio = 2018; // pedimento: 18

        $pedimentoAduanaPatente = $this->satCatalogos->numerosPedimentoAduana40()->obtain(
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

    public function testCanFindMatchingReglaTasaCuota40(): void
    {
        $rules = $this->satCatalogos->reglasTasaCuota40();
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

    public function testCanObtainExistentPatenteAduanal40(): void
    {
        $patenteAduanal = $this->satCatalogos->patentesAduanales40()->obtain('9039');
        $this->assertSame('9039', $patenteAduanal->id());
    }

    public function testCanObtainExistentTipoComprobante(): void
    {
        $tipoComprobante = $this->satCatalogos->tiposComprobantes()->obtain('I');
        $this->assertSame('I', $tipoComprobante->id());
    }

    public function testCanObtainExistentTipoComprobante40(): void
    {
        $tipoComprobante = $this->satCatalogos->tiposComprobantes40()->obtain('I');
        $this->assertSame('I', $tipoComprobante->id());
    }

    public function testCanObtainExistentTipoNomina(): void
    {
        $tipoNomina = $this->satCatalogos->nominas()->obtain('E');
        $this->assertSame('E', $tipoNomina->id());
    }

    public function testCanObtainExistentTipoHora(): void
    {
        $tipoHora = $this->satCatalogos->horasExtras()->obtain('01');
        $this->assertSame('01', $tipoHora->id());
    }

    public function testCanObtainExistentTipoIncapacidad(): void
    {
        $tipoIncapacidad = $this->satCatalogos->incapacidades()->obtain('01');
        $this->assertSame('01', $tipoIncapacidad->id());
    }

    public function testCanObtainExistentTipoOtroPago(): void
    {
        $tipoOtroPago = $this->satCatalogos->otrosTipoPago()->obtain('001');
        $this->assertSame('001', $tipoOtroPago->id());
    }

    public function testCanObtainExistentTipoPercepcion(): void
    {
        $tipoPercepcion = $this->satCatalogos->percepciones()->obtain('001');
        $this->assertSame('001', $tipoPercepcion->id());
    }

    public function testCanObtainExistentBanco(): void
    {
        $banco = $this->satCatalogos->bancos()->obtain('002');
        $this->assertSame('002', $banco->id());
    }

    public function testCanObtainExistentEstado(): void
    {
        $estado = $this->satCatalogos->estados()->obtain('MOR', 'MEX');
        $this->assertSame('MOR', $estado->codigo());
        $this->assertSame('MEX', $estado->pais());
    }

    public function testCanObtainExistentPeriodicidadPago(): void
    {
        $periodicidad = $this->satCatalogos->periodicidadesPagos()->obtain('01');
        $this->assertSame('01', $periodicidad->id());
    }

    public function testCanObtainExistentRiesgoPuesto(): void
    {
        $riesgoPuesto = $this->satCatalogos->riesgosPuestos()->obtain('1');
        $this->assertSame('1', $riesgoPuesto->id());
    }

    public function testCanObtainExistentTipoContrato(): void
    {
        $tipoContrato = $this->satCatalogos->contratos()->obtain('01');
        $this->assertSame('01', $tipoContrato->id());
    }

    public function testCanObtainExistentTipoDeduccion(): void
    {
        $tipoDeduccion = $this->satCatalogos->deducciones()->obtain('001');
        $this->assertSame('001', $tipoDeduccion->id());
    }

    public function testCanObtainExistentTipoJornada(): void
    {
        $tipoJornada = $this->satCatalogos->jornadas()->obtain('01');
        $this->assertSame('01', $tipoJornada->id());
    }

    public function testCanObtainExistentOrigenRecurso(): void
    {
        $origenRecurso = $this->satCatalogos->origenesRecursos()->obtain('IP');
        $this->assertSame('IP', $origenRecurso->id());
    }

    public function testCanObtainExistentTipoRegimen(): void
    {
        $tipoRegimen = $this->satCatalogos->regimenesContratacion()->obtain('02');
        $this->assertSame('02', $tipoRegimen->id());
    }

    public function testSearchProductosServicios(): void
    {
        // seed database has 2 records, real database has more than 2
        $searchResults = $this->satCatalogos->productosServicios()->searchByText('%cerdo%');
        $this->assertGreaterThanOrEqual(2, count($searchResults));
    }

    public function testSearchProductosServicios40(): void
    {
        // seed database has 2 records, real database has more than 2
        $searchResults = $this->satCatalogos->productosServicios40()->searchByText('%cerdo%');
        $this->assertGreaterThanOrEqual(2, count($searchResults));
    }
}
