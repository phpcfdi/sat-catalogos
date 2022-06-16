<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\BaseCatalog;
use PhpCfdi\SatCatalogos\Common\BaseCatalogTrait;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

class ReglasTasaCuota implements BaseCatalog
{
    use BaseCatalogTrait;

    public const FACTOR_TASA = 'Tasa';

    public const FACTOR_CUOTA = 'Cuota';

    public const IMPUESTO_IEPS = 'IEPS';

    public const IMPUESTO_IVA = 'IVA';

    public const IMPUESTO_ISR = 'ISR';

    public const USO_TRASLADO = 'traslado';

    public const USO_RETENCION = 'retencion';

    /**
     * @param string $impuesto
     * @param string $factor
     * @param string $uso
     * @return ReglaTasaCuota[]
     */
    public function obtainRules(string $impuesto, string $factor, string $uso): array
    {
        if (self::USO_TRASLADO !== $uso && self::USO_RETENCION !== $uso) {
            throw new SatCatalogosLogicException('El campo uso no tiene uno de los valores permitidos');
        }

        $filters = [
            'impuesto' => $impuesto,
            'factor' => $factor,
            $uso => true,
        ];

        return array_map(
            function (array $data): ReglaTasaCuota {
                return $this->createRule($data);
            },
            $this->repository()->queryRowsByFields(Repository::CFDI_REGLAS_TASA_CUOTA, $filters),
        );
    }

    public function findMatchingRule(string $impuesto, string $factor, string $uso, string $valor): ?ReglaTasaCuota
    {
        $rules = $this->obtainRules($impuesto, $factor, $uso);

        foreach ($rules as $rule) {
            if ($rule->valorIsValid($valor)) {
                return $rule;
            }
        }

        return null;
    }

    public function hasMatchingRule(string $impuesto, string $factor, string $uso, string $valor): bool
    {
        return (null !== $this->findMatchingRule($impuesto, $factor, $uso, $valor));
    }

    /**
     * Create a ReglaTasaCuota based on the array values
     *
     * @param array<string, scalar> $data
     * @return ReglaTasaCuota
     */
    public function createRule(array $data): ReglaTasaCuota
    {
        $values = new ScalarValues($data);
        return new ReglaTasaCuota(
            $values->string('tipo'),
            $values->string('impuesto'),
            $values->string('factor'),
            $values->bool('traslado'),
            $values->bool('retencion'),
            $values->string('minimo'),
            $values->string('valor'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
