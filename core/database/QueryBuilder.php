<?php

namespace Core\Database;

use PDO;

class QueryBuilder
{
    public function __construct(public PDO $pdo)
    {
    }

    /**
     * Select all records from a database table.
     *
     * @param  string  $table
     * @return bool|array
     */
    public function selectAll(string $table): bool|array
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Insert a record into a table.
     *
     * @param  string  $table
     * @param  array  $parameters
     */
    public function insert(string $table, array $parameters): void
    {
        $parameters['created_at'] = date("Y-m-d H:i:s");
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':'.implode(', :', array_keys($parameters))
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameters);
    }

    /**
     * Select one record from a database table.
     *
     * @param  string  $table
     * @param  string  $column
     * @param  string  $value
     * @return mixed
     */
    public function select(string $table, string $column, string $value, bool $lock = null): mixed
    {
        $query = "select * from ".$table." where $column = :$column";
        if ($lock) {
            // lock the row!
            $query = $query." FOR UPDATE";
        }
        $statement = $this->pdo->prepare($query);
        $parameters = array(
            $column => $value
        );
        $statement->execute($parameters);

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Update a record.
     *
     * @param  string  $table
     * @param $id
     * @param  array  $parameters
     * @return int
     */
    public function update(string $table, $id, array $parameters): int
    {
        $parameterKeys = [];
        foreach ($parameters as $key => $value) {
            $parameterKeys[] = "$key=:$key ";
        }
        $sql = sprintf(
            "update %s set %s where id=:id",
            $table,
            implode(', ', $parameterKeys)
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameters + ['id' => $id]);

        return $statement->rowCount();
    }

    /**
     * Delete a specific row.
     *
     * @param  string  $table
     * @param $id
     * @return int|void
     */
    public function delete(string $table, $id)
    {
        $query = "delete from $table where id=?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$id]);
        return $statement->rowCount();
    }

    public function beginTransaction(): void
    {
        $this->pdo->beginTransaction();
    }

    public function commit(): void
    {
        $this->pdo->commit();
    }

    public function rollback(): void
    {
        $this->pdo->rollBack();
    }
}
