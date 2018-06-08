<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

// use PDO;
use PhpCfdi\SatCatalogos\CFDI\Aduanas;
use PhpCfdi\SatCatalogos\CFDI\ClavesUnidades;
use PhpCfdi\SatCatalogos\CFDI\CodigosPostales;
use PhpCfdi\SatCatalogos\CFDI\FormasDePago;
use PhpCfdi\SatCatalogos\CFDI\Impuestos;
use PhpCfdi\SatCatalogos\CFDI\MetodosDePago;
use PhpCfdi\SatCatalogos\CFDI\Monedas;
use PhpCfdi\SatCatalogos\CFDI\Paises;
use PhpCfdi\SatCatalogos\CFDI\ProductosServicios;

class SatCatalogos
{
    /** @var Repository */
    private $repository;

    /** @var Aduanas */
    private $aduanas;

    /** @var ClavesUnidades */
    private $clavesUnidades;

    /** @var ProductosServicios */
    private $productosServicios;

    /** @var CodigosPostales */
    private $codigosPostales;

    /** @var Impuestos */
    private $impuestos;

    /** @var FormasDePago */
    private $formasDePago;

    /** @var MetodosDePago */
    private $metodosDePago;

    /** @var Monedas */
    private $monedas;

    /** @var Paises */
    private $paises;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->aduanas = new Aduanas($this->repository);
        $this->clavesUnidades = new ClavesUnidades($this->repository);
        $this->productosServicios = new ProductosServicios($this->repository);
        $this->codigosPostales = new CodigosPostales($this->repository);
        $this->impuestos = new Impuestos($this->repository);
        $this->formasDePago = new FormasDePago($this->repository);
        $this->metodosDePago = new MetodosDePago($this->repository);
        $this->monedas = new Monedas($this->repository);
        $this->paises = new Paises($this->repository);
    }

    /*
    public function __construct(Repository $repository = null)
    {
        $this->repository = $repository ?: $this->createDefaultRepository();
        // ... $this->{catalogo} = new {Catalogo}($this->repository);
    }

    protected function createDefaultRepository()
    {
        return new Repository(
            new PDO('slite:' . dirname(__DIR__) . '/lib/SatCatalogos.db', '', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ])
        );
    }
    */

    public function aduanas(): Aduanas
    {
        return $this->aduanas;
    }

    public function clavesUnidades(): ClavesUnidades
    {
        return $this->clavesUnidades;
    }

    public function productosServicios(): ProductosServicios
    {
        return $this->productosServicios;
    }

    public function codigosPostales(): CodigosPostales
    {
        return $this->codigosPostales;
    }

    public function impuestos(): Impuestos
    {
        return $this->impuestos;
    }

    public function formasDePago(): FormasDePago
    {
        return $this->formasDePago;
    }

    public function metodosDePago(): MetodosDePago
    {
        return $this->metodosDePago;
    }

    public function monedas(): Monedas
    {
        return $this->monedas;
    }

    public function paises(): Paises
    {
        return $this->paises;
    }
}
