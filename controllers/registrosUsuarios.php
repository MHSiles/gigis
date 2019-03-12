<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){

        include("moduloSesiones.php");
    
        include("moduloRegistros.php");
    
        include("../views/_header.html");
    
        include("../views/_nav.html");
        
        include("../views/_navLogOut.html");
    
        // if(isset($_POST['idUsuario'])){
            
        //     if(isset($_POST['registrosAct'])){
            
        //         checkRegistros($_POST['idUsuario'], $_POST['registrosAct']);
        //     }else{
                
        //         emptyRegisters($_POST['idUsuario']);
        //     }
        // }
        
        
    
        include("../views/_registrosUsuarios.html");
        
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }

?>