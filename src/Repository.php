<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

use LogicException;
use PDO;
use PDOException;
use PDOStatement;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;

class Repository
{
    /** @var PDO */
    private $pdo;

    /** @var array<string, PDOStatement> */
    private $statements = [];

    public const CFDI_ADUANAS = 'cfdi_aduanas';

    public const CFDI_CLAVES_UNIDADES = 'cfdi_claves_unidades';

    public const CFDI_CODIGOS_POSTALES = 'cfdi_codigos_postales';

    public const CFDI_FORMAS_PAGO = 'cfdi_formas_pago';

    public const CFDI_IMPUESTOS = 'cfdi_impuestos';

    public const CFDI_METODOS_PAGO = 'cfdi_metodos_pago';

    public const CFDI_MONEDAS = 'cfdi_monedas';

    public const CFDI_NUMEROS_PEDIMENTO_ADUANA = 'cfdi_numeros_pedimento_aduana';

    public const CFDI_PAISES = 'cfdi_paises';

    public const CFDI_PATENTES_ADUANALES = 'cfdi_patentes_aduanales';

    public const CFDI_PRODUCTOS_SERVICIOS = 'cfdi_productos_servicios';

    public const CFDI_REGIMENES_FISCALES = 'cfdi_regimenes_fiscales';

    public const CFDI_REGLAS_TASA_CUOTA = 'cfdi_reglas_tasa_cuota';

    public const CFDI_TIPOS_COMPROBANTES = 'cfdi_tipos_comprobantes';

    public const CFDI_TIPOS_FACTORES = 'cfdi_tipos_factores';

    public const CFDI_TIPOS_RELACIONES = 'cfdi_tipos_relaciones';

    public const CFDI_USOS_CFDI = 'cfdi_usos_cfdi';

    public const CFDI_40_ADUANAS = 'cfdi_40_aduanas';

    public const CFDI_40_CLAVES_UNIDADES = 'cfdi_40_claves_unidades';

    public const CFDI_40_CODIGOS_POSTALES = 'cfdi_40_codigos_postales';

    public const CFDI_40_COLONIAS = 'cfdi_40_colonias';

    public const CFDI_40_ESTADOS = 'cfdi_40_estados';

    public const CFDI_40_EXPORTACIONES = 'cfdi_40_exportaciones';

    public const CFDI_40_FORMAS_PAGO = 'cfdi_40_formas_pago';

    public const CFDI_40_IMPUESTOS = 'cfdi_40_impuestos';

    public const CFDI_40_LOCALIDADES = 'cfdi_40_localidades';

    public const CFDI_40_MESES = 'cfdi_40_meses';

    public const CFDI_40_METODOS_PAGO = 'cfdi_40_metodos_pago';

    public const CFDI_40_MONEDAS = 'cfdi_40_monedas';

    public const CFDI_40_MUNICIPIOS = 'cfdi_40_municipios';

    public const CFDI_40_NUMEROS_PEDIMENTO_ADUANA = 'cfdi_40_numeros_pedimento_aduana';

    public const CFDI_40_OBJETOS_IMPUESTOS = 'cfdi_40_objetos_impuestos';

    public const CFDI_40_PAISES = 'cfdi_40_paises';

    public const CFDI_40_PATENTES_ADUANALES = 'cfdi_40_patentes_aduanales';

    public const CFDI_40_PERIODICIDADES = 'cfdi_40_periodicidades';

    public const CFDI_40_PRODUCTOS_SERVICIOS = 'cfdi_40_productos_servicios';

    public const CFDI_40_REGIMENES_FISCALES = 'cfdi_40_regimenes_fiscales';

    public const CFDI_40_REGLAS_TASA_CUOTA = 'cfdi_40_reglas_tasa_cuota';

    public const CFDI_40_TIPOS_COMPROBANTES = 'cfdi_40_tipos_comprobantes';

    public const CFDI_40_TIPOS_FACTORES = 'cfdi_40_tipos_factores';

    public const CFDI_40_TIPOS_RELACIONES = 'cfdi_40_tipos_relaciones';

    public const CFDI_40_USOS_CFDI = 'cfdi_40_usos_cfdi';

    public const NOMINA_BANCOS = 'nomina_bancos';

    public const NOMINA_ESTADOS = 'nomina_estados';

    public const NOMINA_ORIGENES_RECURSOS = 'nomina_origenes_recursos';

    public const NOMINA_PERIODICIDADES_PAGOS = 'nomina_periodicidades_pagos';

    public const NOMINA_RIESGOS_PUESTOS = 'nomina_riesgos_puestos';

    public const NOMINA_TIPOS_CONTRATOS = 'nomina_tipos_contratos';

    public const NOMINA_TIPOS_DEDUCCIONES = 'nomina_tipos_deducciones';

    public const NOMINA_TIPOS_HORAS = 'nomina_tipos_horas';

    public const NOMINA_TIPOS_INCAPACIDADES = 'nomina_tipos_incapacidades';

    public const NOMINA_TIPOS_JORNADAS = 'nomina_tipos_jornadas';

