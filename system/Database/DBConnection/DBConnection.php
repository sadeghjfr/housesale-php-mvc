<?php

namespace System\Database\DBConnection;
use PDO;
use PDOException;
use System\Config\Config;

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
                "mysql:host=".Config::get('database.DB_HOST').";dbname=".Config::get('database.DB_NAME'),
                Config::get('database.DB_USERNAME'),
               Config::get('database.DB_PASSWORD'),
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










