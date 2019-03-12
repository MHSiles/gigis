<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
    
        include_once("moduloSesiones.php");
    
        include_once("moduloActividades.php");
        
       
        
        if(isset($_POST["programa"]) && isset($_POST['dia']) && isset($_POST['horaIn'])
        && isset($_POST['minIn']) && isset($_POST['horaFi']) && isset($_POST['minFi'])
        && isset($_POST['edadMin']) && isset($_POST['edadMax']) && isset($_POST['tipoActividad'])){  
    
    
            $horaInicio = $_POST['horaIn']*100 + $_POST['minIn'];
            $horaFin = $_POST['horaFi']*100 + $_POST['minFi'];
            
            if($horaFin > $horaInicio){
                
                if($_POST['edadMax'] > $_POST['edadMin']){
                    
                    if($_POST["tipoActividad"] == "Individual"){
                        $alumnos = 1;
                        $colabs = 1;
                    }else{
                        $alumnos = $_POST['numeroAlumnos'];
                        $colabs = $_POST['numeroColabs'];
                    }
                    
                    guardarActividad($_POST['idActividad'], $_POST["programa"], $_POST["dia"], $horaInicio,
                     $horaFin, $_POST["edadMin"], $_POST["edadMax"], $_POST["tipoActividad"], $alumnos, $colabs);
                    
                    header("location:consultarActividades.php");
                
                }else{
                
                    $camposErr = "Campos vacíos o erroneos.";
                }
                
            }else{
              
                $camposErr = "Campos vacíos o erroneos.";
            }
        
        }else{
            
            //$camposErr = "Campos vacíos o erroneos.";
        }
        
        
        
        //include("../views/_nav.html");
         include("../views/_header.html");
        
        include("../views/_editarActividad.html");
        
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }

?>