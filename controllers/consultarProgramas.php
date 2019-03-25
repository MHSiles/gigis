<?php

    session_start();

    if($_SESSION['cuenta']['rol'] == 'D' || $_SESSION['cuenta']['rol'] == 'A'){

        include_once("moduloSesiones.php");

        include_once("moduloProgramas.php");

        include("../views/_header.html");

        include("../views/_navLogOut.html");

        if($_SESSION['cuenta']['rol'] == 'D'){
          include("../views/_nav.html");
        }else{
          include("../views/_navUsuario.html");
        }

        include("../views/_consultarProgramas.html");

        include("../views/_footer.html");

    } else {

        http_response_code(404);
        die();

    }
?>
