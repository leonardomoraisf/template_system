<?php

namespace App\Models;

class DepoimentosModel{

    public static function insert($arr){
        $right = true;
        $table_name = $arr['table_name'];
        $query = "INSERT INTO `$table_name` VALUES (null";
        foreach ($arr as $key => $value) {
            $name = $key;
            $value = $value;
            if($name == 'register' || $name == 'table_name' || $name == 'succsess' || $name == 'action' || $name == 'error')
                continue;
            if($value == ''){
                $right = false;
                break;
            }
            $query.=",?";
            $parameters[] = $value;
        }

        $query.=")";

        if($right == true){
            $pdo = \App\MySql::connect();
            $insert = $pdo->prepare($query);
            $insert->execute($parameters);
        }
        
        return $right;
    }

}