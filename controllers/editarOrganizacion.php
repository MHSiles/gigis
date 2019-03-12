<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
    
        include_once("moduloSesiones.php");
    
        include_once("moduloOrganizaciones.php");

        if(isset($_POST['nombreOrganizacion']) && isset($_POST['tipoOrganizacion']) && isset($_POST['passOrganizacion']) && isset($_POST['numHoras'])){
            
                guardarOrganizacion($_POST['idOrganizacion'], $_POST['nombreOrganizacion'], $_POST['tipoOrganizacion'], $_POST['passOrganizacion'], $_POST['numHoras']);
                
                header("location:consultarOrganizaciones.php");
        }
        
        include("../views/_header.html");
        
        include("../views/_nav.html");
        
        include("../views/_editarOrganizacion.html");
        
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }
    
?>