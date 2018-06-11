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
            throw new SatCatalogosNotFoundException("Cannot found $catalog using '$id'");
        }

        return $data;
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

    public function catalogName(string $catalog): string
    {
        if (! in_array($catalog, self::CATALOGS, true)) {
            throw new SatCatalogosLogicException("The catalog name $catalog is not recognized by the repository");
        }

        return $catalog;
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
