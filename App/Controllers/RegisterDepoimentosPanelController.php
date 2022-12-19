<?php

namespace App\Controllers;

class RegisterDepoimentosPanelController{
    public function index(){

        if(isset($_POST['register'])){
           if(\App\Models\DepoimentosModel::insert($_POST)){
                $_POST['succsess'] = "Depoimento cadastrado com sucesso!";
           }else{
                $_POST['error'] = "Há campos vazios!";
           }
        }

        if(isset($_SESSION['login-panel'])){
            // Renderizar para criar conta
            \App\Views\MainView::render('registerdepoimentospanel');
        }else{
            \App\Views\MainView::render('404');
         }
    }
}