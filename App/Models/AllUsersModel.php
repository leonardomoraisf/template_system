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
        '0' => 'Usuário',
        '1' => 'Gestor',
        '2' => 'Administrador',
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

    public function getUsersByUser($user){
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

    public function userExists($user){
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

    
    public function registerUser($name, $user, $password, $position){

        $name = self::validateData($_POST['name']);
        $user = self::validateData($_POST['user']);

        if($name == null){
            \App\Utilities::alert('Nome inválido.');
            \App\Utilities::redirect(INCLUDE_PATH.'registerpanel');
        }else if($user == null){
            \App\Utilities::alert('Usuário inválido.');
        }else if(self::userExists($user)){
            \App\Utilities::alert('Este usuário já existe!');
            \App\Utilities::redirect(INCLUDE_PATH.'registerpanel');
        }else if($password == null){
            \App\Utilities::alert('Senha inválida!');
            \App\Utilities::redirect(INCLUDE_PATH.'registerpanel');
        }else if(strlen($password) < 6){
            \App\Utilities::alert('A senha deve conter mais de 6 caracteres!');
            \App\Utilities::redirect(INCLUDE_PATH.'registerpanel');
        }else if($position == null){
            \App\Utilities::alert('Escolha uma posição!');
            \App\Utilities::redirect(INCLUDE_PATH.'registerpanel');
        }else{
            // Registrar usuario
            $password = \App\Bcrypt::hash($password);
            $register= \App\MySql::connect()->prepare("INSERT INTO users VALUES (null,?,?,?,?)");
            $register->execute(array($user,$password,$name,$position));
            \App\Utilities::alert('Usuário cadastrado!');
            \App\Views\MainView::render('registerpanel');
        }
    }

}