    public const NOMINA_TIPOS_NOMINAS = 'nomina_tipos_nominas';

    public const NOMINA_TIPOS_OTROS_PAGOS = 'nomina_tipos_otros_pagos';

    public const NOMINA_TIPOS_PERCEPCIONES = 'nomina_tipos_percepciones';

    public const NOMINA_TIPOS_REGIMENES = 'nomina_tipos_regimenes';

    public const CATALOGS = [
        self::CFDI_ADUANAS,
        self::CFDI_CLAVES_UNIDADES,
        self::CFDI_CODIGOS_POSTALES,
        self::CFDI_FORMAS_PAGO,
        self::CFDI_IMPUESTOS,
        self::CFDI_METODOS_PAGO,
        self::CFDI_MONEDAS,
        self::CFDI_NUMEROS_PEDIMENTO_ADUANA,
        self::CFDI_PAISES,
        self::CFDI_PATENTES_ADUANALES,
        self::CFDI_PRODUCTOS_SERVICIOS,
        self::CFDI_REGIMENES_FISCALES,
        self::CFDI_REGLAS_TASA_CUOTA,
        self::CFDI_TIPOS_COMPROBANTES,
        self::CFDI_TIPOS_FACTORES,
        self::CFDI_TIPOS_RELACIONES,
        self::CFDI_USOS_CFDI,
        self::CFDI_40_ADUANAS,
        self::CFDI_40_CLAVES_UNIDADES,
        self::CFDI_40_CODIGOS_POSTALES,
        self::CFDI_40_COLONIAS,
        self::CFDI_40_ESTADOS,
        self::CFDI_40_EXPORTACIONES,
        self::CFDI_40_FORMAS_PAGO,
        self::CFDI_40_IMPUESTOS,
        self::CFDI_40_LOCALIDADES,
        self::CFDI_40_MESES,
        self::CFDI_40_METODOS_PAGO,
        self::CFDI_40_MONEDAS,
        self::CFDI_40_MUNICIPIOS,
        self::CFDI_40_NUMEROS_PEDIMENTO_ADUANA,
        self::CFDI_40_OBJETOS_IMPUESTOS,
        self::CFDI_40_PAISES,
        self::CFDI_40_PATENTES_ADUANALES,
        self::CFDI_40_PERIODICIDADES,
        self::CFDI_40_PRODUCTOS_SERVICIOS,
        self::CFDI_40_REGIMENES_FISCALES,
        self::CFDI_40_REGLAS_TASA_CUOTA,
        self::CFDI_40_TIPOS_COMPROBANTES,
        self::CFDI_40_TIPOS_FACTORES,
        self::CFDI_40_TIPOS_RELACIONES,
        self::CFDI_40_USOS_CFDI,
        self::NOMINA_BANCOS,
        self::NOMINA_ESTADOS,
        self::NOMINA_ORIGENES_RECURSOS,
        self::NOMINA_PERIODICIDADES_PAGOS,
        self::NOMINA_RIESGOS_PUESTOS,
        self::NOMINA_TIPOS_CONTRATOS,
        self::NOMINA_TIPOS_DEDUCCIONES,
        self::NOMINA_TIPOS_HORAS,
        self::NOMINA_TIPOS_INCAPACIDADES,
        self::NOMINA_TIPOS_JORNADAS,
        self::NOMINA_TIPOS_NOMINAS,
        self::NOMINA_TIPOS_OTROS_PAGOS,
        self::NOMINA_TIPOS_PERCEPCIONES,
        self::NOMINA_TIPOS_REGIMENES,
    ];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param string $catalog
     * @param string $id
     * @return array<string, scalar>
     */
    public function queryById(string $catalog, string $id): array
    {
        $sql = 'select *'
            . ' from ' . $this->catalogName($catalog)
            . ' where (id = :id);';
        $data = $this->queryRow($sql, ['id' => $id]);
        if (! count($data)) {
            throw $this->createSatCatalogosNotFoundException($catalog, ['id' => $id]);
        }

        return $data;
    }

    /**
     * @param string $catalog
     * @param string[] $ids
     * @return array<array<string, scalar>>
     */
    public function queryByIds(string $catalog, array $ids): array
    {
        return $this->queryRowsInField($catalog, 'id', $ids);
    }

    /**
     * @param string $catalog
     * @param string $fieldName
     * @param scalar[] $values
     * @return array<int, array<string, scalar>>
     */
    public function queryRowsInField(string $catalog, string $fieldName, array $values): array
    {
        $values = array_values($values);
        $questionMarks = implode(',', array_fill(0, count($values), '?'));
        $sql = 'select *'
            . ' from ' . $this->catalogName($catalog)
            . ' where ' . $this->escapeName($fieldName) . ' IN (' . $questionMarks . ')'
            . ';';
        $stmt = $this->query($sql, $values);
        /** @var array<int, array<string, scalar>>|false $data phpstan does not know that fetchAll can return FALSE */
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return (is_array($data)) ? $data : [];
    }

