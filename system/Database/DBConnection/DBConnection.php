<?php

namespace System\Database\DBConnection;
use PDO;
use PDOException;

class DBConnection{

    private static $dbConnectionInstance = null;

    private function __construct(){

    }

    public static function getDBConnectionInstance(){

        if (self::$dbConnectionInstance == null){

            $DBConnectionInstance = new DBConnection();
            self::$dbConnectionInstance = $DBConnectionInstance->dbConnection();
        }

        return self::$dbConnectionInstance;
    }

    private function dbConnection(){

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ];

        try {

            return new PDO(
                "mysql:host=".DB_HOST.";dbname=".DB_NAME,
                DB_USERNAME,
                DB_PASSWORD,
                $options
            );
        }
        catch (PDOException $e){
            echo "Database connection error : " . $e->getMessage();
            return false;
        }
    }

    public static function newInsertId(){
        return self::getDBConnectionInstance()->lastInsertId();
    }

}










