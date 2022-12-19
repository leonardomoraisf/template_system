<?php

namespace App\Models;

class AdminsModel{

    private $id;
    private $user;
    private $password;
    private $name;
    private $position;

    public static function updateOnlineAdmin(){
        if(isset($_SESSION['online'])){
            $token = $_SESSION['online'];
            $hour = date('Y-m-d H:i:s');
            $pdo = \App\MySql::connect();
            $check = $pdo->prepare("SELECT `id` FROM `online_admins` WHERE token = ?");
            $check->execute(array($_SESSION['online']));
            if($check->rowCount() == 1){
                $update = $pdo->prepare("UPDATE `online_admins` SET last_action = ? WHERE token = ?");
                $update->execute(array($hour,$token));
            }else{
                $adminId = $_SESSION['id'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $hour = date('Y-m-d H:i:s');
                $pdo =  \App\MySql::connect();
                $insert = $pdo->prepare("INSERT INTO `online_admins` VALUES (null,?,?,?,?)");
                $insert->execute(array($ip,$hour,$token,$adminId));
            }
        }else{
            $_SESSION['online'] = uniqid();
            $adminId = $_SESSION['id'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $token = $_SESSION['online'];
            $hour = date('Y-m-d H:i:s');
            $pdo =  \App\MySql::connect();
            $insert = $pdo->prepare("INSERT INTO `online_admins` VALUES (null,?,?,?,?)");
            $insert->execute(array($ip,$hour,$token,$adminId));
        }
    }

    public static function clearOnlineAdmins(){
        $date = date("Y-m-d H:i:s");
        $pdo = \App\MySql::connect();
        $pdo->exec("DELETE FROM `online_admins` WHERE last_action < '$date' - INTERVAL 1 MINUTE");
    }

    public static function listOnlineAdmins(){
        self::clearOnlineAdmins();
        $pdo = \App\MySql::connect();
        $select = $pdo->prepare("SELECT * FROM `online_admins` INNER JOIN `users` on `online_admins`.`admin_id` = users.id");
        $select->execute();
        return $select->fetchAll();
    }

    public function panelLoginUser($user,$password){

        $user = \App\Models\AllUsersModel::validateData($_POST['user']);

        // Verificar no banco de dados
        $verify = \App\MySql::connect()->prepare("SELECT * FROM users WHERE user = ?");
        $verify->execute(array($user));

        if($verify->rowCount() == 0){
            // Não existe o user
            \App\Utilities::redirect(INCLUDE_PATH.'panel');
        }else{
            $data = $verify->fetch();
            $user = $data['user'];
            $passwordData = $data['password'];
            $position = $data['position'];
            if(\App\Bcrypt::check($password,$passwordData)){
                if($position >= 1){
                    // Logado com sucesso
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $passwordData;
                    $_SESSION['name'] = $data['name'];
                    $_SESSION['position'] = $data['position'];
                    \App\Utilities::redirect(INCLUDE_PATH.'panel');
                }else{
                    \App\Utilities::redirect(INCLUDE_PATH.'panel');
                }
            }else{
                \App\Utilities::redirect(INCLUDE_PATH.'panel');
            }

        }
    }


}