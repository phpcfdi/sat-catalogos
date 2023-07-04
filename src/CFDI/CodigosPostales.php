<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Common\AbstractCatalogIdentifiable;
use PhpCfdi\SatCatalogos\Common\EntryIdentifiable;
use PhpCfdi\SatCatalogos\Helpers\ScalarValues;
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
     * @param array<string, scalar> $data
     * @return CodigoPostal
     */
    public function create(array $data): EntryIdentifiable
    {
        $values = new ScalarValues($data);
        return new CodigoPostal(
            $values->string('id'),
            $values->string('estado'),
            $values->string('municipio'),
            $values->string('localidad'),
            $values->int('estimulo_frontera'),
            new HusoHorario(
                $values->string('huso_descripcion'),
                new HusoHorarioEstacion(
                    $values->string('huso_verano_mes_inicio'),
                    $values->string('huso_verano_dia_inicio'),
                    $values->string('huso_verano_hora_inicio'),
                    $values->int('huso_verano_diferencia'),
                ),
                new HusoHorarioEstacion(
                    $values->string('huso_invierno_mes_inicio'),
                    $values->string('huso_invierno_dia_inicio'),
                    $values->string('huso_invierno_hora_inicio'),
                    $values->int('huso_invierno_diferencia'),
                ),
            ),
            $values->timestamp('vigencia_desde'),
            $values->timestamp('vigencia_hasta'),
        );
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
            return $this->create([
                'id' => '00000',
                'estado' => '*',
                'municipio' => '000',
                'localidad' => '00',
                'estimulo_frontera' => false,
                'huso_descripcion' => '',
                'huso_verano_mes_inicio' => '',
                'huso_verano_dia_inicio' => '',
                'huso_verano_hora_inicio' => '',
                'huso_verano_diferencia' => '-6',
                'huso_invierno_mes_inicio' => '',
                'huso_invierno_dia_inicio' => '',
                'huso_invierno_hora_inicio' => '',
                'huso_invierno_diferencia' => '-6',
                'vigencia_desde' => '0',
                'vigencia_hasta' => '2019-10-14',
            ]);
        }

        // have to do this to avoid phpstan compain, issue: https://github.com/phpstan/phpstan/issues/1065
        /** @var CodigoPostal $codigoPostal */
        $codigoPostal = parent::obtain($id);
        return $codigoPostal;
    }
}
