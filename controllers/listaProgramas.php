<?php

    session_start();

    if($_SESSION['cuenta']['rol'] == 'D' || $_SESSION['cuenta']['rol'] == 'A'){

        include_once("moduloSesiones.php");

        include("moduloProgramas.php");

        echo (listaProgramas());

    } else {

        http_response_code(404);
        die();

    }
?>
