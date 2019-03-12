<?php
    
    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
    
        include_once("moduloSesiones.php");
        
        
        if(isset($_POST['nombreAdmin']) && isset($_POST['apellidoPaterno']) && isset($_POST["apellidoMaterno"])
            && isset($_POST['correoElectronico']) && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento'])
            && isset($_POST["newPass"])){
                
            $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);
            
            nuevoAdmin($_POST['nombreAdmin'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                        $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'],
                        $hash);
        
            header("location:consultarAdmin.php");
            
            
            
        }
        
        include_once("../views/_header.html");
        
        include("../views/_nav.html");
    
        include("../views/_registrarAdmin.html");
    
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }
?>