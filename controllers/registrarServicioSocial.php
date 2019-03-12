<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){

        include_once("moduloSesiones.php");
    
        include_once("moduloUsuario.php");
    
        
        if(isset($_POST['nombreAlumno']) && isset($_POST['apellidoPaterno'])
            && isset($_POST['correoElectronico']) && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento'])
            && isset($_POST["organizacionSS"]) && isset($_POST["semestre"]) && isset($_POST["matricula"]) && isset($_POST["newPass"])){
                
            $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
            
            nuevoSS($_POST['nombreAlumno'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                        $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'],
                        $_POST["organizacionSS"], $_POST["semestre"], $_POST["matricula"], $hash);
        
            header("location:consultarServicioSocial.php");
        }
        
        include("../views/_header.html");
        
        include("../views/_nav.html");
    
        include("../views/_registrarServicioSocial.html");
    
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }
?>