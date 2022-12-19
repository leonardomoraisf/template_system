<link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_sidebar_topmenu.css">
<link href="<?php echo INCLUDE_PATH_STATIC ?>icons/font_awesome/css/font-awesome.min.css" rel="stylesheet" >



<div class="sidebar">
    
        <div class="sidebar-wrapper">

            <div class="menu-sidebar">

                <h4><?php echo NOME_EMPRESA ?></h4>
                <div class="user-box">
                    <div class="user-avatar">
                        <i class="fa fa-user"></i>
                    </div><!--user-avatar-->
                    <div class="user-name">
                        <p><?php echo $_SESSION['name']?></p>
                        <p><?php echo \App\Models\AllUsersModel::catchPosition($_SESSION['position']); ?></p>
                    </div>
                </div><!--user-box-->
                <a href="<?php echo INCLUDE_PATH.'panel'?>">Início</a>
                <a href="<?php echo INCLUDE_PATH.'registerpanel'?>">Registrar novo usuário</a>
                
            </div>

        </div><!--sidebar-wrapper-->

</div><!--sidebar-->

<header>
    <div class="top-menu-center">

        <div class="top-menu-btn">
            <i class="fa fa-bars"></i>
        </div>
        <div class="top-menu-logout">
            <a href="<?php echo INCLUDE_PATH.'panel'?>?logout">Sair<i class="fa fa-arrow-right"></i></a>
        </div><!--logout-->

    </div><!--center-->
</header>

<script src="<?php echo INCLUDE_PATH_STATIC ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_STATIC ?>js/sidebar_topmenu.js"></script>



