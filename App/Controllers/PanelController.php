<?php

    namespace App\Controllers;

    use App\Models\AdminsModel;

    class PanelController 
    {
        public function index(){

            if(isset($_GET['logout'])){
                session_unset();
                session_destroy();

                \App\Utilities::redirect(INCLUDE_PATH.'panel');
            }

            if(isset($_SESSION['login'])){
                // Renderiza home do panel admin
                \App\Views\MainView::render('panel');
                \App\Models\AdminsModel::updateOnlineAdmin();
            }else{
                // Renderiza para logar no panel admin

                if(isset($_POST['login'])){
                    $login = new AdminsModel;
                    $user = $_POST['user'];
                    $password = $_POST['password'];
                    $login->panelLoginUser($user,$password);
                    \App\Models\AdminsModel::updateOnlineAdmin();
                }

                \App\Views\MainView::render('loginpanel');
            }

        }
    }
    
?>