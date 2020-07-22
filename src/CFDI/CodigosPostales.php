<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Repository;

/**
 * Catálogo de CodigosPostales
 */
class CodigosPostales extends AbstractCatalogIdentifiable
{
    protected function catalogName(): string
    {
        return Repository::CFDI_CODIGOS_POSTALES;
    }

    /**
     * @param array<string, mixed> $data
     * @return CodigoPostal
     */
    public function create(array $data): EntryIdentifiable
    {
        return new CodigoPostal($data['id'], $data['estado'], $data['municipio'], $data['localidad']);
    }

    /**
     * @param string $id
     * @return CodigoPostal
     */
    public function obtain(string $id): EntryIdentifiable
    {
        /*
         * Caso especial, el registro no existe en la tabla de códigos postales
         * Se devuelve el registro sin estado porque es válido para cualquier estado
         */
        if ('00000' === $id) {
            return $this->create(['id' => '00000', 'estado' => '*', 'municipio' => '000', 'localidad' => '00']);
        }

        // have to do this to avoid phpstan compain, issue: https://github.com/phpstan/phpstan/issues/1065
        /** @var CodigoPostal $codigoPostal */
        $codigoPostal = parent::obtain($id);
        return $codigoPostal;
    }
}
