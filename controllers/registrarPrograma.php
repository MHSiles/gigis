<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
    
        include_once("moduloSesiones.php");
    
        include_once("moduloProgramas.php");
        
        if(isset($_POST['nombrePrograma']) && isset($_POST['descripcionPrograma']) ){
            
            $progErr = (optionsDisplay($_POST["nombrePrograma"])) ? "" : "Programa Repetido.";
            
            if(!$progErr){
                
                nuevoPrograma($_POST['nombrePrograma'], $_POST['descripcionPrograma']);
                
                header("location:consultarProgramas.php");
            
            }
        }
    
        include("../views/_header.html");
    
        include("../views/_nav.html");
    
        include("../views/_registrarPrograma.html");
    
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }
?>