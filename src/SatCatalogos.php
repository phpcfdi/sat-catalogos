<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

use LogicException;
use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

/**
 * Class SatCatalogos
 *
 * @method CFDI\Aduanas                   aduanas();
 * @method CFDI\ClavesUnidades            clavesUnidades();
 * @method CFDI\CodigosPostales           codigosPostales();
 * @method CFDI\FormasDePago              formasDePago();
 * @method CFDI\Impuestos                 impuestos();
 * @method CFDI\MetodosDePago             metodosDePago();
 * @method CFDI\Monedas                   monedas();
 * @method CFDI\NumerosPedimentoAduana    numerosPedimentoAduana();
 * @method CFDI\Paises                    paises();
 * @method CFDI\PatentesAduanales         patentesAduanales();
 * @method CFDI\ProductosServicios        productosServicios();
 * @method CFDI\RegimenesFiscales         regimenesFiscales();
 * @method CFDI\ReglasTasaCuota           reglasTasaCuota();
 * @method CFDI\TiposComprobantes         tiposComprobantes();
 * @method CFDI\TiposFactores             tiposFactores();
 * @method CFDI\TiposRelaciones           tiposRelaciones();
 * @method CFDI\UsosCfdi                  usosCfdi();
 *
 * @method CFDI40\Aduanas                 aduanas40();
 * @method CFDI40\ClavesUnidades          clavesUnidades40();
 * @method CFDI40\CodigosPostales         codigosPostales40();
 * @method CFDI40\Colonias                colonias40();
 * @method CFDI40\Estados                 estados40();
 * @method CFDI40\Exportaciones           exportaciones40();
 * @method CFDI40\FormasDePago            formasDePago40();
 * @method CFDI40\Impuestos               impuestos40();
 * @method CFDI40\Localidades             localidades40();
 * @method CFDI40\Meses                   meses40();
 * @method CFDI40\MetodosDePago           metodosDePago40();
 * @method CFDI40\Monedas                 monedas40();
 * @method CFDI40\Municipios              municipios40();
 * @method CFDI40\NumerosPedimentoAduana  numerosPedimentoAduana40();
 * @method CFDI40\ObjetosImpuestos        objetosImpuestos40();
 * @method CFDI40\Paises                  paises40();
 * @method CFDI40\PatentesAduanales       patentesAduanales40();
 * @method CFDI40\Periodicidades          periodicidades40();
 * @method CFDI40\ProductosServicios      productosServicios40();
 * @method CFDI40\RegimenesFiscales       regimenesFiscales40();
 * @method CFDI40\ReglasTasaCuota         reglasTasaCuota40();
 * @method CFDI40\TiposComprobantes       tiposComprobantes40();
 * @method CFDI40\TiposFactores           tiposFactores40();
 * @method CFDI40\TiposRelaciones         tiposRelaciones40();
 * @method CFDI40\UsosCfdi                usosCfdi40();
 *
 * @method Nomina\Bancos                  bancos();
 * @method Nomina\Estados                 estados();
 * @method Nomina\OrigenesRecursos        origenesRecursos();
 * @method Nomina\PeriodicidadesPagos     periodicidadesPagos();
 * @method Nomina\RiesgosPuestos          riesgosPuestos();
 * @method Nomina\TiposContratos          contratos();
 * @method Nomina\TiposDeducciones        deducciones();
 * @method Nomina\TiposHoras              horasExtras();
 * @method Nomina\TiposIncapacidades      incapacidades();
 * @method Nomina\TiposJornadas           jornadas();
 * @method Nomina\TiposNominas            nominas();
 * @method Nomina\TiposOtrosPagos         otrosTipoPago();
 * @method Nomina\TiposPercepciones       percepciones();
 * @method Nomina\TiposRegimenes          regimenesContratacion();
 */
