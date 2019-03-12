<?php 
  

    function listaUsuariosRol($rol){
        
        $connect = connect();
        
        $query =    "SELECT Nombre, ApellidoPaterno, ApellidoMaterno, idUsuario
                    FROM Usuario
                    WHERE idRoles = '". $rol . "'
                    ORDER BY ApellidoPaterno";
        
        $result = mysqli_query($connect, $query);
        
        $options = "<option value='' disabled selected>Selecciona una opción</option>";
        
        while($row = mysqli_fetch_array($result)){
            
            // $options .= "HOLA";
            
            $options .= '<option value="'. $row['idUsuario']  .'"> ' . $row['ApellidoPaterno'] .' ' . $row['ApellidoMaterno'] .' '. $row['Nombre']  . '</option>';
            
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $options;
        
        
    }
    
    function usuarioActividades($id){
        
        $connect = connect();
        
        $dias = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
        
        foreach($dias as $dia){
            
            $query =    "SELECT P.nombrePrograma, A.dia, A.horaInicio, A.horaFin, A.tipoActividad
                        FROM Actividad A, Programa P, UsuarioActividad UA
                        WHERE A.idActividad = UA.idActividad
                        AND A.idPrograma = P.idPrograma
                        AND UA.idUsuario = ". $id ."
                        AND A.dia = '". $dia ."'
                        ORDER BY A.horaInicio";
        
            $result = mysqli_query($connect, $query);
            
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
                
                $cards .=   '<div class="card horizontal  blue lighten-4">
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <h5>'. $row['nombrePrograma'] .'</h5><strong>'. $row['dia'] .'</strong>
                                        <br>
                                        '. $horaIn.':'. $minIn.' - '. $horaFi.':'. $minFi.'
                                        <br>
                                        '. $row['tipoActividad'] .'
                                        <br>
                                    </div>
                                </div>    
                            </div>';
                    
            }
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $cards;
    }
    
    
    function displayActividadesDisponibles($id){
        
        $connect = connect();
        
        $rol = getRol($id);
        
        $edad = getEdad($id);
        
        $dias = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
        
        $registradas = 0;
        
        foreach ($dias as $dia){
            
            if($rol == "A"){
                
                $query = "SELECT A.idActividad, P.nombrePrograma, A.horaInicio, A.horaFin, A.edadMin, A.edadMax,
                        A.tipoActividad, A.cupoAlumnos as 'Cupo'
                        FROM Actividad A, Programa P
                        WHERE A.idPrograma = P.idPrograma
                        AND A.dia = '". $dia ."'
                        AND ". $edad ." BETWEEN A.edadMin AND A.edadMax
                        ORDER BY A.horaInicio";
                        
            }else if($rol == "C"){
                
                $query = "SELECT A.idActividad, P.nombrePrograma, A.horaInicio, A.horaFin, A.edadMin, A.edadMax,
                        A.tipoActividad, A.cupoColaboradores as 'Cupo'
                        FROM Actividad A, Programa P
                        WHERE A.idPrograma = P.idPrograma
                        AND A.dia = '". $dia ."'
                        ORDER BY A.horaInicio";
                
            }else if($rol == "B"){
                
                $query = "SELECT A.idActividad, P.nombrePrograma, A.horaInicio, A.horaFin, A.edadMin, A.edadMax,
                        A.tipoActividad, A.cupoColaboradores as 'Cupo'
                        FROM Actividad A, Programa P
                        WHERE A.idPrograma = P.idPrograma
                        AND A.dia = '". $dia ."'
                        AND A.tipoActividad = 'Grupal'
                        ORDER BY A.horaInicio";
                
            }
   
            
            $result = mysqli_query($connect, $query);
            
            $num = 0;
            
            while($row = mysqli_fetch_array($result)){
                
                $checked = registrada($id, $row['idActividad']);
                
                $cupo = 0;
                
                if($checked){
                    
                    $cupo++;
                }
                
                $cupo += $row['Cupo'] - cupoXActividad($row['idActividad'], $rol);
                
                if($cupo > 0){
                    
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
                    
                    $table.= '<tr  style="border-bottom:1pt solid lightgray">';
                    
                    $table .= '<td rowspan="'. $sum .'">'. $dia .'</td>';
                    
                    if(registrada2($id, $row["idActividad"])){
                        
                        $addBtnHidden = "hidden";
                        $doneBtnHidden = "";
                        $registradas++;
                        
                    }else{
                        
                        $addBtnHidden = "";
                        $doneBtnHidden = "hidden";
                        
                    }
                    
                    $table.= '  <td>'. $row['nombrePrograma'] .'</td>
                                <td>'. $horaIn .':'. $minIn .' - '. $horaFi .':'. $minFi .'</td>
                                <td>'. $row['tipoActividad'] .'</td>
                                <td>'. $cupo .'</td>
                                <td>
                                
                                    <div id="addBtn'. $row["idActividad"] .'" '. $addBtnHidden .'>
                                        <a class="btn-floating btn-large waves-effect waves-light blue tooltipped" 
                                        data-position="top" data-delay="5" data-tooltip="Registrar" 
                                        onclick="idAgregarActividad('. $row['idActividad'] .', '. $id .', '. getTipoOrganizacion($id) .')">
                                            <i class="material-icons">add</i>
                                        </a>
                                    </div>
                                    
                                    <div id="doneBtn'. $row["idActividad"] .'" '. $doneBtnHidden .'>
                                        <a class="btn-floating btn-large waves-effect waves-light green accent-3 tooltipped" 
                                        data-position="right" data-delay="50" data-tooltip="Actividad Registrada"
                                        onclick="idAgregarActividad('. $row['idActividad'] .', '. $id .', '. getTipoOrganizacion($id) .')">
                                            <i class="material-icons">done</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>';
                    
                }
                
            }
            
        }
        
        $table .=       '</tbody>
                    </table>
                    
                    <input type="number" name="actividadesRegistradas" value="'. $registradas .'" id="numeroDeRegistros" hidden/>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $table;
        
    }
    
    
    function getTipoOrganizacion($id){
        
        $connect = connect();
                    
        $query =    "SELECT O.tipoOrganizacion
                    FROM Usuario U, UsuarioOrganizacion UO, Organizacion O
                    WHERE U.idUsuario = UO.idUsuario
                    AND UO.idOrganizacion = O.idOrganizacion
                    AND U.idUsuario = ". $id;
        
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $tipo = $row['tipoOrganizacion'];
            
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        if(!$tipo){
            return 2;
        }
        
        return $tipo;
        
    }
    
    
    function cupoXActividad($idActividad, $rol){
        
        $connect = connect();
        
        if($rol == "A"){
            $query =    "SELECT COUNT( idActividad ) AS  'Total'
                        FROM UsuarioActividad UA, Usuario U
                        WHERE UA.idUsuario = U.idUsuario
                        AND U.idRoles =  'A'
                        AND idActividad = " . $idActividad;
        }else{
            
            $query =    "SELECT COUNT( idActividad ) AS  'Total'
                        FROM UsuarioActividad UA, Usuario U
                        WHERE UA.idUsuario = U.idUsuario
                        AND (U.idRoles =  'B' OR U.idRoles = 'C')
                        AND idActividad = " . $idActividad;
            
        }
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)) {
            
            $numero = $row['Total'];
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $numero;
        
    }
    
    
    function registrada($idUsuario, $idActividad){
        
        $connect = connect();
        
        $query =    "SELECT idActividad
                    FROM UsuarioActividad
                    WHERE idUsuario = ". $idUsuario;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            if($row['idActividad'] == $idActividad){
                
                mysqli_free_result($result);
        
                disconnect($connect);
                
                return "checked";
            }
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return "";
    }
    
    function registrada2($idUsuario, $idActividad){
        
        $connect = connect();
        
        $query =    "SELECT idActividad
                    FROM UsuarioActividad
                    WHERE idUsuario = ". $idUsuario;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            if($row['idActividad'] == $idActividad){
                
                mysqli_free_result($result);
        
                disconnect($connect);
                
                return 1;
            }
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return 0;
    }
    
    
    
    
    //----------------------------------ACTIVIADES------------------------------------------//
    
    function nuevoRegistro($idUsuario, $idActividad){
        
        $connect = connect();
        
        $query =    "SELECT A.dia, A.horaInicio, A.horaFin
                    FROM Actividad A, UsuarioActividad UA
                    WHERE A.idActividad = UA.idActividad
                    AND UA.idUsuario =" . $idUsuario;
                    
        $result = mysqli_query($connect, $query);
        
                    
        $query2 =   "SELECT A.dia, A.horaInicio, A.horaFin
                    FROM Actividad A
                    WHERE A.idActividad = " . $idActividad;
        
        $result2 = mysqli_query($connect, $query2);
        
        
        $flag = true;
        
        while($row2 = mysqli_fetch_array($result2)){
            
            while(  ( $row = mysqli_fetch_array($result) ) && $flag){
            
                if($row2['dia'] == $row['dia']){
                    
                    // return "COINCIDEN " . $row2['dia'] . " " . $row['dia'];
                    
                    if( $row2['horaInicio'] > $row['horaInicio'] ){
                        
                        $flag = ($row2['horaInicio'] >= $row['horaFin']) ?  true : false ;
                        
                        // return "Empalme";
                        
                        // if( $row2['A.horaInicio'] < $row['A.horaFin'] ){
                        //     $flag = false;
                        // }
                    }else if( $row2['horaFin'] > $row['horaInicio'] ){
                        
                        $flag = false;
                        
                        return "Empalme 2";
                    }
                }
            }
            
        }
        
        
        // return "NADA";
        mysqli_free_result($result);
        
        mysqli_free_result($result2);
                
        if($flag){
            
            $query='INSERT INTO UsuarioActividad (idUsuario, idActividad) VALUES (?,?) ';
            // Preparing the statement 
            if (!($statement = $connect->prepare($query))) {
                die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
            }
            
            // Binding statement params 
            if (!$statement->bind_param("ss", $idUsuario, $idActividad)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
            }
            
             // Executing the statement
            if (!$statement->execute()) {
                die("ERRRRRROR: (" . $statement->errno . ") " . $statement->error);
            }
                
            
            disconnect($connect);
            
            return 1;
            
        }else{
            
            return 2;
            
        }
            
        
    }
    
    
    function eliminarRegistro($idUsuario, $idActividad){
        
        $connect = connect();
        
        $query =    "DELETE FROM UsuarioActividad
                    WHERE idUsuario = ". $idUsuario . "
                    AND idActividad = ". $idActividad;
                    
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
        
        if ($connect->query($query) === FALSE) {
            echo "Error deleting record: " . $connect->error;
        }
        
        disconnect($connect);
        
    }
    
    
    function getNombre($id){
        
        $connect = connect();
        
        $query =    "SELECT Nombre, ApellidoPaterno, ApellidoMaterno
                    FROM Usuario
                    WHERE idUsuario = ". $id;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $nombre = $row["Nombre"] . " " . $row["ApellidoPaterno"] . " " . $row["ApellidoMaterno"];
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $nombre;
    }
    
    
    
    function getRol($id){
        
        $connect = connect();
        
        $query =    "SELECT idRoles
                    FROM Usuario
                    WHERE idUsuario = ". $id;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $rol = $row["idRoles"];
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $rol;
    }
    
    
    
    function getEdad($id){
        
        $connect = connect();

        $query =    "SELECT TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS edad
                    FROM Usuario
                    WHERE idUsuario = ". $id;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $edad = $row["edad"];
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $edad;
    }
    
    
    
    function checkRegistros($idUsuario, $array){
        
        // return $idUsuario;
        
        $connect = connect();
        
        $query =    "SELECT idActividad
                    FROM UsuarioActividad
                    WHERE idUsuario = ". $idUsuario;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $flag = true;
            
            foreach($array as $element){
                
                if($row['idActividad'] == $element){
                    $flag = false;
                    break;
                }
            }
            
            if($flag){
                
                eliminarRegistro($idUsuario, $row['idActividad']);
            }
            
        }
        
        mysqli_free_result($result);
        
        $result = mysqli_query($connect, $query);
        
        foreach($array as $element){
            
            $flag = true;
            
            while($row = mysqli_fetch_array($result)){
                
                if($element == $row['idActividad']){
                    $flag = false;
                    break;
                }    
                
            }
            
            if($flag){
                
                nuevoRegistro($idUsuario, $element);
            }
            
        }
        
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        //return $concat;
        
    }
    
    
    function emptyRegisters($idUsuario){
        
        $connect = connect();
        
        $query =    "SELECT idActividad
                    FROM UsuarioActividad
                    WHERE idUsuario = ". $idUsuario;
                    
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            eliminarRegistro($idUsuario, $row['idActividad']);
            
        }
        
        mysqli_free_result($result);

        disconnect($connect); 
        
    }
    
    function getTipoOrga($id){
        
        $connect = connect();
        
        $query =    "SELECT O.tipoOrganizacion
                    FROM Usuario U, Organizacion O, UsuarioOrganizacion UO
                    WHERE U.idUsuario = UO.idUsuario
                    AND UO.idOrganizacion = O.idOrganizacion
                    AND U.idUsuario = " .  $id;
        
        if($query){
          $result = mysqli_query($connect, $query);
        
            if($result){
                while($row = mysqli_fetch_array($result)){
                    
                    $tipo = $row['tipoOrganizacion'];
                        
                }
                
                mysqli_free_result($result);
                
                disconnect($connect);
                
                return $tipo;
            }else{
                
                return "2";
            }
        }else{
            return "2";
        }
    }
    
    function actividadesUsuario($id){
        
            $connect = connect();
            
            $query = "SELECT P.nombrePrograma, A.horaInicio, A.horaFin, A.tipoActividad, A.dia
                        FROM Actividad A, Programa P, UsuarioActividad U
                        WHERE  U.idUsuario = '". $id ."'
                        AND U.idActividad = A.idActividad
                        AND A.idPrograma = P.idPrograma
                        ORDER BY P.nombrePrograma";
                    
            $result = mysqli_query($connect, $query);
            
            $form;
            
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
            
                $form.= '<div class="card blue-grey darken-2">
                            <div class="card-content white-text">
                                <span class="card-title center"><h4>' . $row['nombrePrograma'] . '</h4></span>
                                <br>
                                <div class="divider"></div>
                                <br>
                                <div class="center">
                
                <table class="centered responsive-table">
                            <tr>
                                <td width="30%">
                                    <strong class="">Día</strong>
                                    <br>
                                    <p style="font-size: 25px"> ' . $row['dia'] . '</p>
                                </td>
                                <td  width="40%">
                                    <strong>Horario</strong>
                                    <br>
                                    <p style="font-size: 25px">' . $horaIn . ':' . $minIn . ' a ' . $horaFi . ':' . $minFi . ' hrs.</p>
                                </td>
                                <td  width="30%">
                                    <strong>Tipo de actividad</strong>
                                    <br>
                                    <p style="font-size: 25px">'. $row['tipoActividad'] . '</p>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div></div>';
            
            }
        
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $form;
    
    }

?>