<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractEntryIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\Patron;

class FormaDePago extends AbstractEntryIdentifiable implements EntryIdentifiable
{
    /** @var bool */
    private $esBancarizado;

    /** @var bool */
    private $requiereNumeroDeOperacion;

    /** @var bool */
    private $permiteBancoOrdenanteRfc;

    /** @var bool */
    private $permiteCuentaOrdenante;

    /** @var Patron */
    private $patronCuentaOrdenante;

    /** @var bool */
    private $permiteBancoBeneficiarioRfc;

    /** @var bool */
    private $permiteCuentaBeneficiario;

    /** @var Patron */
    private $patronCuentaBeneficiario;

    /** @var bool */
    private $permiteTipoCadenaPago;

    /** @var bool */
    private $requiereBancoOrdenanteNombreExt;

    public function __construct(
        string $id,
        string $texto,
        bool $esBancarizado,
        bool $requiereNumeroDeOperacion,
        bool $permiteBancoOrdenanteRfc,
        bool $permiteCuentaOrdenante,
        string $patronCuentaOrdenante,
        bool $permiteBancoBeneficiarioRfc,
        bool $permiteCuentaBeneficiario,
        string $patronCuentaBeneficiario,
        bool $permiteTipoCadenaPago,
        bool $requiereBancoOrdenanteNombreExt,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        parent::__construct($id, $texto, $vigenteDesde, $vigenteHasta);
        $this->esBancarizado = $esBancarizado;
        $this->requiereNumeroDeOperacion = $requiereNumeroDeOperacion;
        $this->permiteBancoOrdenanteRfc = $permiteBancoOrdenanteRfc;
        $this->permiteCuentaOrdenante = $permiteCuentaOrdenante;
        $this->patronCuentaOrdenante = new Patron($patronCuentaOrdenante, Patron::VACIO_PERMITE_NADA);
        $this->permiteBancoBeneficiarioRfc = $permiteBancoBeneficiarioRfc;
        $this->permiteCuentaBeneficiario = $permiteCuentaBeneficiario;
        $this->patronCuentaBeneficiario = new Patron($patronCuentaBeneficiario, Patron::VACIO_PERMITE_NADA);
        $this->permiteTipoCadenaPago = $permiteTipoCadenaPago;
        $this->requiereBancoOrdenanteNombreExt = $requiereBancoOrdenanteNombreExt;
    }

    public function esBancarizado(): bool
    {
        return $this->esBancarizado;
    }

    public function requiereNumeroDeOperacion(): bool
    {
        return $this->requiereNumeroDeOperacion;
    }

    public function permiteBancoOrdenanteRfc(): bool
    {
        return $this->permiteBancoOrdenanteRfc;
    }

    public function permiteCuentaOrdenante(): bool
    {
        return $this->permiteCuentaOrdenante;
    }

    public function patronCuentaOrdenante(): Patron
    {
        return $this->patronCuentaOrdenante;
    }

    public function permiteBancoBeneficiarioRfc(): bool
    {
        return $this->permiteBancoBeneficiarioRfc;
    }

    public function permiteCuentaBeneficiario(): bool
    {
        return $this->permiteCuentaBeneficiario;
    }

    public function patronCuentaBeneficiario(): Patron
    {
        return $this->patronCuentaBeneficiario;
    }

    public function permiteTipoCadenaPago(): bool
    {
        return $this->permiteTipoCadenaPago;
    }

    public function requiereBancoOrdenanteNombreExt(): bool
    {
        return $this->requiereBancoOrdenanteNombreExt;
    }
}
