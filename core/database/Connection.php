<?php

namespace Core\Database;

use PDO;
use PDOException;

class Connection
{
    /**
     * Create a new PDO connection.
     *
     * @param  array  $config
     * @return PDO
     */
    public static function make(array $config): PDO
    {
        try {
            return new PDO(
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage().'__________'.$e->getTraceAsString());
        }
    }
}
