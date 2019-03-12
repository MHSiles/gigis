<?php

    session_start();
    
    if(($_SESSION['cuenta']['rol'] == 'A') || ($_SESSION['cuenta']['rol'] == 'B') || ($_SESSION['cuenta']['rol'] == 'C') || ($_SESSION['cuenta']['rol'] == 'D')){
        
        include_once("moduloSesiones.php");
    
        include_once("moduloRegistros.php");
        
        if(isset($_REQUEST['idAc']) && isset($_REQUEST['idUsr'])){
            
            if($_REQUEST['accion'] == 1){
                
                $result = nuevoRegistro($_REQUEST['idUsr'], $_REQUEST['idAc']);
                
                echo $result;
                
            }else{
                
                eliminarRegistro($_REQUEST['idUsr'], $_REQUEST['idAc']);
                
            }
            
        }
    
    }else{
        
        http_response_code(404);
        die();
    }

    // session_start();
    
    // if($_SESSION['cuenta']['rol'] == 'D'){
        
    //     include_once("moduloSesiones.php");
    
    //     include_once("moduloRegistros.php");
    
    //     include("../views/_header.html");
        
    //     include("../views/_nav.html");
        
    //     if(isset($_POST["alumnoSeleccionado"])){
            
    //         $idUsuario = $_POST["alumnoSeleccionado"];
            
    //     }else if(isset($_POST["voluntarioSeleccionado"])){
            
    //         $idUsuario = $_POST["voluntarioSeleccionado"];
            
    //     }else if(isset($_POST["servicioSocialSeleccionado"])){
            
    //         $idUsuario = $_POST["servicioSocialSeleccionado"];
            
    //     }
        
    //     include("../views/_inscribirActividadUsuario.html");
        
    //     include("../views/_footer.html");
        
    // } else {
        
    //     http_response_code(404);
    //     die();
        
    // }

?>