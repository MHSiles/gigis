<?php

    session_start();
    session_unset();
    session_destroy();
    
    session_start();

    include_once("moduloSesiones.php");

    include("../views/_header.html");
    
    if(isset($_POST['usuario']) && isset($_POST['password'])){
        
        login($_POST['usuario'], $_POST['password']);
        
    }

    include("../views/_iniciarSesion.html");

    include("../views/_footer.html");
?>