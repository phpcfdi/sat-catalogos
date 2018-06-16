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

    const CFDI_ADUANAS = 'cfdi_aduanas';

    const CFDI_CLAVES_UNIDADES = 'cfdi_claves_unidades';

    const CFDI_PRODUCTOS_SERVICIOS = 'cfdi_productos_servicios';

    const CFDI_CODIGOS_POSTALES = 'cfdi_codigos_postales';

    const CFDI_IMPUESTOS = 'cfdi_impuestos';

    const CFDI_FORMAS_PAGO = 'cfdi_formas_pago';

    const CFDI_METODOS_PAGO = 'cfdi_metodos_pago';

    const CFDI_MONEDAS = 'cfdi_monedas';

    const CFDI_PAISES = 'cfdi_paises';

    const CFDI_REGIMENES_FISCALES = 'cfdi_regimenes_fiscales';

    const CFDI_TIPOS_RELACIONES = 'cfdi_tipos_relaciones';

    const CFDI_USOS_CFDI = 'cfdi_usos_cfdi';

    const CFDI_TIPOS_FACTOR = 'cfdi_tipos_factor';

    const CATALOGS = [
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
        self::CFDI_TIPOS_FACTOR,
    ];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function queryById(string $catalog, string $id): array
    {
        $sql = 'select * '
            . ' from ' . $this->catalogName($catalog)
            . ' where (id = :id);';
        $data = $this->queryRow($sql, ['id' => $id]);
        if (! count($data)) {
            throw $this->createSatCatalogosNotFoundException($catalog, ['id' => $id]);
        }

        return $data;
    }

    public function queryRowByFields(string $catalog, array $values): array
    {
        $keys = array_keys($values);
        $sql = 'select * '
            . ' from ' . $this->catalogName($catalog)
            . call_user_func(function (array $keys): string {
                if (count($keys)) {
                    return ' where ' . implode(' and ', array_map(function ($field) {
                        return $this->escapeName($field) . ' = :' . $field;
                    }, $keys));
                }
                return '';
            }, $keys)
            . ';';
        $data = $this->queryRow($sql, $values);
        if (! count($data)) {
            throw $this->createSatCatalogosNotFoundException($catalog, $values);
        }

        return $data;
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
        if (null === $value = $this->queryValue($sql, ['id' => $id])) {
            throw new SatCatalogosLogicException("Cannot check if exists '$id' inside $catalog");
        }
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
     * @param string $exceptionMessage
     * @return PDOStatement
     */
    private function query(string $query, array $arguments = [], string $exceptionMessage = ''): PDOStatement
    {
        $statement = $this->statement($query);
        if (! $statement->execute($arguments)) {
            $exceptionMessage = $exceptionMessage ? : 'Error retrieving data from database';
            throw new PDOException($exceptionMessage);
        }

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

        $statement = $this->pdo->prepare($query);
        if (false === $statement) {
            throw new \LogicException("Cannot prepare the statement: $query");
        }
        $this->statements[$query] = $statement;

        return $statement;
    }
}
