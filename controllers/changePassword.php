<?php

    // session_start();
    //
    // if(($_SESSION['cuenta']['rol'] == 'A') || ($_SESSION['cuenta']['rol'] == 'B') || ($_SESSION['cuenta']['rol'] == 'C')){
    //
    //     include_once("moduloSesiones.php");
    //
    //     include_once("moduloUsuario.php");
    //
    //     if(isset($_POST["newPass"])){
    //
    //         $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
    //
    //         changePassword($_SESSION['cuenta']['id'], $hash);
    //
    //         header("location:home.php");
    //
    //     }
    //
    //     include_once("../views/_header.html");
    //
    //     include_once("../views/_changePassword.html");
    //
    //     include_once("../views/_footer.html");
    //
    // } else {
    //
    //     http_response_code(404);
    //     die();
    //
    // }

    session_start();

    include_once("moduloSesiones.php");

    include_once("moduloUsuario.php");

    if(isset($_POST["newPass"])){

        changePassword($_SESSION['cuenta']['id'], $_POST["newPass"]);

        header("location:home.php");

    }else if(isset($_GET["id"]) && isset($_GET["password"])){

      changePassword($_GET["id"], $_GET["password"]);

      header("location:home.php");

    }

    include_once("../views/_header.html");

    include_once("../views/_changePassword.html");

    include_once("../views/_footer.html");




?>
