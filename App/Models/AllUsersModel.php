<?php

namespace App\Models;

class AllUsersModel{

    private $id;
    private $user;
    private $password;
    private $name;
    private $position;

    public static function validateData($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static $positions = [
        '1' => 'Usuário',
        '2' => 'Gestor',
        '3' => 'Administrador',
    ];

    public static function catchPosition($position){
        $arr = self::$positions;
        return $arr[$position];
    }

    public function getUserById($id){
        $pdo = \App\MySql::connect();
        $catch = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $catch->execute(array($id));
        if($catch->rowCount() == 1){
            // Listar informações do usuário
            $catch->fetch();
        }else{
            // Usuário não existe
        }
    }

    public static function getUsersByUser($user){
        $pdo = \App\MySql::connect();
        $catch = $pdo->prepare("SELECT * FROM users WHERE user = ?");
        $catch->execute(array($user));
        if($catch->rowCount() == 1){
            // Listar informações do usuário
            $catch->fetch();
        }else{
            // Usuário não existe
        }
    }

    public function updateUser($name, $user, $password, $position){
        $name = strip_tags($name);
        $user = strip_tags($user);
        $password = \App\Bcrypt::hash(strip_tags($password));
        $update = \App\MySql::connect()->prepare("UPDATE INTO users SET user = ?,password = ?, name = ?, position = ?");
        $update->execute(array($user,$password,$name,$position));
    }

    public static function userExists($user){
        $pdo = \App\MySql::connect();
        $verify = $pdo->prepare("SELECT user FROM users WHERE user = ?");
        $verify->execute(array($user));

        if($verify->rowCount() == 1){
            // User exists
            return true;
        }else{
            return false;
        }
    }

    public static function visitCounter(){
        if(!isset($_COOKIE['visit'])){
            setcookie('visit','True',time() + (60*60*24*7));
            $date = date('Y-m-d');
            $pdo = \App\MySql::connect();
            $create = $pdo->prepare("INSERT INTO `user_visits` VALUES (null,?)");
            $create->execute(array($date));
        }
    }
    
    public static function allVisits(){
        $pdo = \App\MySql::connect();
        $catch = $pdo->prepare("SELECT * FROM `user_visits`");
        $catch->execute();
        return $catch->rowCount();
    }

    public static function todayVisits(){
        $date = date('Y-m-d');
        $pdo = \App\MySql::connect();
        $catch = $pdo->prepare("SELECT * FROM `user_visits` WHERE date = ?");
        $catch->execute(array($date));
        return $catch->rowCount();
    }


}