<?php
    
    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
    
        include_once("moduloSesiones.php");
    
        include("moduloUsuario.php");
        
        
        
        if(isset($_POST['nombreVoluntario']) && isset($_POST['apellidoPaterno'])
            && isset($_POST['correoElectronico']) && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento'])
            && isset($_POST['ocupacionVoluntario']) ){
            
            if(isset($_POST["newPass"]) ){
                
                $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
                
                guardarVoluntario($_POST['idVol'], $_POST['nombreVoluntario'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                            $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'], $_POST['ocupacionVoluntario'],
                            $hash);
                            
                header("location:consultarVoluntarios.php");
                
            }else{
                    
                guardarVoluntario($_POST['idVol'], $_POST['nombreVoluntario'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                            $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'], $_POST['ocupacionVoluntario'],
                            0);
                                
                header("location:consultarVoluntarios.php");
            }
            
        }
        
        include("../views/_header.html");
        
        include("../views/_nav.html");
        
        include("../views/_editarVoluntario.html");
        
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }

?>