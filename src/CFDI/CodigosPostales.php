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
        return new CodigoPostal(
            $data['id'],
            $data['estado'],
            $data['municipio'],
            $data['localidad'],
            boolval($data['estimulo_frontera']),
            new HusoHorario(
                $data['huso_descripcion'],
                new HusoHorarioEstacion(
                    $data['huso_verano_mes_inicio'],
                    $data['huso_verano_dia_inicio'],
                    $data['huso_verano_hora_inicio'],
                    intval($data['huso_verano_diferencia'])
                ),
                new HusoHorarioEstacion(
                    $data['huso_invierno_mes_inicio'],
                    $data['huso_invierno_dia_inicio'],
                    $data['huso_invierno_hora_inicio'],
                    intval($data['huso_invierno_diferencia'])
                )
            ),
            ($data['vigencia_desde']) ? strtotime($data['vigencia_desde']) : 0,
            ($data['vigencia_hasta']) ? strtotime($data['vigencia_hasta']) : 0
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
