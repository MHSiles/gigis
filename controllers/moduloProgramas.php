<?php

    // include("moduloSesiones.php");
    
    if($_GET['eliminar'] == 1){
        vaciarProgramas();
    }
    
    function listaProgramas(){
         
        $connect = connect();
        
        $query = "SELECT * FROM Programa ORDER BY nombrePrograma";
        
        $result = mysqli_query($connect, $query);
        
        $tabla = "Programa";
        
        $var =  '<div class="container paddingTop">
              <br>
              <div class="row">
                <div class="col s0 m2 l3"></div>
                <div class="col s12 m8 l6">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th colspan="2">Nombre</th>
                      </tr>
                    </thead>'; 

        while($row = mysqli_fetch_array($result)){  
            
            // <a href='consultarProgramas.php?id=" . $row["idPrograma"] . "'>
            
           
            
            $var.= "<tr>
                        <td hidden>". $row['idPrograma'] ."</td>";
            $var.= "    <td>" . $row['nombrePrograma'] . "</td>";
            $var.= "    <td style='text-align: center'>
                            <a href='editarPrograma.php?id=" . $row["idPrograma"] . "'><i class='material-icons'>mode_edit</i></a>";
            $var.= "    
                            <a><i class='material-icons delete' style='cursor:pointer' 
                            onclick=borrarItem(". $row['idPrograma'] .",'". $tabla ."') >delete</i></a>
                        </td>
                    </tr>";
            // onclick=borrarItem(". $idPrograma .",'". $nombrePrograma ."','". $tabla ."') >delete</i></a>
        }
        
        $var .=               '</table>
                        </div>
                    <div class="col s0 m2 l3"></div>
                </div>
            </div>';
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        return $var;
    }
            
            
    function listaProgramasUsuarios(){
        $connect = connect();
            
        $query =    "SELECT *
                    FROM Programa P
                    GROUP BY P.nombrePrograma";
                
        $result = mysqli_query($connect, $query);
        
        $tabla = "Programa";
        
        $table.=   '<div class="container paddingTop">
                    <div class="row">
                    <ul class="collapsible popout" data-collapsible="accordion">';
        
        while($row = mysqli_fetch_array($result)){
            
          
            $table .= ' <li>
                            <div class="collapsible-header">
                                <strong>'. $row['nombrePrograma'] .'</strong>
                            </div>
                            <div class="collapsible-body">
                                <i class = "small material-icons">description</i> &nbsp &nbsp <strong>'. $row['descripcionPrograma'] .'</strong>
                                <br>
                            </div>
                        </li>';
        }
        
        $table .= '</ul></div></div>';
        
        
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $table;
    
    }
    
    
    
    function optionsDisplay($nuevoProg){
        
        $connect = connect();
        
        $query = "SELECT * FROM Programa ORDER BY nombrePrograma";
        
        $result = mysqli_query($connect, $query);
        
        $options;
        
        if(!$nuevoProg){
            
            while($row = mysqli_fetch_array($result)){
         
                $options.= '<option value="' . $row["nombrePrograma"] . '"></option>';   
            }
            
            mysqli_free_result($result);
            
            disconnect($connect);
            
            return $options;
            
        }else{
            
            while($row = mysqli_fetch_array($result)){
             
                if($row["nombrePrograma"] == $nuevoProg){
                    
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
    
    
    
    function nuevoPrograma($nombre, $desc){
        
        $connect = connect();
        
        $flag = false;
        $flag = optionsDisplay($nombre);
        
        if($flag){
            $query='INSERT INTO Programa (nombrePrograma, descripcionPrograma) VALUES (?,?) ';
            // Preparing the statement 
            if (!($statement = $connect->prepare($query))) {
                die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
            }
            // Binding statement params 
            if (!$statement->bind_param("ss", $nombre, $desc)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
            }
             // Executing the statement
            if (!$statement->execute()) {
                die("Execution failed: (" . $statement->errno . ") " . $statement->error);
            } 
            
            disconnect($connect);
            
            return true;
            
        } else{
            
            disconnect($connect);
            
            return false;
        }
        
        
    }
    

    function editarPrograma($id){
        
        $connect = connect();
        
        $query = "SELECT * FROM Programa WHERE idPrograma=". $id;
        
        $result = mysqli_query($connect, $query);
        
        if($result === FALSE) { 
            die(mysql_error()); // TODO: better error handling
        }
        
        $var = '<nav id="titulo" class="cyan">
                        <div class="container">
                          <div class="nav-wrapper"><a class="page-title">EDITAR PROGRAMA</a></div>
                        </div>
                </nav>
                
                <a class="btn-large cyan top btn-flat"><i class="material-icons cwhite" onclick="goBack()">arrow_back</i></a>
                
                <div class="center-align">
    
                <br><br>';

        

        while ($row = mysqli_fetch_array($result)){
            
            $var.= '<form  action="editarPrograma.php?id='. $row['idPrograma'] .'" method="POST" >
                        <div class="row">
                            <label for="nombrePrograma">
                                Nombre Programa
                                <br>
                            </label>
                            <div class="input-field col s3"></div>
                            <div class="input-field col s6">';
                    
            $var .= '<input list="nombrePrograma" name="nombrePrograma"
                    data-length="30" value="'. $row["nombrePrograma"] .'" required>
                    <datalist id="nombrePrograma">
                        '. optionsDisplay(0) .'
                    </datalist>
                    <input id="icon_prefix" type="number" name="idPrograma"
                    class="validate" value="'.$row["idPrograma"].'" hidden>';
                    
            $var .=         '<span class = "error"></span>
                    </div>
                    <div class="input-field col s3"></div>
                </div>';
                    
            $var .= '<div class="row">
                        <label for="descripcionPrograma">
                            Descripcion
                            <br>
                        </label>
                        <div class="input-field col s3"></div>
                        <div class="input-field col s6">
                            <input type="text" name="descripcionPrograma" class="validate" data-length="141" 
                                value="' . $row['descripcionPrograma'] . '" required>
                            <span class = "error"></span>
                        </div>
                        <div class="input-field col s3"></div>
                    </div>';
            
        }
                
        mysqli_free_result($result);
                
        disconnect($connect);
        
        return $var;
    }


    function guardarPrograma($id, $nombre, $desc){
        
        $connect = connect();
        
        $query="UPDATE Programa SET nombrePrograma=?, descripcionPrograma=? WHERE idPrograma=?";
            
        if (!($statement = $connect->prepare($query))) {
            // die("AQUI HAY UN ERROR");
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        
        // Binding statement params 
        if (!$statement->bind_param("sss", $nombre, $desc, $id)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
        }
        
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }
        
        disconnect($connect);
        
    }
    
    
    
    function eliminarPrograma($id){
        
        
        
        $connect = connect();
        
       // $subquery = "DELETE FROM UsuarioOrganizacion WHERE idOrganizacion=" . $id;
        
        $query = "DELETE FROM Programa WHERE idPrograma=" . $id;
        
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
        
        // if ($connect->query($subquery) === FALSE) {
        //     echo "Error deleting record: " . $connect->error;
        // }
        
        if ($connect->query($query) === FALSE) {
            echo "Error deleting record: " . $connect->error;
        }
        
        disconnect($connect);
    
        
    }
    
    function vaciarProgramas(){
        
        include("moduloSesiones.php");
        
        $connect = connect();
        
        $query = "DELETE FROM Programa";
        
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
        
        if ($connect->query($query) === FALSE) {
            echo "Error deleting record: " . $connect->error;
        }
        
        disconnect($connect);
    
        
    }
    
?>