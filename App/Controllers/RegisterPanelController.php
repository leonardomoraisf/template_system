<?php

namespace App\Controllers;

use App\Models\AdminsModel;

class RegisterPanelController
{
    public function index(){
        
        if(isset($_POST['register'])){
            $register = new AdminsModel;
            $name = $_POST['name'];
            $user = $_POST['user'];
            $password = $_POST['password'];
            $position = $_POST['position'];
            $register->registerPanelUser($name, $user,$password,$position);
        }

        if(isset($_SESSION['login-panel'])){
            // Renderizar para criar conta
            \App\Views\MainView::render('registerpanel');
        }else{
            \App\Views\MainView::render('404');
         }

    
    }
}

?>