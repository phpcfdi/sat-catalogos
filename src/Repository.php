<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos;

use PDO;
use PDOException;
use PDOStatement;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;
use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosNotFoundException;

class Repository
{
    /** @var PDO */
    private $pdo;

    /** @var PDOStatement[] */
    private $statements = [];

    public const CFDI_ADUANAS = 'cfdi_aduanas';

    public const CFDI_CLAVES_UNIDADES = 'cfdi_claves_unidades';

    public const CFDI_PRODUCTOS_SERVICIOS = 'cfdi_productos_servicios';

    public const CFDI_CODIGOS_POSTALES = 'cfdi_codigos_postales';

    public const CFDI_IMPUESTOS = 'cfdi_impuestos';

    public const CFDI_FORMAS_PAGO = 'cfdi_formas_pago';

    public const CFDI_METODOS_PAGO = 'cfdi_metodos_pago';

    public const CFDI_MONEDAS = 'cfdi_monedas';

    public const CFDI_PAISES = 'cfdi_paises';

    public const CFDI_REGIMENES_FISCALES = 'cfdi_regimenes_fiscales';

    public const CFDI_TIPOS_RELACIONES = 'cfdi_tipos_relaciones';

    public const CFDI_USOS_CFDI = 'cfdi_usos_cfdi';

    public const CFDI_TIPOS_FACTORES = 'cfdi_tipos_factores';

    public const CFDI_NUMEROS_PEDIMENTO_ADUANA = 'cfdi_numeros_pedimento_aduana';

    public const CFDI_REGLAS_TASA_CUOTA = 'cfdi_reglas_tasa_cuota';

    public const CFDI_PATENTES_ADUANALES = 'cfdi_patentes_aduanales';

    public const CFDI_TIPOS_COMPROBANTES = 'cfdi_tipos_comprobantes';

    public const CATALOGS = [
        self::CFDI_ADUANAS,
        self::CFDI_CLAVES_UNIDADES,
        self::CFDI_PRODUCTOS_SERVICIOS,
        self::CFDI_CODIGOS_POSTALES,
        self::CFDI_IMPUESTOS,
        self::CFDI_FORMAS_PAGO,
        self::CFDI_METODOS_PAGO,
        self::CFDI_MONEDAS,
        self::CFDI_PAISES,
        self::CFDI_REGIMENES_FISCALES,
        self::CFDI_TIPOS_RELACIONES,
        self::CFDI_USOS_CFDI,
        self::CFDI_TIPOS_FACTORES,
        self::CFDI_NUMEROS_PEDIMENTO_ADUANA,
        self::CFDI_REGLAS_TASA_CUOTA,
        self::CFDI_PATENTES_ADUANALES,
        self::CFDI_TIPOS_COMPROBANTES,
    ];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

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

    public function queryByIds(string $catalog, array $ids): array
    {
        return $this->queryRowsInField($catalog, 'id', $ids);
    }

    public function queryRowsInField(string $catalog, string $fieldName, array $values): array
    {
        $values = array_values($values);
        $questionMarks = implode(',', array_fill(0, count($values), '?'));
        $sql = 'select *'
            . ' from ' . $this->catalogName($catalog)
            . ' where ' . $this->escapeName($fieldName) . ' IN (' . $questionMarks . ')'
            . ';';
        $stmt = $this->query($sql, $values);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return (is_array($data)) ? $data : [];
    }

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
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return (is_array($data)) ? $data : [];
    }

    public function queryRowByFields(string $catalog, array $values): array
    {
        $data = $this->queryRowsByFields($catalog, $values, 1);
        if (1 !== count($data)) {
            throw $this->createSatCatalogosNotFoundException($catalog, $values);
        }

        return $data[0];
    }

    private function createSatCatalogosNotFoundException(string $catalog, array $values)
    {
        $valuesCount = count($values);
        $keys = array_keys($values);
        if ($valuesCount > 1) {
            $exMessage = sprintf(
                'Cannot found %s using (%s) with values (%s)',
                $catalog,
                implode(', ', $keys),
                implode(', ', $values)
            );
        } elseif (1 === $valuesCount) {
            $exMessage = sprintf('Cannot found %s using %s \'%s\'', $catalog, $keys[0], $values[$keys[0]]);
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
     * @param array $arguments
     * @return PDOStatement
     */
    private function query(string $query, array $arguments = []): PDOStatement
    {
        $statement = $this->statement($query);
        $statement->execute($arguments);
        return $statement;
    }

    private function queryValue(string $query, array $arguments = [], $defaultValue = null)
    {
        $stmt = $this->query($query, $arguments);
        $value = $stmt->fetchColumn();

        return (false !== $value) ? $value : $defaultValue;
    }

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
            /** @var PDOStatement|false $statement phpstan does not know that prepare can return FALSE */
            $statement = @$this->pdo->prepare($query);
        } catch (PDOException $exception) {
            throw new \LogicException("Cannot prepare the statement: $query", 0, $exception);
        }
        if (false === $statement) {
            throw new \LogicException("Cannot prepare the statement: $query");
        }
        $this->statements[$query] = $statement;

        return $statement;
    }
}
