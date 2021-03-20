<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

use LogicException;
use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

/**
 * Class SatCatalogos
 *
 * @method CFDI\Aduanas                 aduanas();
 * @method CFDI\ClavesUnidades          clavesUnidades();
 * @method CFDI\CodigosPostales         codigosPostales();
 * @method CFDI\FormasDePago            formasDePago();
 * @method CFDI\Impuestos               impuestos();
 * @method CFDI\MetodosDePago           metodosDePago();
 * @method CFDI\Monedas                 monedas();
 * @method CFDI\NumerosPedimentoAduana  numerosPedimentoAduana();
 * @method CFDI\Paises                  paises();
 * @method CFDI\PatentesAduanales       patentesAduanales();
 * @method CFDI\ProductosServicios      productosServicios();
 * @method CFDI\RegimenesFiscales       regimenesFiscales();
 * @method CFDI\ReglasTasaCuota         reglasTasaCuota();
 * @method CFDI\TiposComprobantes       tiposComprobantes();
 * @method CFDI\TiposFactores           tiposFactores();
 * @method CFDI\TiposRelaciones         tiposRelaciones();
 * @method CFDI\UsosCfdi                usosCfdi();
 *
 * @method Nomina\TiposContratos        tiposContratos();
 * @method Nomina\TiposNominas          tiposNominas();
 * @method Nomina\TiposJornadas         tiposJornadas();
 * @method Nomina\OrigenesRecursos      origenesRecursos();
 * @method Nomina\Bancos                bancos();
 * @method Nomina\Estados               estados();
 * @method Nomina\PeriodicidadesPagos   periodicidadesPagos();
 * @method Nomina\RiesgosPuestos        riesgosPuestos();
 * @method Nomina\TiposDeducciones      tiposDeducciones();
 * @method Nomina\TiposHoras            tiposHoras();
 * @method Nomina\TiposIncapacidades    tiposIncapacidades();
 * @method Nomina\TiposOtrosPagos       tiposOtrosPagos();
 * @method Nomina\TiposPercepciones     tiposPercepciones();
 * @method Nomina\TiposRegimenes        tiposRegimenes();
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
        // Nominas
        'tiposContratos' => Nomina\TiposContratos::class,
        'tiposNominas' => Nomina\TiposNominas::class,
        'tiposJornadas' => Nomina\TiposJornadas::class,
        'origenesRecursos' => Nomina\OrigenesRecursos::class,
        'bancos' => Nomina\Bancos::class,
        'estados' => Nomina\Estados::class,
        'periodicidadesPagos' => Nomina\PeriodicidadesPagos::class,
        'riesgosPuestos' => Nomina\RiesgosPuestos::class,
        'tiposDeducciones' => Nomina\TiposDeducciones::class,
        'tiposHoras' => Nomina\TiposHoras::class,
        'tiposIncapacidades' => Nomina\TiposIncapacidades::class,
        'tiposOtrosPagos' => Nomina\TiposOtrosPagos::class,
        'tiposPercepciones' => Nomina\TiposPercepciones::class,
        'tiposRegimenes' => Nomina\TiposRegimenes::class,
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
            /** @var mixed $created */
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
