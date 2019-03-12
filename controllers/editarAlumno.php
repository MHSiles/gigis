<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
        
        include_once("moduloSesiones.php");
    
        include("moduloUsuario.php");
        
        if(isset($_POST['nombreAlumno']) && isset($_POST['apellidoPaterno'])
            && isset($_POST['correoElectronico']) && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento'])
            && isset($_POST["nombreTutor"]) && isset($_POST["matricula"]) ){
            
            if(isset($_POST["newPass"]) ){
                
                $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
                
                guardarAlumno($_POST['idAl'], $_POST['nombreAlumno'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                            $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'], $_POST['nombreTutor'],
                            $_POST['matricula'], $hash);
                            
                header("location:consultarAlumnos.php");
                
            }else{
                    
                guardarAlumno($_POST['idAl'], $_POST['nombreAlumno'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                            $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'], $_POST['nombreTutor'],
                            $_POST['matricula'], 0);
                                
                header("location:consultarAlumnos.php");
            }
            
        }
        
        include("../views/_header.html");
        
        include("../views/_nav.html");
        
        include("../views/_editarAlumno.html");
        
        include("../views/_footer.html");

    } else {
        
        http_response_code(404);
        die();
        
    }
?>