<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Registrar novo usuário</title>
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_registerpanel.css" rel="stylesheet" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>

    <?php include('includes/sidebar_topmenu.php')?>

    <div class="content">

        <div class="box-content">
            
            <div class="form-container-register">

                <div class="form-register">

                    <form method="post">
                        <input type="text" name="name" placeholder="Nome Completo">
                        <input type="text" name="user" placeholder="Usuário">
                        <label >Posição :</label>
                        <select name="position" >
                            <?php
                                foreach (\App\Models\AllUsersModel::$positions as $key => $value) {
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            ?>
                        </select>
                        <input type="password" name="password" placeholder="Senha">
                        <input type="submit" name="action" value="Criar nova conta">
                        <input type="hidden" name="register" value="register">
                    </form>

                </div><!--form-register-->

            </div><!--form-container-register-->

        </div><!--box-content-->

    </div><!--content-->

<script src="<?php echo INCLUDE_PATH_STATIC ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_STATIC ?>js/main.js"></script>

</body>
</html>