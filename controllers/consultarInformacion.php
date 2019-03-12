<?php

    session_start();
    
    if(isset($_SESSION['cuenta'])){
    
        include_once("moduloSesiones.php");
    
        include_once("moduloInformacion.php");
    
        include("../views/_header.html");
        
        include("../views/_navLogOut.html");
        
        include("../views/_nav.html");
    
        include("../views/_consultarInformacion.html");
    
        include("../views/_footer.html");
    
    } else {
        
        http_response_code(404);
        die();
        
    }
    
?>