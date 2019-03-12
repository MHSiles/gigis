<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
        
        include_once("moduloSesiones.php");
    
        include_once("moduloProgramas.php");
        
       
        
        if(isset($_POST['nombrePrograma']) && isset($_POST['descripcionPrograma']) ){  
            
            guardarPrograma($_POST['idPrograma'], $_POST['nombrePrograma'], $_POST['descripcionPrograma']);
            
            
            
            header("location:consultarProgramas.php");
                
        }
        include("../views/_header.html");
        
        include("../views/_nav.html");
        
        include("../views/_editarPrograma.html");
        
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }

?>