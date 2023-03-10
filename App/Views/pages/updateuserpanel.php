<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Atualizar usuário</title>
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_updateuserpanel.css" rel="stylesheet" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>

    <?php include('includes/sidebar_topmenu.php')?>

    <div class="content">

        <div class="box-content w100">
            
            <div class="form-container-register">

            <?php if(isset($_POST['error'])){ ?>
				<p class="error"><?php echo $_POST['error'];?></p>
            <?php } ?>

                <div class="form-register">

                    <form method="post">
                        <span class="txt">Digite o usuário que deseja atualizar: </span>
                        <input class="user" type="text" name="user" placeholder="Usuário">
                        <span class="txt">Altere as informações: </span>
                        <input class="name" type="text" name="name" placeholder="Nome Completo">
                        <label >Mudar posição :</label>
                        <select name="position" >
                            <option value=""></option>
                            <?php
                                foreach (\App\Models\AllUsersModel::$positions as $key => $value) {
                                    echo '
                                    <option value="'.$key.'">'.$value.'</option>
                                    ';
                                }
                            ?>
                        </select>
                        <input type="password" name="password" placeholder="Senha">
                        <input type="submit" name="action" value="Atualizar conta">
                        <?php if(isset($_POST['succsess'])){ ?>
                            <p class="succsess"><?php echo $_POST['succsess'];?></p>
                        <?php } ?>
                        <input type="hidden" name="update" value="update">
                    </form>

                </div><!--form-register-->

            </div><!--form-container-register-->

        </div><!--box-content-->

    </div><!--content-->

<script src="<?php echo INCLUDE_PATH_STATIC ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_STATIC ?>js/main.js"></script>

</body>
</html>