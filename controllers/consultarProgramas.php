<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
        
        include_once("moduloSesiones.php");
    
        include_once("moduloProgramas.php");
        
        include("../views/_header.html");
        
        include("../views/_navLogOut.html");
        
        include("../views/_nav.html");
    
        include("../views/_consultarProgramas.html");
        
        include("../views/_footer.html");
    
    } else {
        
        http_response_code(404);
        die();
        
    }
?>