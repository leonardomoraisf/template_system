<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Painel de controle</title>
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_loginpanel.css" rel="stylesheet" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>icons/font_awesome/css/font-awesome.min.css" rel="stylesheet" >
</head>
<body>

    <div class="sidebar"></div>
    
    <div class="form-container-login">

        <div class="form-login">

            <?php if(isset($_POST['error'])){ ?>
                <p class="error"><?php echo $_POST['error'];?></p>
            <?php } ?>
            <span class="txt">Insira suas informações para entrar:</span>
            <form class="form" method="post">
                <input type="text" name="user" placeholder="Usuário">
                <input type="password" name="password" placeholder="Senha">
                <input type="submit" name="action" value="Entrar">
                <input type="hidden" name="login">
            </form>

        </div><!--form-login-->

    </div>
    
</body>
</html>