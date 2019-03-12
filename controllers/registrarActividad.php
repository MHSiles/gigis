<?php

    session_start();
    
    if($_SESSION['cuenta']['rol'] == 'D'){
    
        include_once("moduloSesiones.php");
    
        include_once("moduloActividades.php");
    
        
    
        if (isset($_POST["programa"]) || isset($_POST['dia']) || isset($_POST['horaIn'])
        || isset($_POST['minIn']) || isset($_POST['horaFi']) || isset($_POST['minFi'])
        || isset($_POST['edadMin']) || isset($_POST['edadMax']) || isset($_POST['tipoActividad'])){     
            
            $actErr = ($_POST["programa"]) ? "<br>" : "Seleccciona una actividad";
            $diaErr = ($_POST["dia"]) ? "<br>" : "Seleccciona un dia";
            $horaInErr = ($_POST["horaIn"] && $_POST['minIn']) ? "<br>" : "Selecciona la hora de inicio";
            $horaFiErr = ($_POST["horaFi"] && $_POST['minFi']) ? "<br>" : "Seleccciona la hora de término";
            $edMinErr = ($_POST["edadMin"] >= 0) ? "<br>" : "Selecciona la edad mínima";
            $edMaxErr = ($_POST["edadMax"]) ? "<br>" : "Seleccciona la edad máxima";
            $tipoErr = ($_POST["tipoActividad"]) ? "<br>" : "Seleccciona el tipo de actividad";
            
            
            if($actErr == "<br>" && $diaErr == "<br>" && $horaInErr == "<br>" && $horaFiErr == "<br>"
            && $edMinErr == "<br>" && $edMaxErr == "<br>" && $tipoErr == "<br>"){
                
                $horaInicio = $_POST['horaIn']*100 + $_POST['minIn'];
                $horaFin = $_POST['horaFi']*100 + $_POST['minFi'];
                
                $rangHorErr = ($horaInicio < $horaFin) ? "" : "Rango de horario inválido";
                $rangEdErr = ($_POST['edadMax'] > $_POST['edadMin']) ? "" : "Rango de edad inválido";
                
                if(!$rangHorErr && !$rangEdErr){
                    
                    if($_POST["tipoActividad"] == "Individual"){
                        $alumnos = 1;
                        $colabs = 1;
                    }else{
                        $alumnos = $_POST['numeroAlumnos'];
                        $colabs = $_POST['numeroColabs'];
                    }
                    
                    nuevaActividad($_POST["programa"], $_POST["dia"],$horaInicio, $horaFin,
                    $_POST["edadMin"], $_POST["edadMax"], $_POST["tipoActividad"], $alumnos, $colabs);
                
                    header("location:consultarActividades.php");
                }
            }
            
            
        }
        include("../views/_header.html");
        
        include("../views/_nav.html");
    
        include("../views/_registrarActividad.html");
    
        include("../views/_footer.html");
        
    } else {
        
        http_response_code(404);
        die();
        
    }
?>