<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
        
        include_once("moduloSesiones.php");
    
        include("moduloUsuario.php");
        
        if(isset($_POST['nombreAlumno']) && isset($_POST['apellidoPaterno'])
            && isset($_POST['correoElectronico']) && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento'])){
            
            if(isset($_POST["newPass"]) ){
                
                $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
                
                guardarAdmin($_POST['idAl'], $_POST['nombreAlumno'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                            $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'], $hash);
                
            }else{
                    
                guardarAdmin($_POST['idAl'], $_POST['nombreAlumno'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                            $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'], 0);
                                
            }
            
            header("location:consultarAdmin.php");
            
        }
        
        include("../views/_header.html");
        
        include("../views/_nav.html");
        
        include("../views/_editarAdmin.html");
        
        include("../views/_footer.html");

    } else {
        
        http_response_code(404);
        die();
        
    }
?>