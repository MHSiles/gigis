<?php

     function listaVoluntarios(){
         
        $connect = connect();
        
        //$query = "SELECT * FROM Usuario WHERE idRoles = 'C' ORDER BY Nombre"; //Corregir consulta
        
        $query = "SELECT * FROM Usuario INNER JOIN Voluntario ON Usuario.idUsuario = Voluntario.idUsuario WHERE idRoles = 'C' ORDER BY Nombre";
        
        $result = mysqli_query($connect, $query);
        
        echo '<div class="container paddingTop">
                <br>
                <div class="row">
                    <div class="col s0 m2 l2"></div>
                    <div class="col s12 m8 l8">
                        <table class="striped centered">
                            <thead>
                                <tr>
                                    <th data-field="nombre">Nombre</th>
                                    <th data-field="apellido">Apellido Paterno</th>
                                    <th data-field="apellido">Apellido Materno</th>
                                    <th data-field="ocupacion">Ocupación</th>
                                </tr>
                            </thead>'; 

        while($row = mysqli_fetch_array($result)){  
            
            echo "<tr><td>" . $row['Nombre'] . "</td><td>" . $row['ApellidoPaterno'] . "</td><td>". $row['ApellidoMaterno'] . "</td><td>" . $row['Ocupacion'] . "</td>";
            echo '<td><a href="consultarVoluntarios.php?id=' . $row['idUsuario'] . '"><i class="material-icons">delete</i></a>
                 <a href="editarVoluntario.php?id=' . $row['idUsuario'] . '"> <i class="material-icons">mode_edit</i></a></td>';
            
        }
        
        
        echo                '</table>
                        </div>
                    <div class="col s0 m2 l2"></div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
    }
    
     function optionsDisplay($nuevoVoluntario){
        
        $connect = connect();
        
        $query = "SELECT * FROM Usuario INNER JOIN Voluntario ON Usuario.idUsuario = Voluntario.idUsuario WHERE idRoles = 'C' ORDER BY Nombre";
        
        $result = mysqli_query($connect, $query);
        
        $var;
        
        if(!$nuevoVoluntario){
            
            while($row = mysqli_fetch_array($result)){
             
                $var .= '<option value="' . $row["Nombre"] . '">';   
            }
            
            mysqli_free_result($result);
            
            disconnect($connect);
            
            return $var;
        }else{
            
            while($row = mysqli_fetch_array($result)){
             
                if($row["Nombre"] == $nuevoVoluntario){
                    
                    mysqli_free_result($result);
            
                    disconnect($connect);
                    
                    return false;
                }
            }
            
            mysqli_free_result($result);
            
            disconnect($connect);
            
            return true;
        }
        
    }
    
    
    
    
    function nuevoVoluntario($nombre, $apellido, $fechaNacimiento, $CorreoElectronico, $Telefono, $Ocupacion){
        
        $connect = connect();
        
        if(optionsDisplay($nombre)){
            $query='INSERT INTO Usuario (Nombre, Apellido, fechaNacimiento, CorreoElectronico, Telefono) VALUES (?,?,?,?,?)';
            $query2='INSERT INTO Voluntario (Ocupacion) VALUES(?)';
            // Preparing the statement 
            if (!($statement = $connect->prepare($query))) {
                die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
            }
             if (!($statement = $connect->prepare($query2))) {
                die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
            }
            // Binding statement params 
            if (!$statement->bind_param("sssss", $nombre, $apellidoe, $fechaNacimiento, $CorreoElectronico, $Telefono)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
            }
            if (!$statement->bind_param("s", $Ocupacion)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
            }
            // Executing the statement
            if (!$statement->execute()) {
                die("Execution failed: (" . $statement->errno . ") " . $statement->error);
            }   
            
            disconnect($connect);
        }else{
            
            disconnect($connect);
        }
        
         
        
        
        
    }
    
    
    
    function editarVoluntario($id){
        
        $connect = connect();
        
        $query = "SELECT * FROM Usuario WHERE idUsuario = ". $id;
        
        $result = mysqli_query($connect, $query);
        
        $form = '<nav id="titulo" class="cyan">
                    <div class="container">
                      <div class="nav-wrapper"><a class="page-title">EDITAR VOLUNTARIO</a></div>
                    </div>
                </nav>
                <a href="../controllers/consultarVoluntarios.php" class="btn-floating btn-large lime
                topRight"><i class="material-icons">arrow_back</i></a>';

        while ($row = mysqli_fetch_array($result)){
            
            $form.= '<div class="center-align">
                        <div class="container paddingTop">
                            <form  action="editarVoluntario.php" method="POST" >
                                <div class="row">
                                    <div class="col s4"></div>
                                    <div class="col s4">
                                        <label for="nombre_curso">Nombre</label>
                                        <input list="nombre_curso" name="nombreCurso" data-length="20"
                                        value="'. $row["nombreOrganizacion"] . '">
                                        <datalist id="nombre_curso" class="dropdown-content validate">
                                            <?php optionsDisplay() ?>
                                        </datalist>
                                        <span class = "error"></span>
                                    </div>
                                    <div class="col s4"></div>
                                </div>
                                <div class="row">
                                    <div class="col s4"></div>
                                    <div class=" col s2">
                                        <label for="passOrganizacion" class="left-align">Clave Acceso</label>
                                        <input id="passOrganizacion" name="passOrganizacion" type="text" class="validate" 
                                        data-length="8" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,8}" value="'. $row["claveAcceso"] . '">
                                    </div>
                                    <div class=" col s2">
                                        <label for="numHoras" class="left-align">Numero de Horas</label>
                                        <input id="numHoras" name="numHoras" type="number" class="validate"
                                        min="1" max="300" value="'. $row["horasCubiertas"] . '">
                                        <input id="icon_prefix" type="number" name="idOrganizacion" class="validate" value='.$row["idOrganizacion"].' hidden>
                                    </div>
                                    <div class="col s4"></div>
                                </div>
                                
                                <div class="row">
                                    
                                </div>';

        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $form;
    }
    
    
    
    function guardarOrganizacion($idOr, $nombre, $clave, $horas) {
        
        $connect = connect();
        
        $query="UPDATE Organizacion SET nombreOrganizacion=?, claveAcceso=?, horasCubiertas=? WHERE idOrganizacion=?";
        
        //$result = mysqli_query($connect, $query);
        
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        
        // Binding statement params 
        if (!$statement->bind_param("ssss", $nombre, $clave, $horas, $idOr)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
        }
        
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        } 
          
        // var_dump($statement);

        //mysqli_free_result($result);
        
        disconnect($connect);
        
    }
    
    
    
    function eliminarOrganizacion($id){
        
        $connect = connect();
        
        $subquery = "DELETE FROM UsuarioOrganizacion WHERE idOrganizacion=" . $id;
        
        $query = "DELETE FROM Organizacion WHERE idOrganizacion=" . $id;
        
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
        
        if ($connect->query($subquery) === FALSE) {
            echo "Error deleting record: " . $connect->error;
        }
        
        if ($connect->query($query) === FALSE) {
            echo "Error deleting record: " . $connect->error;
        }
        
        disconnect($connect);
    
        
    }


?>