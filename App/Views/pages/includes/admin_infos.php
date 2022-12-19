<link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/panel.css">
<link href="<?php echo INCLUDE_PATH_STATIC ?>icons/font_awesome/css/font-awesome.min.css" rel="stylesheet" >

<?php $onlineAdmins = \App\Models\AdminsModel::listOnlineAdmins(); ?>

<div class="box-content w100">

    <h2> <i class="fa fa-home"></i>Painel de Controle</h2>

    <div class="box-metricas">

        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Admins Online</h2>
                <p><?php echo count($onlineAdmins); ?></p>
            </div>
        </div>

        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Total de visitas</h2>
                <p>100</p>
            </div>
        </div>

        <div class="box-metrica-single">
            <div class="box-metrica-wrapper">
                <h2>Visitas hoje</h2>
                <p>3</p>
            </div>
        </div>
    <div class="clear"></div>
    </div><!-- box-metricas-->

</div><!--box-context-->


<script src="<?php echo INCLUDE_PATH_STATIC ?>js/jquery.js"></script>
