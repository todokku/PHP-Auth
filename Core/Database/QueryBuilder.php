<?php
namespace Core\Database;

use PDO;

class QueryBuilder extends Connection
{
    private ?object $conn;

    /**
     * make database connection
     */
    public function __construct(array $config)
    {
        $this->conn = parent::make($config);
    }

    /**
     * query from database
     *
     * @param string $sql
     * @param array $params
     */
    public function query(string $sql, array $params = []): bool
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * query fetch all from database
     *
     * @param string $sql
     * @param array $params
     */
    public function querySelectAll(string $sql, array $params = []): array
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * query for fetch 1 from database
     *
     * @param string $sql
     * @param array $params
     */
    public function querySelect(string $sql, array $params = []): array
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_CLASS);
    }
    
    /**
     * Select all from database
     *
     * @param string $table
     */
    public function selectAll(string $table): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM ?");
        $stmt->execute([$table]);
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * select from database
     *
     * @param string $table
     * @param array $params
     */
    public function select($table, array $params = ['*']): array
    {
        $sql = sprintf(
            "SELECT %s FROM {$table}",
            implode(",", $params)
        );
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_CLASS);
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}