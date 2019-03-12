<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
        
        include_once("moduloSesiones.php");
        
        include_once("moduloUsuario.php");
        

        if(isset($_POST['nombreVoluntario']) && isset($_POST['apellidoPaterno']) && isset($_POST['correoElectronico']) 
            && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento']) && isset($_POST['ocupacionVoluntario'])
            && isset($_POST["newPass"])){
                
            $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
                
            nuevoVoluntario($_POST['nombreVoluntario'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                            $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'], $_POST['ocupacionVoluntario'],
                            $hash);
            
            header("location:consultarVoluntarios.php");
        }
        
        include_once("../views/_header.html");
        
        include_once("../views/_nav.html");
    
        include_once("../views/_registrarVoluntario.html");
    
        include_once("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }
?>