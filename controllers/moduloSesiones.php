<?php


    function connect(){

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "gigis";


        $sqlConnection = mysqli_connect($servername, $username, $password, $dbname);

        if(!$sqlConnection){
            die("Conección Fallida: " . mysqli_connect_error());
        }

        mysqli_set_charset($sqlConnection,"utf8");

        return $sqlConnection;
    }

    function disconnect($sqlConnection){
        mysqli_close($sqlConnection);
    }



    function getUsuarios(){

        $connect = connect();

        $query = 'SELECT * FROM Usuario INNER JOIN Rol ON Usuario.idRoles = Rol.idRoles';

        $result = mysqli_query($connect, $query);

        disconnect($connect);

        return $result;

    }

    function checkEmail($email){

        $connect = connect();

        $query = 'SELECT CorreoElectronico FROM Usuario';

        $result = mysqli_query($connect, $query);

        disconnect($connect);

        if(mysqli_num_rows($result)){

            while($row = mysqli_fetch_assoc($result)){

                if(strcmp($email, $row['CorreoElectronico']) == 0){
                    return false;
                }
            }
        }
        return true;
    }

    function getInstitution($id){

        $connect = connect();

        $query = "  SELECT NombreOrganizacion
                    FROM UsuarioOrganizacion, Organizacion
                    WHERE UsuarioOrganizacion.idOrganizacion = Organizacion.idOrganizacion
                    AND idUsuario = $id";


        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result)){

            $results = $row["NombreOrganizacion"];

        }

        mysqli_free_result($result);

        disconnect($connect);

        return $results;

    }

    function getStudentInfo($id){

        $connect = connect();

        $query = "  SELECT NombreTutor, Matricula
                    FROM Alumno
                    WHERE idUsuario = $id";


        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result)){

            $results['tutor'] = $row["NombreTutor"];
            $results['matricula'] = $row["Matricula"];

        }

        mysqli_free_result($result);

        disconnect($connect);

        return $results;

    }


    function login($user, $password){

        $connect = connect();

        $query = "";

    }

?>
