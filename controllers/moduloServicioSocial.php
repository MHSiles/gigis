<?php

    
    function listaServicioSocial(){
        $connect = connect();
        $query = "SELECT * FROM Usuario INNER JOIN ServicioSocial ON Usuario.idUsuario = ServicioSocial.idUsuario WHERE idRoles = 'B' ORDER BY Nombre";
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
                                    <th data-field="apellido">Apellido</th>
                                    <th data-field="semestre">Semestre</th>
                                    <th data-field="matricula">Matricula</th>
                                    
                                </tr>
                            </thead>'; 
    
    while($row = mysqli_fetch_array($result)){  
            
            echo "<tr><td>" . $row['Nombre'] . "</td><td>" . $row['Apellido'] . "</td><td>" . $row['Semestre'] . "</td><td>" . $row['Matricula']. "</td>";
            echo '<td><a href="consultarServicioSocial.php?id=' . $row['idUsuario'] . '"><i class="material-icons">delete</i></a>
                 <a href="editarServicioSocial.php?id=' . $row['idUsuario'] . '"> <i class="material-icons">mode_edit</i></a></td>';
            
    }
        
        
        echo                '</table>
                        </div>
                    <div class="col s0 m2 l2"></div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
    }
    
    function optionsDisplay($nuevoServicioSocial){
        
        $connect = connect();
        $query = "SELECT * FROM Usuario INNER JOIN ServicioSocial ON Usuario.idUsuario = ServicioSocial.idUsuario WHERE idRoles = 'B' ORDER BY Nombre ";
        $result = mysqli_query($connect, $query);
        $var;
        
        if(!$nuevoServicioSocial){
            while($row = mysqli_fetch_array($result)){
                $var .= '<option value"' .$row["Nombre"] . '">';
            }
            mysqli_free_result($result);
            
            disconnect($connect);
            
            return $var;
        }else {
            while($row = mysqli_fetch_array($result)){
             
                if($row["Nombre"] == $nuevoServicioSocial){
                    
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
    
    function nuevoServicioSocial($nombre, $apellido, $fechaNacimiento, $CorreoElectronico, $Telefono, $Semestre, $Matricula){
        $connect = connect();
        
        if(optionsDisplay($nombre)){
           $query='INSERT INTO Usuario (Nombre, Apellido, fechaNacimiento, CorreoElectronico, Telefono) VALUES (?,?,?,?,?)';
           $query2= 'INSERT INTO ServicioSocial (Semestre, Matricula) VALUES(?,?)';
         
       if (!($statement = $connect->prepare($query))) {
                die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
            }
             if (!($statement = $connect->prepare($query2))) {
                die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
            }
            // Binding statement params 
            if (!$statement->bind_param("sssss", $nombre, $apellido, $fechaNacimiento, $CorreoElectronico, $Telefono)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
            }
            if (!$statement->bind_param("ss", $Semestre,$Matricula)) {
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
     function editarServicioSocial($id){
        
        $connect = connect();
        
        $query = "SELECT * FROM Usuario WHERE idUsuario = ". $id;
        
        $result = mysqli_query($connect, $query);
        
        $form = '<nav id="titulo" class="cyan">
                    <div class="container">
                      <div class="nav-wrapper"><a class="page-title">EDITAR ServicioSocial</a></div>
                    </div>
                </nav>
                <a href="../controllers/consultarServicioSocial.php" class="btn-floating btn-large lime
                topRight"><i class="material-icons">arrow_back</i></a>';

        while ($row = mysqli_fetch_array($result)){
            
            $form.= '<div class="center-align">
                        <div class="container paddingTop">
                            <form  action="editarServicioSocial.php" method="POST" >
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
    