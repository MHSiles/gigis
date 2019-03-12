<?php

    session_start();
        
    include_once("moduloSesiones.php");

    include_once("moduloUsuario.php");
    
    $flag = false;
    $no = true;
               
    if(isset($_POST['tipoUsuario'])){
        
        if($_POST['tipoUsuario'] == "servicioSocial"){
        
            if(isset($_POST['nombreUsuario']) && isset($_POST['apellidoPaterno']) && isset($_POST['apellidoMaterno'])
                && isset($_POST['correoElectronico']) && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento'])
                && isset($_POST["organizacionSS"]) && isset($_POST["semestre"]) && isset($_POST["matricula"]) && isset($_POST["newPass"])){
                
                if(checkEmail($_POST['correoElectronico'])){
                    
                    $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
                
                nuevoSS($_POST['nombreUsuario'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                            $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'],
                            $_POST["organizacionSS"], $_POST["semestre"], $_POST["matricula"], $hash);
               
                } else {
                    
                    $flag = true;
                    
                }
                
                
            
            }
            
        }else{
            
            if(isset($_POST['nombreUsuario']) || (isset($_POST['apellidoPaterno']) && isset($_POST['correoElectronico']) 
                && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento']) && isset($_POST['ocupacionVoluntario'])
                && isset($_POST["newPass"]))){
                    
                // echo($_POST['nombreUsuario'] . $_POST['apellidoPaterno'] . $_POST['apellidoMaterno'] .
                //                 $_POST['correoElectronico'] . $_POST['telefonoCelular'] . $_POST['fechaNacimiento'] . $_POST['ocupacionVoluntario'] .
                //                 $_POST["newPass"]);
                
                if(checkEmail($_POST['correoElectronico'])) {
                    
                    $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
                
                    nuevoVoluntario($_POST['nombreUsuario'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                                $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'], $_POST['ocupacionVoluntario'],
                                $hash);
                
                    
                } else {
                    
                    $flag = true;
                    
                }
                
                
                
            }
            
        }
        
        if($flag == false) {
            
             header("location:index.php");
             
        } else {
            
            $error = 'El correo electrónico ya ha sido usado previamente, inicia sesión o regístrate con otro correo.';
            
            include("../views/_header.html");

            include("../views/_registroInicial.html");
        
            include("../views/_footer.html");
            
            $no = false;
            
        }
        
       
    }
    
    if ($no){
        include("../views/_header.html");

        include("../views/_registroInicial.html");
    
        include("../views/_footer.html");
    }
    
    

    
?>