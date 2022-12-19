<?php

namespace App\Controllers;

use App\Models\AllUsersModel;

class RegisterPanelController
{
    public function index(){
        
        if(isset($_POST['register'])){
            $register = new AllUsersModel;
            $name = $_POST['name'];
            $user = $_POST['user'];
            $password = $_POST['password'];
            $position = $_POST['position'];
            $register->registerUser($name, $user,$password,$position);
        }

        if(isset($_SESSION['login'])){
            // Renderizar para criar conta
            \App\Views\MainView::render('registerpanel');
        }else{
            //\MVC\Utilities::redirect(INCLUDE_PATH.'panel');
         }

    
    }
}

?>