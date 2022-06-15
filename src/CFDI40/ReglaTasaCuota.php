<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use LogicException;
use PhpCfdi\SatCatalogos\Common\EntryWithVigencias;
use PhpCfdi\SatCatalogos\Common\EntryWithVigenciasTrait;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class ReglaTasaCuota implements EntryWithVigencias
{
    use EntryWithVigenciasTrait;

    public const TIPO_FIJO = 'Fijo';

    public const TIPO_RANGO = 'Rango';

    /** @var string */
    private $tipo;

    /** @var string */
    private $impuesto;

    /** @var string */
    private $factor;

    /** @var bool */
    private $traslado;

    /** @var bool */
    private $retencion;

    /** @var string */
    private $minimo;

    /** @var string */
    private $valor;

    /**
     * ReglaTasaCuota constructor.
     * @param string $tipo
     * @param string $impuesto
     * @param string $factor
     * @param bool $traslado
     * @param bool $retencion
     * @param string $minimo
     * @param string $valor Valor fijo o bien el máximo del rango
     * @param int $vigenteDesde
     * @param int $vigenteHasta
     */
    public function __construct(
        string $tipo,
        string $impuesto,
        string $factor,
        bool $traslado,
        bool $retencion,
        string $minimo,
        string $valor,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        if (self::TIPO_FIJO !== $tipo && self::TIPO_RANGO !== $tipo) {
            throw new SatCatalogosLogicException('El campo tipo no tiene uno de los valores permitidos');
        }
        if (
            ReglasTasaCuota::IMPUESTO_IEPS !== $impuesto
            && ReglasTasaCuota::IMPUESTO_IVA !== $impuesto
            && ReglasTasaCuota::IMPUESTO_ISR !== $impuesto
        ) {
            throw new SatCatalogosLogicException('El campo impuesto no tiene uno de los valores permitidos');
        }
        if (ReglasTasaCuota::FACTOR_CUOTA !== $factor && ReglasTasaCuota::FACTOR_TASA !== $factor) {
            throw new SatCatalogosLogicException('El campo factor no tiene uno de los valores permitidos');
        }
        if (! $traslado && ! $retencion) {
            throw new SatCatalogosLogicException('Los campos retención y traslado no pueden ser falsos ambos');
        }
        $this->tipo = $tipo;
        $this->impuesto = $impuesto;
        $this->factor = $factor;
        $this->traslado = $traslado;
        $this->retencion = $retencion;
        $this->minimo = $minimo;
        $this->valor = $valor;
        $this->setUpVigencias($vigenteDesde, $vigenteHasta);
    }

    public function tipo(): string
    {
        return $this->tipo;
    }

    public function impuesto(): string
    {
        return $this->impuesto;
    }

    public function factor(): string
    {
        return $this->factor;
    }

    public function traslado(): bool
    {
        return $this->traslado;
    }

    public function retencion(): bool
    {
        return $this->retencion;
    }

    public function minimo(): string
    {
        return $this->minimo;
    }

    public function maximo(): string
    {
        return $this->valor;
    }

    public function valor(): string
    {
        return $this->valor;
    }

    public function valorIsValid(string $valor): bool
    {
        if (! (bool) preg_match('/^\d{0,2}(\.\d{0,6})?$/', $valor)) {
            return false;
        }

        if (self::TIPO_FIJO === $this->tipo) {
            return $valor === $this->valor;
        }

        if (self::TIPO_RANGO === $this->tipo) {
            $delta = 1000000;
            $current = intval($delta * floatval($valor));
            $min = intval($delta * floatval($this->minimo));
            $max = intval($delta * floatval($this->valor));
            return ($current >= $min && $current <= $max);
        }

        /** @codeCoverageIgnore This is a safeguard since the object cannot be constructed with other type */
        throw new LogicException(
            "Don't know how to compare the current rule, it is not TIPO_FIJO or TIPO_RANGO",
        );
    }
}