class SatCatalogos
{
    /** @var array<string, class-string|BaseCatalog> */
    private $map = [
        // CFDI
        'aduanas' => CFDI\Aduanas::class,
        'clavesUnidades' => CFDI\ClavesUnidades::class,
        'codigosPostales' => CFDI\CodigosPostales::class,
        'formasDePago' => CFDI\FormasDePago::class,
        'impuestos' => CFDI\Impuestos::class,
        'metodosDePago' => CFDI\MetodosDePago::class,
        'monedas' => CFDI\Monedas::class,
        'numerosPedimentoAduana' => CFDI\NumerosPedimentoAduana::class,
        'paises' => CFDI\Paises::class,
        'patentesAduanales' => CFDI\PatentesAduanales::class,
        'productosServicios' => CFDI\ProductosServicios::class,
        'regimenesFiscales' => CFDI\RegimenesFiscales::class,
        'reglasTasaCuota' => CFDI\ReglasTasaCuota::class,
        'tiposComprobantes' => CFDI\TiposComprobantes::class,
        'tiposFactores' => CFDI\TiposFactores::class,
        'tiposRelaciones' => CFDI\TiposRelaciones::class,
        'usosCfdi' => CFDI\UsosCfdi::class,
        // CFDI40
        'aduanas40' => CFDI40\Aduanas::class,
        'clavesUnidades40' => CFDI40\ClavesUnidades::class,
        'codigosPostales40' => CFDI40\CodigosPostales::class,
        'colonias40' => CFDI40\Colonias::class,
        'estados40' => CFDI40\Estados::class,
        'exportaciones40' => CFDI40\Exportaciones::class,
        'formasDePago40' => CFDI40\FormasDePago::class,
        'impuestos40' => CFDI40\Impuestos::class,
        'localidades40' => CFDI40\Localidades::class,
        'meses40' => CFDI40\Meses::class,
        'metodosDePago40' => CFDI40\MetodosDePago::class,
        'monedas40' => CFDI40\Monedas::class,
        'municipios40' => CFDI40\Municipios::class,
        'numerosPedimentoAduana40' => CFDI40\NumerosPedimentoAduana::class,
        'objetosImpuestos40' => CFDI40\ObjetosImpuestos::class,
        'paises40' => CFDI40\Paises::class,
        'patentesAduanales40' => CFDI40\PatentesAduanales::class,
        'periodicidades40' => CFDI40\Periodicidades::class,
        'productosServicios40' => CFDI40\ProductosServicios::class,
        'regimenesFiscales40' => CFDI40\RegimenesFiscales::class,
        'reglasTasaCuota40' => CFDI40\ReglasTasaCuota::class,
        'tiposComprobantes40' => CFDI40\TiposComprobantes::class,
        'tiposFactores40' => CFDI40\TiposFactores::class,
        'tiposRelaciones40' => CFDI40\TiposRelaciones::class,
        'usosCfdi40' => CFDI40\UsosCfdi::class,
        // Nominas
        'bancos' => Nomina\Bancos::class,
        'contratos' => Nomina\TiposContratos::class,
        'deducciones' => Nomina\TiposDeducciones::class,
        'estados' => Nomina\Estados::class,
        'horasExtras' => Nomina\TiposHoras::class,
        'incapacidades' => Nomina\TiposIncapacidades::class,
        'jornadas' => Nomina\TiposJornadas::class,
        'nominas' => Nomina\TiposNominas::class,
        'origenesRecursos' => Nomina\OrigenesRecursos::class,
        'otrosTipoPago' => Nomina\TiposOtrosPagos::class,
        'percepciones' => Nomina\TiposPercepciones::class,
        'periodicidadesPagos' => Nomina\PeriodicidadesPagos::class,
        'regimenesContratacion' => Nomina\TiposRegimenes::class,
        'riesgosPuestos' => Nomina\RiesgosPuestos::class,
    ];

    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Magic method to return a catalog using the method name
     *
     * @param string $methodName
     * @param mixed[] $arguments
     * @return mixed
     * @throws SatCatalogosLogicException if cannot find a matching catalog with the method name
     */
    public function __call(string $methodName, array $arguments)
    {
        if (! isset($this->map[$methodName])) {
            throw new SatCatalogosLogicException("No se pudo encontrar el catálogo '$methodName'");
        }

        if (is_object($this->map[$methodName])) {
            return $this->map[$methodName];
        }

        try {
            $created = $this->create($this->map[$methodName]);
        } catch (LogicException $exception) {
            throw new SatCatalogosLogicException("No se pudo encontrar el catálogo '$methodName'", 0, $exception);
        }

        $this->map[$methodName] = $created;
        return $created;
    }

    /**
     * @param class-string $className
     * @return BaseCatalog
     */
    private function create(string $className): BaseCatalog
    {
        if (! class_exists($className)) {
            throw new LogicException("$className does not exists");
        }
        if (! in_array(BaseCatalog::class, class_implements($className) ?: [], true)) {
            throw new LogicException(sprintf('%s does not implements %s', $className, BaseCatalog::class));
        }
        /** @var BaseCatalog $object */
        $object = new $className();
        $object->withRepository($this->repository);

        return $object;
    }
}
