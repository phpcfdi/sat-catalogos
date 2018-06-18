<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

/**
 * Class SatCatalogos
 *
 * @method Repository                   repository();
 * @method CFDI\Aduanas                 aduanas();
 * @method CFDI\ClavesUnidades          clavesUnidades();
 * @method CFDI\CodigosPostales         codigosPostales();
 * @method CFDI\FormasDePago            formasDePago();
 * @method CFDI\Impuestos               impuestos();
 * @method CFDI\MetodosDePago           metodosDePago();
 * @method CFDI\Monedas                 monedas();
 * @method CFDI\Paises                  paises();
 * @method CFDI\ProductosServicios      productosServicios();
 * @method CFDI\RegimenesFiscales       regimenesFiscales();
 * @method CFDI\TiposRelaciones         tiposRelaciones();
 * @method CFDI\UsosCfdi                usosCfdi();
 * @method CFDI\TiposFactores           tiposFactores();
 * @method CFDI\NumerosPedimentoAduana  numerosPedimentoAduana();
 * @method CFDI\ReglasTasaCuota         reglasTasaCuota();
 * @method CFDI\PatentesAduanales       patentesAduanales();
 * @method CFDI\TiposComprobantes       tiposComprobantes();
*/
class SatCatalogos
{
    /** @var array */
    protected $container;

    public function __construct(Repository $repository)
    {
        $this->container = [];
        $this->container['repository'] = $repository;
    }

    public function __call($name, $arguments)
    {
        if (isset($this->container[$name])) {
            return $this->container[$name];
        }

        if (null !== $created = $this->create($name)) {
            $this->container[$name] = $created;
            return $created;
        }

        throw new SatCatalogosLogicException("No se pudo encontrar el catálogo '$name'");
    }

    /**
     * @param string $propertyName
     * @return WithRepositoryInterface|null
     */
    protected function create(string $propertyName)
    {
        foreach (['CFDI'] as $space) {
            $className = '\\' . __NAMESPACE__ . '\\' . $space . '\\' . ucfirst($propertyName);
            if (! class_exists($className)) {
                continue;
            }
            if (! in_array(WithRepositoryInterface::class, class_implements($className), true)) {
                continue;
            }
            /** @var WithRepositoryInterface $object */
            $object = new $className();
            $object->withRepository($this->container['repository']);
            return $object;
        }

        return null;
    }
}
