<?php
    namespace App\Models;

    class UsersModel{

        private $id;
        private $user;
        private $password;
        private $name;
        private $position;

        public static function updateOnlineUser(){
            if(isset($_SESSION['online'])){
                $token = $_SESSION['online'];
                $hour = date('Y-m-d H:i:s');
                $pdo = \App\MySql::connect();
                $check = $pdo->prepare("SELECT `id` FROM `online_users` WHERE token = ?");
                $check->execute(array($_SESSION['online']));
                if($check->rowCount() == 1){
                    $update = $pdo->prepare("UPDATE `online_users` SET last_action = ? WHERE token = ?");
                    $update->execute(array($hour,$token));
                }else{
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $token = $_SESSION['online'];
                    $hour = date('Y-m-d H:i:s');
                    $pdo =  \App\MySql::connect();
                    $insert = $pdo->prepare("INSERT INTO `online_users` VALUES (null,?,?,?)");
                    $insert->execute(array($ip,$hour,$token));
                }
            }else{
                $_SESSION['online'] = uniqid();
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $hour = date('Y-m-d H:i:s');
                $pdo =  \App\MySql::connect();
                $insert = $pdo->prepare("INSERT INTO `online_users` VALUES (null,?,?,?)");
                $insert->execute(array($ip,$hour,$token));
            }
        }
    
        public static function clearOnlineUsers(){
            $date = date("Y-m-d H:i:s");
            $pdo = \App\MySql::connect();
            $pdo->exec("DELETE FROM `online_users` WHERE last_action < '$date' - INTERVAL 1 MINUTE");
        }
    
        public static function listOnlineUsers(){
            self::clearOnlineUsers();
            $pdo = \App\MySql::connect();
            $select = $pdo->prepare("SELECT * FROM `online_users`");
            $select->execute();
            return $select->fetchAll();
        }

    }
?>