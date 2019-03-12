<?php

    
     function listaOrganizaciones(){
         
        $connect = connect();
        
        $query = "SELECT * FROM Organizacion ORDER BY nombreOrganizacion";
        
        $result = mysqli_query($connect, $query);
        
        
        
        $var= '<div class="container paddingTop">
                <br>
                <div class="row">
                    <div class="col s0 m2 l2"></div>
                    <div class="col s12 m8 l8">
                        <table class="striped">
                            <thead>
                                <tr>
                                    <th data-field="nombre">Nombre</th>
                                    <th data-field="claveAcceso">Contraseña</th>
                                    <th>Organizacion</th>
                                    <th data-field="horas">Horas</th>
                                </tr>
                            </thead>'; 

        while($row = mysqli_fetch_array($result)){  
            
            if($row['tipoOrganizacion'] == 1){
                $tipo = "Preparatoria";
            }else{
                $tipo = "Universidad";
            }
            
            $tabla = 'Organizacion';
            
            $var .= "<tr>
                        <td>" . $row['nombreOrganizacion'] . "</td>
                        <td>" . $row['claveAcceso'] . "</td>
                        <td>" . $tipo . "</td>
                        <td>" . $row['horasCubiertas'] . "</td>";
                        
            $var .= "   <td>
                            <a href='editarOrganizacion.php?id=" . $row['idOrganizacion'] . "'>
                                <i class='material-icons'>mode_edit</i>
                            </a>
                            <a>
                                <i class='material-icons' style='cursor:pointer' onclick=borrarItem(". $row['idOrganizacion'] .",'". $tabla ."')>delete</i>
                            </a>
                        </td>
                    </tr>";
            
        }
        
        
        $var .=                '</table>
                        </div>
                    <div class="col s0 m2 l2"></div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $var;
    }
    
    
    function optionsDisplay($nuevaOrg, $orgActual){
        
        $connect = connect();
        
        $query = "SELECT * FROM Organizacion ORDER BY nombreOrganizacion";
        
        $result = mysqli_query($connect, $query);
        
        $var;
        
        if(!$nuevaOrg && !$orgActual){
            
            while($row = mysqli_fetch_array($result)){
             
                $var .= '<option value="' . $row["nombreOrganizacion"] . '">';   
            }
            
            mysqli_free_result($result);
            
            disconnect($connect);
            
            return $var;
        }else if($nuevaOrg && !$orgActual){
            
            while($row = mysqli_fetch_array($result)){
             
                if($row["nombreOrganizacion"] == $nuevaOrg){
                    
                    mysqli_free_result($result);
            
                    disconnect($connect);
                    
                    return false;
                }
            }
            
            mysqli_free_result($result);
            
            disconnect($connect);
            
            return true;
        }else{
            
            while($row = mysqli_fetch_array($result)){
             
                if($row["nombreOrganizacion"] == $nuevaOrg){
                    
                    if($row["nombreOrganizacion"] != $orgActual){
                        
                        mysqli_free_result($result);
                
                        disconnect($connect);
                        
                        return false;
                        
                    }
                }
            }
            
            mysqli_free_result($result);
            
            disconnect($connect);
            
            return true;
            
        }
        
    }
    
    function getNombre($id){
        
        $connect = connect();
        
        $query = "SELECT nombreOrganizacion FROM Organizacion WHERE idOrganizacion=". $id;
        
        $result = mysqli_query($connect, $query);
        
        while ($row = mysqli_fetch_array($result)){
            
            $nombre = $row['nombreOrganizacion'];
        }
        
        return $nombre;
        
        disconnect($connect);
        
    }
    
    
    function nuevaOrganizacion($nombre, $tipo, $clave, $horas){
        
        $connect = connect();
    
        $query='INSERT INTO Organizacion (nombreOrganizacion, tipoOrganizacion, claveAcceso, horasCubiertas) VALUES (?,?,?,?)';
        // Preparing the statement 
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        // Binding statement params 
        if (!$statement->bind_param("ssss", $nombre, $tipo, $clave, $horas)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
        }
        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }   
        
        disconnect($connect);
        
    }
    
        
    function selected1($value){
        
        if($value == 1){
            return 'selected';
        }else {
            return;
        }
    }
    
    function selected2($value){
        
        if($value == 2){
            return 'selected';
        }else {
            return;
        }
    }
    
    
    function displayTipoOrga($tipo){
        
        $options = "<option value='' disabled selected></option>";
        
        if(!$tipo){
            
            $options .= '<option value="1">Preparatoria</option>
                        <option value="2">Universidad</option>';
            
        }else{
            
            $options .= '<option value="1" '. selected1($tipo) .'>Preparatoria</option>
                        <option value="2" '. selected2($tipo) .'>Universidad</option>';
            
        }
        
        return $options;
        
    }
    function editarOrganizacion($id){
        
        $connect = connect();
        
        $query = "SELECT * FROM Organizacion WHERE idOrganizacion = ". $id;
        
        $result = mysqli_query($connect, $query);
        
        $form = '<nav id="titulo" class="cyan">
                    <div class="container">
                      <div class="nav-wrapper"><a class="page-title">EDITAR ORGANIZACIÓN</a></div>
                    </div>
                </nav>
                <a class="btn-large cyan top btn-flat">
                <i class="material-icons cwhite" onclick="goBack()">arrow_back</i></a>';
     
        

 
        while ($row = mysqli_fetch_array($result)){
            
            $form.= '<div class="center-align">
                        <div class="container paddingTop">
                            <form  action="editarOrganizacion.php?id='. $row['idOrganizacion'] .'" method="POST">
                                <div class="row">
                                    <div class="col s0 m2 l3"></div>
                                    <div class="col s12 m8 l6">
                                        <label for="nombreOrganizacion">
                                            Nombre
                                            <br>
                                            <span class = "error">'. $progErr .'</span>
                                        </label>
                                        <input list="nombreOrganizacion" name="nombreOrganizacion" data-length="30"
                                        value="'. $row["nombreOrganizacion"] . '" required>
                                        <datalist id="nombreOrganizacion" class="dropdown-content validate">
                                            '. optionsDisplay(0,0) .'
                                        </datalist>
                                        <span class = "error"></span>
                                    </div>
                                    <div class="col s0 m2 l3"></div>
                                </div>';
                                
                                
                                
            $form .= '<div class="row">
                        <div class="col s0 m2 l3"></div>
                        <div class="col s12 m8 l6">
                            <label>
                                Tipo de Organizacion
                            </label>
                            <select name="tipoOrganizacion" id="tipoOrganizacion">
                                '. displayTipoOrga($row['tipoOrganizacion']) .'
                            </select>
                        </div>
                        <div class="col s0 m2 l3"></div>
                    </div>'; 
                                
                                
                                
          $form .=            '<div class="row">
                                    <div class="col s0 m2 l3"></div>
                                    <div class=" col s12 m4 l3">
                                        <label for="passOrganizacion" class="left-align">Clave Acceso</label>
                                        <input id="passOrganizacion" name="passOrganizacion" type="text" class="validate" placeholder="Ejemplo: Escuela2"
                                        data-length="8" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,8}" value="'. $row["claveAcceso"] . '" required>
                                    </div>
                                    <div class=" col s12 m4 l3">
                                        <label for="numHoras" class="left-align">Numero de Horas</label>
                                        <input id="numHoras" name="numHoras" type="number" class="validate"
                                        min="1" max="480" value="'. $row["horasCubiertas"] . '" required>
                                        <input id="icon_prefix" type="number" name="idOrganizacion" class="validate" value='.$row["idOrganizacion"].' hidden>
                                    </div>
                                    <div class="col s0 m2 l1"></div>
                                </div>
                                
                                <div class="row">
                                    
                                </div>';

        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $form;
    }
    
    
     
    function guardarOrganizacion($idOr, $nombre, $tipo, $clave, $horas) {
        
        $connect = connect();
        
            
        // $query="UPDATE Organizacion 
        //       SET nombreOrganizacion ='$nombre', tipoOrganizacion = '$tipo', claveAcceso='$clave', horasCubiertas='$horas' 
        //       WHERE idOrganizacion='$idOr'";
               
        $query = "UPDATE Organizacion SET nombreOrganizacion=?, tipoOrganizacion=?, claveAcceso=?, horasCubiertas=? WHERE idOrganizacion=?";
        
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        
        // Binding statement params
        if (!$statement->bind_param("sssss", $nombre, $tipo, $clave, $horas, $idOr)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
        }
        
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }
    }
    
    
    
    function eliminarOrganizacion($id){
        
        $connect = connect();
        
        $query = "DELETE FROM Organizacion WHERE idOrganizacion=" . $id;
        
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
        
        if ($connect->query($query) === FALSE) {
            echo "Error deleting record: " . $connect->error;
        }
        
        disconnect($connect);
    
        
    }
    
    
    function getCodigo($id){
        
        $connect = connect();
        
        $query =    "SELECT claveAcceso
                    FROM Organizacion
                    WHERE idOrganizacion = ". $id;
        
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
            
            $codigo = $row['claveAcceso'];
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $codigo;
        
    }

?>