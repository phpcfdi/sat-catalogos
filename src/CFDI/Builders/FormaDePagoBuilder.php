<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI\Builders;

use PhpCfdi\SatCatalogos\CFDI\FormaDePago;

class FormaDePagoBuilder
{
    public function make(string $id, array $values): FormaDePago
    {
        unset($values['id']);
        $defaults = [
            'id' => $id,
            'texto' => $id,
            'esBancarizado' => false,
            'requiereNumeroDeOperacion' => false,
            'vigenteDesde' => 0,
            'vigenteHasta' => 0,
        ];

        $values = array_intersect_key(array_merge($defaults, $values), $defaults);

        return new FormaDePago(...array_values($values));
    }
}
