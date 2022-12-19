<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Bem-vindo(a), <?php echo $_SESSION['name']?></title>
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_panel.css" rel="stylesheet" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <?php include('includes/sidebar_topmenu.php')?>

    <div class="content">

        <?php include('includes/admin_infos.php')?>

        <?php include('includes/online_admins.php') ?>

    </div>


</body>

</html>