    /**
     * @param string $catalog
     * @param array<string, scalar> $values
     * @param int $limit
     * @param bool $exactSearch
     * @return array<int, array<string, scalar>>
     */
    public function queryRowsByFields(string $catalog, array $values, int $limit = 0, bool $exactSearch = true): array
    {
        $keys = array_keys($values);
        $operator = ($exactSearch) ? '=' : 'like';
        $sql = 'select *'
            . ' from ' . $this->catalogName($catalog)
            . call_user_func(function (array $keys, string $operator): string {
                if (count($keys)) {
                    return ' where ' . implode(' and ', array_map(function ($field) use ($operator) {
                        return '(' . $this->escapeName($field) . ' ' . $operator . ' :' . $field . ')';
                    }, $keys));
                }
                return '';
            }, $keys, $operator)
            . (($limit > 0) ? ' limit ' . $limit : '')
            . ';';
        $stmt = $this->query($sql, $values);
        /** @var array<int, array<string, scalar>>|false $data phpstan does not know that fetchAll can return FALSE */
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return (is_array($data)) ? $data : [];
    }

    /**
     * @param string $catalog
     * @param array<string, scalar> $values
     * @return array<string, scalar>
     */
    public function queryRowByFields(string $catalog, array $values): array
    {
        $data = $this->queryRowsByFields($catalog, $values, 1);
        if (1 !== count($data)) {
            throw $this->createSatCatalogosNotFoundException($catalog, $values);
        }

        return $data[0];
    }

    /**
     * @param string $catalog
     * @param array<string, scalar> $values
     * @return SatCatalogosNotFoundException
     */
    private function createSatCatalogosNotFoundException(string $catalog, array $values): SatCatalogosNotFoundException
    {
        $valuesCount = count($values);
        $keys = array_keys($values);
        if ($valuesCount > 1) {
            $exMessage = sprintf(
                'Cannot found %s using (%s) with values (%s)',
                $catalog,
                implode(', ', $keys),
                implode(', ', $values),
            );
        } elseif (1 === $valuesCount) {
            $exMessage = sprintf("Cannot found %s using %s '%s'", $catalog, $keys[0], $values[$keys[0]]);
        } else {
            $exMessage = sprintf('Cannot found any %s without filter', $catalog);
        }

        return new SatCatalogosNotFoundException($exMessage);
    }

    public function existsId(string $catalog, string $id): bool
    {
        $sql = 'select count(*) '
            . ' from ' . $this->catalogName($catalog)
            . ' where (id = :id);';
        $value = $this->queryValue($sql, ['id' => $id], 0);
        return (1 === (int) $value);
    }

    public function escapeName(string $name): string
    {
        return '"' . str_replace('"', '""', $name) . '"';
    }

    public function catalogName(string $catalog): string
    {
        if (! in_array($catalog, self::CATALOGS, true)) {
            throw new SatCatalogosLogicException("The catalog name $catalog is not recognized by the repository");
        }

        return $this->escapeName($catalog);
    }

    /**
     * Execute a sql statement, it will use the preparedStatements cache, set the arguments and throw an exception
     * with the corresponding message (if working on silent mode)
     * @param string $query
     * @param scalar[] $arguments
     * @return PDOStatement
     */
    private function query(string $query, array $arguments = []): PDOStatement
    {
        $statement = $this->statement($query);
        $statement->execute($arguments);
        return $statement;
    }

    /**
     * Get one and only one value after executing a query.
     * NOTICE: Do not use this function for boolean values
     *
     * @param string $query
     * @param scalar[] $arguments
     * @param scalar|null $defaultValue
     * @return scalar|null
     */
    private function queryValue(string $query, array $arguments = [], $defaultValue = null)
    {
        $stmt = $this->query($query, $arguments);
        /** @var scalar|null $value phpstan does not know that fetchAll can return FALSE */
        $value = $stmt->fetchColumn(0);
        if (null === $value) {
            return $defaultValue;
        }
        return $value;
    }

    /**
     * @param string $query
     * @param scalar[] $arguments
     * @return array<string, scalar>
     */
    private function queryRow(string $query, array $arguments = []): array
    {
        $stmt = $this->query($query, $arguments);
        $values = $stmt->fetch(PDO::FETCH_ASSOC);

        return (is_array($values)) ? $values : [];
    }

    /**
     * Cache or create a prepared statement
     *
     * @param string $query
     * @return PDOStatement
     */
    private function statement(string $query): PDOStatement
    {
        $statement = $this->statements[$query] ?? null;
        if ($statement instanceof PDOStatement) {
            return $statement;
        }

        try {
            /**
             * @noinspection PhpUsageOfSilenceOperatorInspection
             * @var PDOStatement|false $statement phpstan does not know that prepare can return FALSE
             */
            $statement = @$this->pdo->prepare($query);
        } catch (PDOException $exception) {
            throw new LogicException("Cannot prepare the statement: $query", 0, $exception);
        }
        if (false === $statement) {
            throw new LogicException("Cannot prepare the statement: $query");
        }
        $this->statements[$query] = $statement;

        return $statement;
    }
}
