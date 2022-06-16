<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI\Builders;

use PhpCfdi\SatCatalogos\CFDI\FormaDePago;

class FormaDePagoBuilder
{
    /**
     * @param string $id
     * @param array<string, mixed> $values
     * @return FormaDePago
     */
    public function make(string $id, array $values): FormaDePago
    {
        unset($values['id']);
        // the order of the arguments **must** be the same as in FormaDePago constructor
        $defaults = [
            'id' => $id,
            'texto' => $id,
            'esBancarizado' => false,
            'requiereNumeroDeOperacion' => false,
            'permiteBancoOrdenanteRfc' => false,
            'permiteCuentaOrdenante' => false,
            'patronCuentaOrdenante' => '',
            'permiteBancoBeneficiarioRfc' => false,
            'permiteCuentaBeneficiario' => false,
            'patronCuentaBeneficiario' => '',
            'permiteTipoCadenaPago' => false,
            'requiereBancoOrdenanteNombreExt' => false,
            'vigenteDesde' => 0,
            'vigenteHasta' => 0,
        ];

        $values = array_values(array_intersect_key(array_merge($defaults, $values), $defaults));

        return new FormaDePago(...$values); /** @phpstan-ignore-line */
    }
}
