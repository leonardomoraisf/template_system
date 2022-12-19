<link rel="stylesheet" href="<?php echo INCLUDE_PATH_STATIC ?>styles/panel.css">
<link href="<?php echo INCLUDE_PATH_STATIC ?>icons/font_awesome/css/font-awesome.min.css" rel="stylesheet">

<?php $onlineAdmins = \App\Models\AdminsModel::listOnlineAdmins(); ?>

<div class="box-content w100">

    <h2><i class="fa fa-rocket"></i>Admins online = <div class="box-count"><span><?php echo count($onlineAdmins) ?></span></div></h2>

    <div class="table-responsive">

        <div class="row">

            <div class="col">
                <span>Nome</span>
            </div>
            <!--col-->
            <div class="col">
                <span>Funçao</span>
            </div>
            <!--col-->
            <div class="col">
                <span>IP</span>
            </div>
            <!--col-->
            <div class="col">
                <span>Última ação</span>
            </div>
            <!--col-->
            <div class="clear"></div>

        </div>
        <!--row-->
        <?php foreach ($onlineAdmins as $key => $value) { ?>
            <div class="row">

                <div class="col">
                    <span><?php echo $value['name']; ?></span>
                </div>
                <!--col-->
                <?php $position = \App\Models\AllUsersModel::catchPosition($value['position']);?>
                <div class="col">
                    <span><?php echo $position; ?></span>
                </div>
                <!--col-->
                <div class="col">
                    <span><?php echo $value['ip']; ?></span>
                </div>
                <!--col-->
                <div class="col">
                    <span><?php echo date('d/m/Y H:i:s', strtotime($value['last_action'])); ?></span>
                </div>
                <!--col-->
                <div class="clear"></div>

            </div>
            <!--row-->
        <?php } ?>

    </div>
    <!--table-responsive-->

</div>
<!--box-context-->


<script src="<?php echo INCLUDE_PATH_STATIC ?>js/jquery.js"></script>