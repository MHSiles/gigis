<?php
    
    function checked($value, $dia){
        if($value == $dia){
            return 'checked';
        }else {
            return;
        }
    }
    
    function selected($value, $nombre){
        
        if($value == $nombre){
            return 'selected';
        }else {
            return;
        }
    }
    
    
    function getNombreCiclo(){
        
        $connect = connect();
        
        $query = 'SELECT nombreCiclo FROM Ciclo';
        
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $nombre = $row['nombreCiclo'];
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $nombre;
        
    }
    
    function getIdPrograma($nombre){
        
        $connect = connect();
        
        $query = "SELECT idPrograma FROM Programa WHERE nombrePrograma='". $nombre ."'";
        
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $id = $row['idPrograma'];
                
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $id;
        
    }
    
    function getNombrePrograma($id){
        
        $connect = connect();
        
        $query = 'SELECT nombrePrograma FROM Programa WHERE idPrograma='. $id;
        
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $nombre = $row['nombrePrograma'];
            
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $nombre;
        
    }
    
    /*--------------------------------------------------------------------------------------------------------*/
    
    function displayActividades($nombre){
        
        if(!$nombre){
            
            $connect = connect();
            
            $query = 'SELECT nombrePrograma FROM Programa';
            
            $result = mysqli_query($connect, $query);
            
            $options = '<option value=""></option>';
            
            while($row = mysqli_fetch_array($result)){
                
                $options .= '<option value="'. $row["nombrePrograma"] .'">'. $row["nombrePrograma"] .'</option>';
            }
            
            mysqli_free_result($result);
            
            disconnect($connect);
        
            return $options;
            
        } else{
            
            $connect = connect();
            
            $query = 'SELECT nombrePrograma FROM Programa';
            
            $result = mysqli_query($connect, $query);
            
            $options;
            
            while($row = mysqli_fetch_array($result)){
                
                $options .= '<option value="'. $row["nombrePrograma"] .'" '. selected($row["nombrePrograma"], $nombre) .'>'. $row["nombrePrograma"] .'</option>';
            }
            
            mysqli_free_result($result);
            
            disconnect($connect);
        
            return $options;
            
        }
    }
    
    function displayDias($selectedDay){
        
        $dias = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
            
        $options = '<option value="" disabled selected></option>';
        
        if(!$selectedDay){
            
            foreach ($dias as $dia){
                
                $options.= '<option value="'. $dia .'">'. $dia .'</option>';
            }
            
        }else{
            
            foreach ($dias as $dia){
                
                $options.= '<option value="'. $dia .'" '. selected($dia, $selectedDay) .'>'. $dia .'</option>';
            }
            
        }
        
        return $options;
        
    }
    
    
    function displayEdades($min, $max, $value){
        
        
        if(!$value){
            
            $options = "<option value='0' selected>0</option>";
            while($min <= $max){
                $options.= '<option value="'. $min .'">'. $min .'</option>';
                $min++;
            }
            
            return $options;
            
        } else {
            
            $options;
            
            while($min <= $max){
                $options.= '<option value="'. $min .'" '. selected($min, $value) .'>'. $min .'</option>';
                $min++;
            }
            
            return $options;
        }
        
    }
    
    
    
    function displayNumAlumnos($min, $max, $value){
        
        
        if(!$value){
            
            $options = "<option value='1' selected>1</option>";
            while($min <= $max){
                $options.= '<option value="'. $min .'">'. $min .'</option>';
                $min++;
            }
            
            return $options;
            
        }else{
            
            $options;
            $min--;
            while($min <= $max){
                $options.= '<option value="'. $min .'" '. selected($min, $value) .'>'. $min .'</option>';
                $min++;
            }
            
            return $options;
        }
        
    }
    
    
    
    function displayNumColabs($min, $max, $value){
        
        
        if(!$value){
            
            $options = "<option value='1' selected>1</option>";
            while($min <= $max){
                $options.= '<option value="'. $min .'">'. $min .'</option>';
                $min++;
            }
            
            return $options;
            
        }else{
            
            $options;
            $min--;
            while($min <= $max){
                $options.= '<option value="'. $min .'" '. selected($min, $value) .'>'. $min .'</option>';
                $min++;
            }
            
            return $options;
        }
        
    }
    
    
    function displayTipoActividad($tipo){
        
        $options = "<option value='' disabled selected></option>";
        
        if(!$tipo){
            
            $options .= '<option value="Individual">Individual</option>
                        <option value="Grupal">Grupal</option>';
            
        }else{
            
            $options .= '<option value="Individual" '. selected("Individual", $tipo) .'>Individual</option>
                        <option value="Grupal" '. selected("Grupal", $tipo) .'>Grupal</option>';
            
        }
        
        return $options;
        
    }
    
    function listaActividades(){
        
        $connect = connect();
        
        $table = '<div class="container paddingTop">
                    <div class="row">
                        <div class="col s0 m0 l1"></div>
                        <div class="col s12 m12 l10">
                            <ul class="collection with-header z-depth-2">';
        
        $dias = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
        
        foreach ($dias as $dia){
            
            $query = "SELECT A.idActividad, P.nombrePrograma, A.horaInicio, A.horaFin, A.edadMin, A.edadMax,
                    A.tipoActividad, A.cupoAlumnos, A.cupoColaboradores
                    FROM Actividad A, Programa P
                    WHERE A.idPrograma = P.idPrograma
                    AND A.dia = '". $dia ."'
                    ORDER BY A.horaInicio";
                    
            $result = mysqli_query($connect, $query);
                            
            $table.=    '<li class="collection-header center" style="background-color:#CCEEF3">
                            <h5><strong>'. $dia .'</strong></h5>
                        </li>';
            
            $tabla = "Actividad";
            
            while($row = mysqli_fetch_array($result)){
                
                $minIn = $row['horaInicio'] % 100;
                $horaIn = ($row['horaInicio']-$minIn)/100;
                if($horaIn < 10){
                    $horaIn  = '0' . $horaIn;
                }
                if($minIn == 0){
                    $minIn = '00';
                }
                
                $minFi = $row['horaFin'] % 100;
                $horaFi = ($row['horaFin']-$minFi)/100;
                if($horaFi < 10){
                    $horaFi  = '0' . $horaFi;
                }
                if($minFi == 0){
                    $minFi = '00';
                }
                
                $table.= '<li class="collection-item avatar">
                            <span class="title"><h5>'. $row['nombrePrograma'] .'</h5><span>
                            <p>
                                Horario: '. $horaIn .':'. $minIn .' - '. $horaFi .':'. $minFi .'
                                <br>
                                Rango de edades: '. $row['edadMin'] .' - '. $row['edadMax'] .' años
                                <br>
                                Tipo de Actividad: <strong>'. $row['tipoActividad'] .'</strong>
                                <br>
                                Cupo de Alumnos: ' . $row['cupoAlumnos'] . '
                                <br>
                                Cupo de Colaboradores: ' . $row['cupoColaboradores'] ;
                                
                $table.= "      <a href='editarActividad.php?id=" . $row["idActividad"] . "'><i class='material-icons right '>mode_edit</i></a>
                                <a><i class='material-icons right' style='cursor:pointer' 
                                onclick=borrarItem(". $row['idActividad'] .",'". $tabla ."')>delete</i></a>
                            </p>
                        </li>";
            }
        }
        
        $table.=            '</ul>
                        </div>
                        <div class="col s0 m0 l1"></div>
                    </div>
                </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $table;
        
        
    }
    
    
    
    
    function nuevaActividad($programa, $dia, $horaInicio, $horaFin, $edMin, $edMax, $tipo, $alum, $colabs){
        
        
        $ciclo = getNombreCiclo();
        
        $idPrograma = getIdPrograma($programa);
        
        // $horaInicio = $horaI*100 + $minI;
        
        // $horaFin = $horaF*100 + $minF;
        
        $connect = connect();
            
        $query='INSERT INTO Actividad (dia, horaInicio, horaFin, edadMin, edadMax, tipoActividad,
        nombreCiclo, idPrograma, cupoAlumnos, cupoColaboradores) VALUES (?,?,?,?,?,?,?,?,?,?) ';
        // Preparing the statement 
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        
        // Binding statement params 
        if (!$statement->bind_param("ssssssssss", $dia, $horaInicio, $horaFin, $edMin, $edMax, $tipo, $ciclo, $idPrograma, $alum, $colabs)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
        }
        
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }
            
        
        disconnect($connect);
    }
    
    
    
    function editarActividad($id){
        
        
        $connect = connect();
        
        $query = 'SELECT * FROM Actividad WHERE idActividad ='. $id;
        
        $result = mysqli_query($connect, $query);
        
        $form = '<nav id="titulo" class="cyan">
                        <div class="container">
                          <div class="nav-wrapper"><a class="page-title">EDITAR ACTIVIDAD </a></div>
                        </div>
                </nav>
                
                <a class="btn-large cyan top btn-flat"><i class="material-icons cwhite" onclick="goBack()">arrow_back</i></a>
                
                <div class="center-align">
                    <br><br><br>';
        
        
        while($row = mysqli_fetch_array($result)){
            
            $nombre = getNombrePrograma($row['idPrograma']);
            
            $form .= '<form action="editarActividad.php?id='. $row['idActividad'] .'" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col s0 m2 l3"></div>
                            <div class="col s12 m5 l4">
                                <label>
                                    Actividad
                                </label>
                                <input id="icon_prefix" type="number" name="idActividad" class="validate" value='.$row["idActividad"].' hidden>
                                <select name="programa">
                                    '. displayActividades($nombre) .'
                                </select>
                            </div>
                            <div class="col s12 m3 l2">
                                <label>
                                    Día
                                </label>
                                <select name="dia">
                                    '. displayDias($row['dia']) .'
                                </select>
                            </div>
                            <div class="col s0 m2 l3"></div>
                        </div>';
            
            $form.= '<div class="row">
                        <div class="col s2 m2 l4"></div>
                        <div class="col s4 m4 l2">
                            <label>
                                Hora Inicio
                            </label>
                        </div>
                        <div class="col s4 m4 l2">
                            <label>
                                Hora Termino
                            </label>
                        </div>
                        <div class="col s2 m2 l4"></div>
                    </div>';
            
            $minIn = $row['horaInicio'] % 100;
            $horaIn = ($row['horaInicio']-$minIn)/100;
            
            $minFi = $row['horaFin'] % 100;
            $horaFi = ($row['horaFin']-$minFi)/100;
            
            $form .= '<div class="row">
                        <div class="col s2 m2 l4"></div>
                        <div class="col s2 m2 l1">
                             <input style="text-align:center" type="number" id="horaIn" name="horaIn" min="7" max="21" value="'. $horaIn .'"/>
                        </div>
                        <div class="col s2 m2 l1">
                            <input style="text-align:center" type="number" id="minIn" name="minIn" min="0" max="59" value="'. $minIn .'"/>
                        </div>
                        <div class="col s2 m2 l1">
                            <input style="text-align:center" type="number" id="horaFi" name="horaFi" min="7" max="21" value="'. $horaFi .'"/>
                        </div>
                        <div class="col s2 m2 l1">
                            <input style="text-align:center" type="number" id="minFi" name="minFi" min="0" max="59" value="'. $minFi .'"/>
                        </div>
                        <div class="col s2 m2 l4"></div>
                    </div>';
            
            
            
            $form .= '<div class="row">
                        <div class="col s0 m2 l3"></div>
                        <div class="col s12 m4 l3">
                            <label>
                                Edad Minima
                            </label>
                            <select name="edadMin">
                                '. displayEdades(1, 60, $row['edadMin']) .'
                            </select>
                        </div>
                        <div class="col s12 m4 l3">
                            <label>
                                Edad Máxima
                            </label>
                            <select name="edadMax">
                                '. displayEdades(1, 80, $row['edadMax']) .'
                            </select>
                        </div>
                        <div class="col s0 m2 l3"></div>
                    </div>';
                        
                        
            $form .='<div class="row">
                        <div class="col s0 m2 l3"></div>
                        <div class="col s12 m8 l6">
                            <label>
                                Tipo de Actividad
                            </label>
                            <select name="tipoActividad" id="tipoActividad">
                                '. displayTipoActividad($row['tipoActividad']) .'
                            </select>
                        </div>
                        <div class="col s0 m2 l3"></div>
                    </div>';
            
            $form .= '<div class="involucrados">
                        <div class="row">
                            <div class="col s0 m2 l3"></div>
                            <div class="col s12 m4 l3">
                                <label>
                                    Cupo de Alumnos
                                </label>
                                <select name="numeroAlumnos">
                                    '. displayNumAlumnos(2,100,$row['cupoAlumnos']) .'
                                </select>
                            </div>
                            <div class="col s12 m4 l3">
                                <label>
                                    Cupo de Colaboradores
                                </label>
                                <select name="numeroColabs">
                                    '. displayNumColabs(2,20,$row['cupoColaboradores']) .'
                                </select>
                            </div>
                            <div class="col s0 m2 l3"></div>
                        </div>
                    </div>';
        }
        
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $form;
    }


    
    function guardarActividad($id, $programa, $dia, $horaInicio, $horaFin, $edMin, $edMax, $tipo, $alum, $colab){
        
        $connect = connect();
        
        $query="UPDATE Actividad SET dia=?, horaInicio=?, horaFin=?, edadMin=?, edadMax=?,
        tipoActividad=?, nombreCiclo=?, idPrograma=?, cupoAlumnos=?, cupoColaboradores=? WHERE idActividad=?";
        
        $ciclo = getNombreCiclo();
        
        $idPrograma = getIdPrograma($programa);
        
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        
        // Binding statement params 
        if (!$statement->bind_param("sssssssssss", $dia, $horaInicio, $horaFin, $edMin, $edMax, $tipo, $ciclo, $idPrograma, $alum, $colab, $id)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
        }
        
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        } 
          
        // var_dump($statement);
        
        disconnect($connect);
    }



    function eliminarActividad($id){
        
        
        $connect = connect();
        
        $query = "DELETE FROM Actividad WHERE idActividad=" . $id;
        
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
        
        if ($connect->query($query) === FALSE) {
            echo "Error deleting record: " . $connect->error;
        }
        
        disconnect($connect);
    
        
    }
    
    
    
    /*-------------------------------------USUARIOS REGISTRADOS POR ACTIVIDAD---------------------------------------------*/
    function listaRegistroActividades(){
        
        $connect = connect();
        
        $table = '<ul class="collection with-header">';
        
        $dias = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
        
        foreach ($dias as $dia){
            
            $query = "SELECT A.idActividad, P.nombrePrograma, A.horaInicio, A.horaFin, A.edadMin, A.edadMax,
                    A.tipoActividad, A.cupoAlumnos, A.cupoColaboradores
                    FROM Actividad A, Programa P
                    WHERE A.idPrograma = P.idPrograma
                    AND A.dia = '". $dia ."'
                    ORDER BY A.horaInicio";
                    
            $result = mysqli_query($connect, $query);
                            
            $table.=    '<br>
                        <label><h5>&nbsp &nbsp'. $dia .'</h5></label>
                        <ul class="collapsible" data-collapsible="expandable">';
            
            $tabla = "Actividad";
            
            while($row = mysqli_fetch_array($result)){
                
                $minIn = $row['horaInicio'] % 100;
                $horaIn = ($row['horaInicio']-$minIn)/100;
                if($horaIn < 10){
                    $horaIn  = '0' . $horaIn;
                }
                if($minIn == 0){
                    $minIn = '00';
                }
                
                $minFi = $row['horaFin'] % 100;
                $horaFi = ($row['horaFin']-$minFi)/100;
                if($horaFi < 10){
                    $horaFi  = '0' . $horaFi;
                }
                if($minFi == 0){
                    $minFi = '00';
                }
                
                $alumnosInscritos = countUsuarios($row['idActividad'], "A");
                $colabsInscritos = countUsuarios($row['idActividad'], "B") + countUsuarios($row['idActividad'], "C");
                
                $nombresAlumnos = getNombres($row['idActividad'], "A");
                $nombresColabs = getNombres($row['idActividad'], "B") . getNombres($row['idActividad'], "C");
                
                $table .= '      <li>
                                    <div class="collapsible-header">
                                        '. $row['nombrePrograma'] .' <strong>('. $row['tipoActividad'] .')</strong>
                                        <br>
                                        <strong>'. $horaIn .':'. $minIn .' - '. $horaFi .':'. $minFi .'</strong> | 
                                        '. $row['edadMin'] .' - '. $row['edadMax'] .' años | 
                                        Alumnos Inscritos: '. $alumnosInscritos .'/' . $row['cupoAlumnos'] . ' |
                                        Colaboradores Inscritos: '. $colabsInscritos .'/' . $row['cupoColaboradores'] .'
                                    </div>
                                    <div class="collapsible-body">
                                        <strong>Alumnos</strong>
                                            <br>
                                            '. $nombresAlumnos .'
                                        <br>
                                        <strong>Colaboradores</strong>
                                            <br>
                                            '. $nombresColabs .'
                                    </div>
                                </li>';
            }
            
            $table .= '</ul>';
        }
        
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $table;
        
        
    }
    
    function countUsuarios($idActividad, $rol){
        
        $connect = connect();
        
        $query =    "SELECT COUNT(idActividad) as 'Total'
                    FROM  UsuarioActividad UA, Usuario U
                    WHERE UA.idUsuario = U.idUsuario
                    AND U.idRoles = '". $rol ."'
                    AND idActividad = " . $idActividad;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            $total = $row['Total'];
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $total;
    }
    
    
    function getNombres($idActividad, $rol){
        
        $connect = connect();
        
        $query =    "SELECT U.Nombre, U.ApellidoPaterno, U.ApellidoMaterno
                    FROM  UsuarioActividad UA, Usuario U
                    WHERE UA.idUsuario = U.idUsuario
                    AND U.idRoles = '". $rol ."'
                    AND UA.idActividad = " . $idActividad;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            $lista .= $row['Nombre'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . "<br>";
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $lista;
    }
    
  
    
?>