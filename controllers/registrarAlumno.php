<?php

    session_start();

    // if($_SESSION['cuenta']['rol'] == 'D'){

    include_once("moduloSesiones.php");

    include_once("moduloUsuario.php");


    if(isset($_POST['nombreAlumno']) && isset($_POST['apellidoPaterno'])
        && isset($_POST['correoElectronico']) && isset($_POST['telefonoCelular']) && isset($_POST['fechaNacimiento'])
        && isset($_POST["nombreTutor"]) && isset($_POST["matricula"]) && isset($_POST["newPass"])){

        // $hash = password_hash($_POST["newPass"], PASSWORD_DEFAULT);

        nuevoAlumno($_POST['nombreAlumno'], $_POST['apellidoPaterno'], $_POST['apellidoMaterno'],
                    $_POST['correoElectronico'], $_POST['telefonoCelular'], $_POST['fechaNacimiento'],
                    $_POST["nombreTutor"], $_POST["matricula"], $_POST["newPass"]);

        header("location:consultarAlumnos.php");



    }
    include_once("../views/_header.html");

    include("../views/_nav.html");

    include("../views/_registrarAlumno.html");

    include("../views/_footer.html");

    // } else {
    //
    //     http_response_code(404);
    //     die();
    //
    // }
?>
