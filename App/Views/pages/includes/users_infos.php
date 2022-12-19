<link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/panel.css">
<link href="<?php echo INCLUDE_PATH_STATIC ?>icons/font_awesome/css/font-awesome.min.css" rel="stylesheet" >

<?php 
$onlineUsers = \App\Models\UsersModel::listOnlineUsers(); 
$allVisits = \App\Models\AllUsersModel::allVisits();
$todayVisits = \App\Models\AllUsersModel::todayVisits();
?>

<div class="box-content w100">

    <h2> <i class="fa fa-home"></i>Painel de Controle</h2>

    <div class="box-metricas">

        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Usuários Online</h2>
                <p><?php echo count($onlineUsers); ?></p>
            </div>
        </div>

        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Total de visitas</h2>
                <p><?php echo $allVisits; ?></p>
            </div>
        </div>

        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Visitas hoje</h2>
                <p><?php echo $todayVisits; ?></p>
            </div>
        </div>
    <div class="clear"></div>
    </div><!-- box-metricas-->

</div><!--box-context-->


<script src="<?php echo INCLUDE_PATH_STATIC ?>js/jquery.js"></script>
