<?php

namespace App;

use Exception;
use PDO;

    class MySql{

        private static $pdo;

        public static function connect(){
            if(self::$pdo == null){
                try{
                    self::$pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME,DBUSER,DBPASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }catch(Exception $e){
                    echo '<h2>ERRO AO CONECTAR</h2>';
                    error_log($e->getMessage());
                }
            }
            return self::$pdo;
        }

    }

?>