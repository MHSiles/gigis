<?php

    session_start();

    include_once('moduloSesiones.php');
    
    $user = $_POST['usuario'];
    $password = $_POST['password'];
    $users = getUsuarios();
    
    if(mysqli_num_rows($users)){
        
        while($row = mysqli_fetch_assoc($users)){

            if(strcmp($user, $row['CorreoElectronico']) == 0 && password_verify($password, $row['Password'])){
                $_SESSION['cuenta'] = array();
                $_SESSION['cuenta']['nombre'] = $row['Nombre'];
                $_SESSION['cuenta']['paterno'] = $row['ApellidoPaterno'];
                $_SESSION['cuenta']['fechaNacimiento'] = $row['fechaNaacimiento'];
                $_SESSION['cuenta']['email'] = $user;
                $_SESSION['cuenta']['telefono'] = $row['Telefono'];
                $_SESSION['cuenta']['rolNom'] = $row['NombreRoles'];
                $_SESSION['cuenta']['rol'] = $row['idRoles'];
                $_SESSION['cuenta']['id'] = $row['idUsuario'];
            }
            
        }
        
        if(isset($_SESSION['cuenta'])) {
            
            if($_SESSION['cuenta']['rol'] == "D"){
                header("Location: consultarCiclo.php");
            }else{
                header("Location: home.php");
            }
            
        } else {
            header("Location: index.php?error=1");
        }
        
    }
    
    


?>