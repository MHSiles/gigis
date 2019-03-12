<?php

    include_once("moduloSesiones.php");

    if($_REQUEST["id"] && $_REQUEST["tabla"]) {
    
       
       $id = $_REQUEST['id'];
       $tabla = $_REQUEST['tabla'];
       
       //echo "HOLA";
      eliminarRegistro($id, $tabla);
       
       
       //echo "Programa ". $name . " con id " . $id . " eliminado de la tabla " . $tabla;
    }
    
    
    function eliminarRegistro($id, $tabla){
        
        $connect = connect();
        
        $query = "DELETE FROM ". $tabla ." WHERE id". $tabla ."= " . $id;
        
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }
        
        if ($connect->query($query) === FALSE) {
            echo "Error deleting record: " . $connect->error;
        }
        
        disconnect($connect);
        
        
        
    }


?>