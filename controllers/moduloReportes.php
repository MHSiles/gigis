<?php
    
    function reporteVoluntarios(){
         
        $connect = connect();
        $query = "  SELECT *
                    FROM Usuario U, Voluntario V
                    WHERE U.idUsuario = V.idUsuario 
                    AND idRoles = 'C'
                    ORDER BY U.ApellidoPaterno";
                    
        $result = mysqli_query($connect, $query);
        
         echo '<div class="container paddingTop">
                <br>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="striped">
                            <thead>
                                    <th data-field="nombre">Nombre Completo</th>
                                    <th data-field="telefono">Teléfono</th>
                                    <th>Correo Electrónico</th>
                                    <th data-field="Ocupacion">Ocupacion</th>
                                    <th>Actividades Registradas</th>
                            </thead>'; 
    
        while($row = mysqli_fetch_array($result)){  
                
            $query2 = "  SELECT DISTINCT P.nombrePrograma
                        FROM Usuario U, UsuarioActividad UA, Actividad A, Programa P
                        WHERE UA.idUsuario = U.idUsuario
                        AND A.idActividad = UA.idActividad
                        AND P.idPrograma = A.idPrograma
                        AND U.idUsuario = " . $row['idUsuario'] ."
                        ORDER BY P.nombrePrograma";
                        
            $result2 = mysqli_query($connect, $query2);
            
            echo "  <tr>
                        <td>" . $row['Nombre'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . "</td>
                        <td>" . $row['Telefono'] . "</td>
                        <td>" . $row['CorreoElectronico'] . "</td>
                        <td>" . $row['Ocupacion'] . "</td>
                        <td>";
                        
                    
            
            while($row2 = mysqli_fetch_array($result2)){
                
                echo $row2['nombrePrograma'] . ", ";
                
            }
                
            echo "</td></tr>";
                
        }
        
        
        echo                '</table>
                        </div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
    }    
    
    function reporteServicioSocial(){
         
        $connect = connect();
        $query = "  SELECT *
                    FROM Usuario U, ServicioSocial SS, UsuarioOrganizacion UO, Organizacion O
                    WHERE U.idUsuario = SS.idUsuario
                    AND U.idUsuario = UO.idUsuario
                    AND O.idOrganizacion = UO.idOrganizacion
                    AND idRoles = 'B'
                    ORDER BY U.ApellidoPaterno";
                    
        $result = mysqli_query($connect, $query);
        
         echo '<div class="container paddingTop">
                <br>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="striped">
                            <thead>
                                    <th data-field="nombre">Nombre Completo</th>
                                    <th data-field="telefono">Teléfono</th>
                                    <th>Correo Electrónico</th>
                                    <th data-field="Institucion">Institución</th>
                                    <th>Actividades Registradas</th>
                            </thead>'; 
    
        while($row = mysqli_fetch_array($result)){  
                
            $query2 = "SELECT DISTINCT P.nombrePrograma
                        FROM Usuario U, UsuarioActividad UA, Actividad A, Programa P
                        WHERE UA.idUsuario = U.idUsuario
                        AND A.idActividad = UA.idActividad
                        AND P.idPrograma = A.idPrograma
                        AND U.idUsuario = " . $row['idUsuario'] ."
                        ORDER BY P.nombrePrograma";
                        
            $result2 = mysqli_query($connect, $query2);
            
            echo "  <tr>
                        <td>" . $row['Nombre'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . "</td>
                        <td>" . $row['Telefono'] . "</td>
                        <td>" . $row['CorreoElectronico'] . "</td>
                        <td>" . $row['nombreOrganizacion'] . "</td>
                        <td>";
                        
                    
            
            while($row2 = mysqli_fetch_array($result2)){
                
                echo $row2['nombrePrograma'] . ", ";
                
            }
                
            echo "</td></tr>";
                
        }
        
        
        echo                '</table>
                        </div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
    }    
    
    
    
     function reporteAlumnos(){
         
        $connect = connect();
        $query = "  SELECT *
                    FROM Usuario U, Alumno A
                    WHERE U.idUsuario = A.idUsuario 
                    AND idRoles = 'A'
                    ORDER BY U.ApellidoPaterno";
                    
        $result = mysqli_query($connect, $query);
        
         echo '<div class="container paddingTop">
                <br>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="striped">
                            <thead>
                                    <th>Matrícula Gigis</th>
                                    <th data-field="nombre">Nombre Completo</th>
                                    <th data-field="nombreTutor">Nombre de Padre o Madre</th>
                                    <th data-field="telefono">Telefono</th>
                                    <th>Correo Electrónico</th>
                                    <th>Actividades Registradas</th>
                            </thead>'; 
    
        while($row = mysqli_fetch_array($result)){  
                
            $query2 = "  SELECT DISTINCT P.nombrePrograma
                        FROM Usuario U, UsuarioActividad UA, Actividad A, Programa P
                        WHERE UA.idUsuario = U.idUsuario
                        AND A.idActividad = UA.idActividad
                        AND P.idPrograma = A.idPrograma
                        AND U.idUsuario = " . $row['idUsuario'] ."
                        ORDER BY P.nombrePrograma";
                        
            $result2 = mysqli_query($connect, $query2);
            echo "  <tr>
                        <td>" . $row['Matricula']. "</td>
                        <td>" . $row['Nombre'] . " " . $row['ApellidoPaterno'] . " " . $row['ApellidoMaterno'] . "</td>
                        <td>" . $row['NombreTutor'] . "</td>
                        <td>" . $row['Telefono'] . "</td>
                        <td>" . $row['CorreoElectronico'] . "</td>
                        <td>";
                        
                    
            
            while($row2 = mysqli_fetch_array($result2)){
                
                echo $row2['nombrePrograma'] . ", ";
                
            }
                
            echo "</td></tr>";
                
        }
        
        
        echo                '</table>
                        </div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
    }  
    
    
    function reporteProgramas(){
        
        $connect = connect();
        
        $query = "SELECT * FROM Programa ORDER BY nombrePrograma";
        
        $result = mysqli_query($connect, $query);
        
         echo '<div class="container paddingTop">
                <br>
                <div class="row">
                    <div class="col s0 m2 l2"></div>
                    <div class="col s12 m8 l8">
                        <table class="striped centered">
                            <thead>
                                <tr>
                                    <th data-field="nombre">Nombre Programa</th>
                                </tr>
                            </thead>'; 
    
        while($row = mysqli_fetch_array($result)){  
                
                echo "<tr><td>" . $row['nombrePrograma'] . "</td>";
                //echo '<td><a href="consultarServicioSocial.php?id=' . $row['idUsuario'] . '"><i class="material-icons">delete</i></a>
                  //   <a href="editarAlumno.php?id=' . $row['idUsuario'] . '"> <i class="material-icons">mode_edit</i></a></td>';
                
        }
        
        
        echo                '</table>
                        </div>
                    <div class="col s0 m2 l2"></div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
    }
    
//PRUEBAS DE EXCEL






?>