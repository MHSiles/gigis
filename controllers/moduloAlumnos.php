<?php
    
    function listaAlumnos(){
        $connect = connect();
        $query = "SELECT * FROM Usuario INNER JOIN Alumno ON Usuario.idUsuario = Alumno.idUsuario WHERE idRoles = 'A' ORDER BY Nombre";
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
                                    <th data-field="telefono">Telefono</th>
                                    <th data-field="nombreTutor">Nombre del Tutor</th>
                                    
                                    
                                </tr>
                            </thead>'; 
    
    while($row = mysqli_fetch_array($result)){  
            
            echo "<tr><td>" . $row['Nombre'] . "</td><td>" . $row['ApellidoPaterno'] . "</td><td>" . $row['Telefono'] . "</td><td>" . $row['NombreTutor']. "</td>";
            echo '<td><a href="consultarServicioSocial.php?id=' . $row['idUsuario'] . '"><i class="material-icons">delete</i></a>
                 <a href="editarAlumno.php?id=' . $row['idUsuario'] . '"> <i class="material-icons">mode_edit</i></a></td>';
            
    }
        
        
        echo                '</table>
                        </div>
                    <div class="col s0 m2 l2"></div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
    }
   