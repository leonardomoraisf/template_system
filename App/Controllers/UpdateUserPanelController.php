<?php

namespace App\Controllers;

use App\Models\AdminsModel;

class UpdateUserPanelController{
    public function index(){

        if(isset($_POST['update'])){
            $update = new AdminsModel;
            $user = $_POST['user'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $position = $_POST['position'];
            $update->updatePanelUser($user,$name,$password,$position);
        }

        if(isset($_SESSION['login-panel'])){
            // Renderizar para criar conta
            \App\Views\MainView::render('updateuserpanel');
        }else{
            \App\Views\MainView::render('404');
         }
    }
}