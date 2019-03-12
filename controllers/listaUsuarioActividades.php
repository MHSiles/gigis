<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
        
        include_once("moduloSesiones.php");
    
        include("moduloRegistros.php");
        
        if($_REQUEST["idUs"]) {
        
           $id = $_REQUEST['idUs'];
           
           echo(usuarioActividades($id));
        }
        
    } else {
        
        http_response_code(404);
        die();
        
    }
?>