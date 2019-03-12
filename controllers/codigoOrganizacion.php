<?php
    
    session_start();
    
    include_once("moduloSesiones.php");

    include("moduloOrganizaciones.php");
    
    if($_REQUEST["idOr"]) {
    
       $id = $_REQUEST['idOr'];
       
       echo(getCodigo($id));
       
    }
        
    
?>