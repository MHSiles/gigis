<?php
    
    session_start();

    
    if(isset($_SESSION['cuenta'])){
        
        include_once("moduloSesiones.php");
        
        include_once("moduloCiclo.php");
        
        include("../views/_header.html");
        
        include("../views/_navLogOut.html");
        
        if($_SESSION['cuenta']['rol'] == 'D'){
            
            include("../views/_nav.html");
            
        } else {
            
            if ($_SESSION['cuenta']['rol'] == 'B'){
               $org = getInstitution($_SESSION['cuenta']['id']);
            }
            
            if ($_SESSION['cuenta']['rol'] == 'A'){
               $al = getStudentInfo($_SESSION['cuenta']['id']);
            }
            
            include("../views/_navUsuario.html");
            
        }
    
        include("../views/_consultarCiclo.html");
    
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
    }
    
?>