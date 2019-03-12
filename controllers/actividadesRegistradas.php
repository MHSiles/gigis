<?php

    session_start();
    
    if(($_SESSION['cuenta']['rol'] != 'D')){
        
        include_once("moduloSesiones.php");
        
        include("moduloRegistros.php");
        
        if ($_SESSION['cuenta']['rol'] == 'B'){
           $org = getInstitution($_SESSION['cuenta']['id']);
        }
        
        if ($_SESSION['cuenta']['rol'] == 'A'){
           $al = getStudentInfo($_SESSION['cuenta']['id']);
        }
        
        include("../views/_header.html");
        
        include("../views/_navUsuario.html");
        
        include("../views/_navLogOut.html");
    
        include("../views/_actividadesRegistradas.html");
        
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }

?>