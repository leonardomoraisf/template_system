<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Cadastro de depoimentos</title>
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style_registerdepoimentospanel.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>

    <?php include('includes/sidebar_topmenu.php') ?>

    <div class="content">

        <div class="box-content w100">

        <h2><i class="fa fa-pencil"></i>Cadastrar depoimentos</h2>

            <div class="form-container-register">

                <div class="form-register">

                <?php if (isset($_POST['error'])) { ?>
                    <p class="error"><?php echo $_POST['error']; ?></p>
                <?php } ?>

                    <form method="post">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" placeholder="Nome completo">
                        <label for="depoimento">Depoimento:</label>
                        <textarea name="depoimento" ></textarea>
                        <label for="depoimento">Data:</label>
                        <input type="date" name="date" placeholder="Data">
                        <input type="submit" name="action" value="Cadastrar depoimento">
                        <?php if (isset($_POST['succsess'])) { ?>
                            <p class="succsess"><?php echo $_POST['succsess']; ?></p>
                        <?php } ?>
                        <input type="hidden" name="table_name" value="users_depoimentos">
                        <input type="hidden" name="register" value="register">
                    </form>

                </div>
                <!--form-register-->

            </div>
            <!--form-container-register-->

        </div>
        <!--box-content-->

    </div>
    <!--content-->

    <script src="<?php echo INCLUDE_PATH_STATIC ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_STATIC ?>js/main.js"></script>

</body>

</html>