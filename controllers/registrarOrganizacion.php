<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){

        include_once("moduloSesiones.php");
    
        include_once("moduloOrganizaciones.php");
        
        if(isset($_POST['nombreOrganizacion']) && isset($_POST['passOrganizacion']) && isset($_POST['numHoras'])){
            
            $orgErr = (optionsDisplay($_POST["nombreOrganizacion"], 0)) ? "" : "Organizacion previamente registrada.";
            
            if(!$orgErr){
                
                nuevaOrganizacion($_POST['nombreOrganizacion'], $_POST['tipoOrganizacion'], $_POST['passOrganizacion'], $_POST['numHoras']);
            
                header("location:consultarOrganizaciones.php");
            }
            
        }
        
        include("../views/_header.html");
        
        include("../views/_nav.html");
    
        include("../views/_registrarOrganizacion.html");
    
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }
?>