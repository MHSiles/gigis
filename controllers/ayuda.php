<?php

    session_start();

    include_once("moduloSesiones.php");
    
    include_once("moduloProgramas.php");

    include("../views/_header.html");
    
    include("../views/_navLogOut.html");
    
    if ($_SESSION['cuenta']['rol'] == 'D'){
        
        include("../views/_nav.html");
        
    }elseif(($_SESSION['cuenta']['rol'] == 'A') || ($_SESSION['cuenta']['rol'] == 'B' || ($_SESSION['cuenta']['rol'] == 'C'))){
        
        if ($_SESSION['cuenta']['rol'] == 'B'){
           $org = getInstitution($_SESSION['cuenta']['id']);
        }
        
        if ($_SESSION['cuenta']['rol'] == 'A'){
           $al = getStudentInfo($_SESSION['cuenta']['id']);
        }
        
        include("../views/_navUsuario.html");
    }
    include("../views/_ayuda.html");
    include("../views/_footer.html");
?>