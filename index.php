<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    // Import composer
    require('vendor/autoload.php');

    $app = new App\Application();
    $app->run();

?>