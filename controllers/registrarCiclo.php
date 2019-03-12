<?php
    
    session_start();
    
    if($_SESSION['cuenta']['rol'] == "D"){    
    
        include_once("moduloSesiones.php");
    
        include_once("moduloCiclo.php");
        
        if(isset($_POST['nombreCiclo']) && isset($_POST['fechaInicio']) && isset($_POST['fechaTermino'])){
            
            guardarCiclo($_POST['fechaInicio'], $_POST['fechaTermino'], $_POST['nombreCiclo']);
            
        }
    
        include("../views/_header.html");
        
        include("../views/_nav.html");
    
        include("../views/_registrarCiclo.html");
    
        include("../views/_footer.html");
    
    }else{
        
        http_response_code(404);
        die();
    }
    
?>