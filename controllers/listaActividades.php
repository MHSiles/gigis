<?php
    
    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){

        include_once("moduloSesiones.php");
    
        include("moduloActividades.php");
        
        echo (listaActividades());
    
    } else {
        
        http_response_code(404);
        die();
        
    }
?>