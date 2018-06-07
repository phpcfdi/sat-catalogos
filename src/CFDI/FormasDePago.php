<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\AbstractCatalog;
use PhpCfdi\SatCatalogos\EntryInterface;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de FormasDePago
 * @method FormaDePago obtain(string $id)
 */
class FormasDePago extends AbstractCatalog
{
    protected function catalogName(): string
    {
        return Repository::CFDI_FORMAS_PAGO;
    }

    /**
     * @param array $data
     * @return FormaDePago
     */
    public function create(array $data): EntryInterface
    {
        return new FormaDePago(
            $data['id'],
            $data['texto'],
            (bool) $data['es_bancarizado'],
            (bool) $data['requiere_numero_operacion'],
            (bool) $data['permite_banco_ordenante_rfc'],
            (bool) $data['permite_cuenta_ordenante'],
            (string) $data['patron_cuenta_ordenante'],
            (bool) $data['permite_banco_beneficiario_rfc'],
            (bool) $data['permite_cuenta_beneficiario'],
            (string) $data['patron_cuenta_beneficiario'],
            (bool) $data['permite_tipo_cadena_pago'],
            (bool) $data['requiere_banco_ordenante_nombre_ext'],
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
        );
    }
}
