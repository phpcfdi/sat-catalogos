<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractEntry;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class FormaDePago extends AbstractEntry implements EntryInterface
{
    /** @var bool */
    private $esBancarizado;

    /** @var bool */
    private $requiereNumeroDeOperacion;

    /** @var bool */
    private $permiteBancoOrdenanteRfc;

    /** @var bool */
    private $permiteCuentaOrdenante;

    /** @var string */
    private $patronCuentaOrdenante;

    /** @var bool */
    private $permiteBancoBeneficiarioRfc;

    /** @var bool */
    private $permiteCuentaBeneficiario;

    /** @var string */
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
        $this->patronCuentaOrdenante = $this->resolveRegularExpression($patronCuentaOrdenante);
        $this->permiteBancoBeneficiarioRfc = $permiteBancoBeneficiarioRfc;
        $this->permiteCuentaBeneficiario = $permiteCuentaBeneficiario;
        $this->patronCuentaBeneficiario = $this->resolveRegularExpression($patronCuentaBeneficiario);
        $this->permiteTipoCadenaPago = $permiteTipoCadenaPago;
        $this->requiereBancoOrdenanteNombreExt = $requiereBancoOrdenanteNombreExt;
    }

    private function resolveRegularExpression(string $partial): string
    {
        $pattern = '/^' . $partial . '$/';
        if (false === @preg_match($pattern, '')) {
            throw new SatCatalogosLogicException("La expresión regular '$pattern' no es válida");
        }
        return $pattern;
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

    public function patronCuentaOrdenante(): string
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

    public function patronCuentaBeneficiario(): string
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
