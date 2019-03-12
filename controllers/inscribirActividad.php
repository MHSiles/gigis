<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
        
        include_once("moduloSesiones.php");
    
        include_once("moduloRegistros.php");
        
        include_once("moduloCiclo.php");
    
        include("../views/_header.html");
        
        //include("../views/_nav.html");
        
        if(isset($_POST["alumnoSeleccionado"])){
            
            $idUsuario = $_POST["alumnoSeleccionado"];
            
        }else if(isset($_POST["voluntarioSeleccionado"])){
            
            $idUsuario = $_POST["voluntarioSeleccionado"];
            
        }else if(isset($_POST["servicioSocialSeleccionado"])){
            
            $idUsuario = $_POST["servicioSocialSeleccionado"];
            
        }
        
        include("../views/_inscribirActividad.html");
        
        include("../views/_footer.html");
        
    }else if(($_SESSION['cuenta']['rol'] == 'A') || ($_SESSION['cuenta']['rol'] == 'B' || ($_SESSION['cuenta']['rol'] == 'C'))){
        
        include_once("moduloSesiones.php");
    
        include_once("moduloRegistros.php");
        
        include_once("moduloCiclo.php");
        
        if(getFechaInicio()){
            
            include("../views/_header.html");
        
            include("../views/_nav.html");
            
            $idUsuario = $_SESSION['cuenta']['id'];
            
            if($_SESSION['cuenta']['rol'] == 'B'){
                
                $numActividades = getTipoOrganizacion($idUsuario);
            }
            
            include("../views/_inscribirActividad.html");
            
            include("../views/_footer.html");
            
        }else{
            
            http_response_code(404);
            die();
        }
        
    }else {
        
        http_response_code(404);
        die();
        
    }

?>