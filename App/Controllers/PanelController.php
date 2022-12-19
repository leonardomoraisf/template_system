<?php

    namespace App\Controllers;

    use App\Models\AdminsModel;

    class PanelController 
    {
        public function index(){

            if(isset($_GET['logoutpanel'])){
                \App\Models\AdminsModel::logoutPanel();
            }

            if(isset($_SESSION['login-panel'])){
                // Renderiza home do panel admin
                \App\Views\MainView::render('panel');
                \App\Models\AdminsModel::updateOnlineAdmin();
            }else{
                // Renderiza para logar no panel admin

                if(isset($_POST['login'])){
                    $login = new AdminsModel;
                    $user = $_POST['user'];
                    $password = $_POST['password'];
                    $login->panelLogin($user,$password);
                }

                \App\Views\MainView::render('loginpanel');
            }

        }
    }
    
?>