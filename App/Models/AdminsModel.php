<?php

namespace App\Models;

class AdminsModel{

    private $id;
    private $user;
    private $password;
    private $name;
    private $position;

    public static function updateOnlineAdmin(){
        if(isset($_SESSION['online_panel'])){
            $token = $_SESSION['online_panel'];
            $hour = date('Y-m-d H:i:s');
            $pdo = \App\MySql::connect();
            $check = $pdo->prepare("SELECT `id` FROM `online_admins` WHERE token = ?");
            $check->execute(array($_SESSION['online_panel']));
            if($check->rowCount() == 1){
                $update = $pdo->prepare("UPDATE `online_admins` SET last_action = ? WHERE token = ?");
                $update->execute(array($hour,$token));
            }else{
                $adminId = $_SESSION['id'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online_panel'];
                $hour = date('Y-m-d H:i:s');
                $pdo =  \App\MySql::connect();
                $insert = $pdo->prepare("INSERT INTO `online_admins` VALUES (null,?,?,?,?)");
                $insert->execute(array($ip,$hour,$token,$adminId));
            }
        }else{
            $_SESSION['online_panel'] = uniqid();
            $adminId = $_SESSION['id'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $token = $_SESSION['online_panel'];
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

    public function panelLogin($user,$password){

        if(empty($user) || empty($password)){
            $_POST['error'] = "Usuário ou senha incorretos!";
        }

        $user = \App\Models\AllUsersModel::validateData($_POST['user']);

        // Verificar no banco de dados
        $verify = \App\MySql::connect()->prepare("SELECT * FROM users WHERE user = ?");
        $verify->execute(array($user));

        if(!empty($user) && !empty($password)){
            if($verify->rowCount() == 0){
                // Não existe o user
                $_POST['error'] = "Usuário ou senha incorretos!";
            }else{
                $data = $verify->fetch();
                $user = $data['user'];
                $passwordData = $data['password'];
                $position = $data['position'];
                if(\App\Bcrypt::check($password,$passwordData)){
                    if($position >= 2){
                        // Logado com sucesso
                        $_SESSION['login-panel'] = true;
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['user'] = $user;
                        $_SESSION['password'] = $passwordData;
                        $_SESSION['name'] = $data['name'];
                        $_SESSION['position'] = $data['position'];
                        \App\Utilities::redirect(INCLUDE_PATH.'panel');
                        die();
                    }else{
                        $_POST['error'] = "Você não tem permissão!";
                    }
                }else{
                    $_POST['error'] = "Usuário ou senha incorretos!";
                }

            }
        }
    }

    public function registerPanelUser($name, $user, $password, $position){

        $name = \App\Models\AllUsersModel::validateData($_POST['name']);
        $user = \App\Models\AllUsersModel::validateData($_POST['user']); 

        if(empty($name) || empty($user) || empty($password) || empty($position)){
            $_POST['error'] = "Há campos não preenchidos!";
        }
        if(!empty($name) && !empty($user) && !empty($password) && !empty($position)){
            if(\App\Models\AllUsersModel::userExists($user)){
                $_POST['error'] = "Este usuário já existe!";
            }else if(strlen($password) < 6){
                $_POST['error'] = "A senha deve conter mais de 6 caracteres!";
            }else if($position >= $_SESSION['position']){
                $_POST['error'] = "Você não pode cadastrar contas com uma posição maior que a sua!";
            }else{
                // Registrar usuario
                $password = \App\Bcrypt::hash($password);
                $register = \App\MySql::connect()->prepare("INSERT INTO users VALUES (null,?,?,?,?)");
                $register->execute(array($user,$password,$name,$position));
                $_POST['succsess'] = "Usuário cadastrado!";
            }
        }
    }

    public function updatePanelUser($user, $name, $password, $position){
        
        $name = \App\Models\AllUsersModel::validateData($_POST['name']);
        
        if(empty($user) || empty($name) || empty($password) || empty($position)){
            $_POST['error'] = "Há campos não preenchidos!";
        }
        
        if(!empty($name) && !empty($user) && !empty($password) && !empty($position)){
            if(\App\Models\AllUsersModel::userExists($user)){
                if(strlen($password) < 6){
                    $_POST['error'] = "A senha deve conter mais de 6 caracteres!";
                }else if($position >= $_SESSION['position']){
                    $_POST['error'] = "Você não pode atualizar contas com uma posição maior que a sua!";
                }else{
                    $password = \App\Bcrypt::hash($password);
                    $pdo = \App\MySql::connect();
                    $update = $pdo->prepare("UPDATE users SET password = ?, name = ?, position = ? WHERE user = ? ");
                    $update->execute(array($password,$name,$position,$user));
                    $_POST['succsess'] = "Usuário atualizado com sucesso!";
                }
            }else{
                $_POST['error'] = "Este usuário não existe!";
            }
        }

    }

    public static function logoutPanel(){
        session_unset();
        session_destroy();

        \App\Utilities::redirect(INCLUDE_PATH.'panel');
    }

}