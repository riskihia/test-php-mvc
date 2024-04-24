<?php

namespace EsbiTest\Config;

class Database
{
    private static ?\PDO $pdo = null;

    public static function getConnection(string $env = "test"): \PDO
    {
        if(self::$pdo == null){
            // create new PDO
            self::$pdo = new \PDO(
                "mysql:host=localhost:3306;dbname=esbi_test",
                "root",
                ""
            );
        }

        return self::$pdo;
    }

    public static function beginTransaction(){
        self::$pdo->beginTransaction();
    }

    public static function commitTransaction(){
        self::$pdo->commit();
    }

    public static function rollbackTransaction(){
        self::$pdo->rollBack();
    }
}
