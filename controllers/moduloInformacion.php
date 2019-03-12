<?php

    function listaInformacion(){
         
        $connect = connect();
        
        // $query = "SELECT * FROM Usuario WHERE idUsuario = $id";
        
        $query = "SELECT * FROM Usuario WHERE idUsuario = 2001";
        
        $result = mysqli_query($connect, $query);
        
        // $var= '<div class="container paddingTop">
        //         <br>
        //         <div class="row">
        //             <div class="col s0 m2 l2"></div>
        //             <div class="col s12 m8 l8">
        //                 <table class="striped">
        //                     <thead>
        //                         <tr>
        //                             <th data-field="nombre">Nombre</th>
        //                             <th data-field="apellido">Apellido</th>
        //                             <th data-field="fnac">Fecha de Nacimiento</th>
        //                             <th data-field = "correo">Correo</th>
        //                             <th data-field = "tel">Teléfono</th>
        //                         </tr>
        //                     </thead>'; 
         while($row = mysqli_fetch_array($result)){
            $tabla = 'Usuario';
            
            $info = '<span class="card-title"><strong>'. $row['Nombre'] . '</strong></span>
                    <ul>
                        <li><strong>Fecha de Inicio: </strong>'. $row ['fechaNacimiento'] .'</li>
                        <li><strong>Fecha de Término: </strong>'. $row ['CorreoElectronico'] .'</li>
                    </ul>';
            
        }
        // while($row = mysqli_fetch_array($result)){  
            
        //     $tabla = 'Usuario';
            
        //     $var .= "<tr><td>" . $row['Nombre'] . "</td><td>" . $row['Apellido'] . "</td><td>" . $row['fechaNacimiento'] . "</td><td>" . $row['CorreoElectronico'] . "</td><td>" . $row['Telefono'] . "</td>";
        // }
        
        
        // $var .=                '</table>
        //                 </div>
        //             <div class="col s0 m2 l2"></div>
        //         </div>
        //     </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $var;
    }
    
?>