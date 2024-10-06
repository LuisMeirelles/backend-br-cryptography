<?php

namespace Meirelles\BackendBrCryptography\Core;

use PDO;

class Database extends PDO
{
    private static Database $instance;

    private function __construct()
    {
        $host = getenv('DB_HOST');
        $database = getenv('DB_DATABASE');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        parent::__construct("mysql:host=$host;dbname=$database", $username, $password);

        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);
    }

    public static function getInstance(): PDO
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function execWithParams(string $sql, array $params): void
    {
        self::getInstance()
            ->prepare($sql)
            ->execute($params);
    }
}