<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI40;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de FormasDePago
 * @method FormaDePago obtain(string $id)
 */
class FormasDePago extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_40_FORMAS_PAGO;
    }

    /**
     * @param array<string, scalar> $data
     * @return FormaDePago
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new FormaDePago(
            $values->string('id'),
            $values->string('texto'),
            $values->bool('es_bancarizado'),
            $values->bool('requiere_numero_operacion'),
            $values->bool('permite_banco_ordenante_rfc'),
            $values->bool('permite_cuenta_ordenante'),
            $values->string('patron_cuenta_ordenante'),
            $values->bool('permite_banco_beneficiario_rfc'),
            $values->bool('permite_cuenta_beneficiario'),
            $values->string('patron_cuenta_beneficiario'),
            $values->bool('permite_tipo_cadena_pago'),
            $values->bool('requiere_banco_ordenante_nombre_ext'),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
    }
}
