<?php

     //-------------------------------ADMIN-----------------------------------------------------------------/
       function listaAdmin(){
        $connect = connect();

        $query =    "SELECT *
                    FROM Usuario U
                    WHERE U.idRoles='D'
                    ORDER BY U.ApellidoPaterno";

        $result = mysqli_query($connect, $query);

        $tabla = "Usuario";

        $table.=    '<br><br>
                    <ul class="collapsible" data-collapsible="expandable">';

        while($row = mysqli_fetch_array($result)){

            $fechaNacimiento = date_create($row['fechaNacimiento']);
            $fechaNacimiento = date_format($fechaNacimiento, 'd \d\e F \d\e Y');

            $table .= ' <li>
                            <div class="collapsible-header">
                                <strong>'. $row['ApellidoPaterno'] .' '. $row['ApellidoMaterno'] .' '. $row['Nombre'] .'</strong>
                            </div>
                            <div class="collapsible-body">
                                <i class = "small material-icons">today</i> &nbsp &nbsp <strong>'. $fechaNacimiento .'</strong>
                                <br>
                                <i class = "small material-icons">email</i> &nbsp &nbsp <strong>'. $row['CorreoElectronico'] .'</strong>
                                <br>
                                <i class = "small material-icons">phone</i> &nbsp &nbsp <strong>'. $row['Telefono'] .' </strong>
                                <br>
                                <div class="right">
                                    <a href="editarAdmin.php?id=' . $row["idUsuario"] . '"><i class="material-icons">mode_edit</i></a>
                                    <a><i class="material-icons delete" style="cursor:pointer"
                                    onclick=borrarItem('. $row['idUsuario'] .',"'. $tabla .'") >delete</i></a>
                                </div>
                            </div>
                        </li>';
        }

        $table .= '</ul>';



        mysqli_free_result($result);

        disconnect($connect);

        return $table;

    }


    function nuevoAdmin($nombre, $apellP, $apellM, $correo, $tel, $fechaN, $pass){

        $connect = connect();

        $query='    INSERT INTO Usuario (Nombre, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Telefono,
                fechaNacimiento, Password, idRoles)
                VALUES (?,?,?,?,?,?,?,?)';

        $rol = "D";

        // Preparing the statement
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        // Binding statement params
       if (!$statement->bind_param("ssssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $pass, $rol)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }

        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        //var_dump($statement);

       disconnect($connect);


    }


    function formaEditarAdmin($id){

        $connect = connect();

        $query =    "SELECT *
                    FROM Usuario U
                    WHERE U.idUsuario = ". $id
                    ;

        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result)){

            $form .=    '<div class="row">
                            <div class="col s6 m2 l2"></div>
                            <div class="col s12 m8 l8">
                                <label for="first_name" class="left-align">
                                    Nombre
                                </label>
                                <input id="first_name" type="text" class="validate" name="nombreAlumno" value="'. $row['Nombre'] .'" required>
                            </div>
                            <div class="col s6 m2 l2"></div>
                        </div>';

            $form .=    '<div class="row">
                            <div class="col s6 m2 l2"></div>
                            <div class="col s12 m4 l4">
                                <label for="last_name"  class="left-align">
                                    Apellido Paterno
                                </label>
                                <input id="last_name" type="text" class="validate" name="apellidoPaterno" value="'. $row['ApellidoPaterno'] .'" required>
                            </div>
                            <div class="col s12 m4 l4">
                                <label for="last_nameM"  class="left-align">
                                    Apellido Materno
                                    </label>
                                <input id="last_nameM" type="text" class="validate" name="apellidoMaterno" value="'. $row['ApellidoMaterno'] .'" required>
                            </div>
                            <div class="col s6 m2 l2"></div>
                        </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="fechaNacimiento"  class="left-align">
                                Fecha de Nacimiento
                            </label>
                            <input id="fechaNacimiento" type="date" class="datepicker" name="fechaNacimiento" value="'. $row['fechaNacimiento'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            // $form .= '<div class="row">
            //             <div class="col s6 m2 l2"></div>
            //             <div class="col s12 m8 l8">
            //                 <label for="matriculaG" class="left-align">
            //                     Matricula Gigis Playhouse
            //                 </label>
            //                 <input id="matriculaG" name="matricula" type="text" class="validate" value="'. $row['Matricula'] .'" required>
            //             </div>
            //             <div class="col s6 m2 l2"></div>
            //         </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                        <!--<i class="material-icons prefix">phone</i>-->
                            <label for="telefono"  class="left-align">
                                Teléfono Celular
                            </label>
                            <input id="telefono" type="tel" class="validate" name="telefonoCelular" value="'. $row['Telefono'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="email"  class="left-align">
                                Email
                            </label>
                            <input id="email" type="email" class="validate" name="correoElectronico" value="'. $row['CorreoElectronico'] .'" required>
                        </div>
                        <div class="col s12 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="password"  class="left-align">Nueva Contraseña</label>
                            <input id="password" type="password" class="validate" name="newPass" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,15}" data-length="15">
                        </div>
                        <div class="col s0 m2 l2"></div>
                      </div>

                      <div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="passwordConfirm" data-error="Las contraseñas no coinciden"
                            data-success=""  class="left-align">Confirmar Nueva Contraseña</label>
                            <input id="passwordConfirm" type="password" name="newPassConf">
                        </div>
                        <div class="col s0 m2 l2"></div>
                      </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <input name="idAl" type="number" value="'. $id .'" hidden>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

        }

        mysqli_free_result($result);

        disconnect($connect);

        return $form;

    }

    function guardarAdmin($id, $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $newP) {

        $connect = connect();

        if($newP){

            $query="UPDATE Usuario SET Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, CorreoElectronico=?, Telefono=?,
            fechaNacimiento=?, Password=? WHERE idUsuario=?";

        }else{

            $query="UPDATE Usuario SET Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, CorreoElectronico=?, Telefono=?,
            fechaNacimiento=? WHERE idUsuario=?";

        }

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }

        // Binding statement params
        if($newP){

            if (!$statement->bind_param("ssssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $newP, $id)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
            }

        }else{

            if (!$statement->bind_param("sssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $id)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
            }
        }

         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);


        //mysqli_free_result($result);

        disconnect($connect);

    }
     //------------------------------------------------------------------------------------------------------/





     // -------------------------------ALUMNOS-----------------------------------------------------------------------------------//


     function listaAlumnos(){
        $connect = connect();

        $query =    "SELECT *
                    FROM Usuario U, Alumno A
                    WHERE U.idUsuario = A.idUsuario
                    ORDER BY U.ApellidoPaterno";

        $result = mysqli_query($connect, $query);

        $tabla = "Alumno";

        $table.=    '<br><br>
                    <ul class="collapsible" data-collapsible="expandable">';

        while($row = mysqli_fetch_array($result)){

            $fechaNacimiento = date_create($row['fechaNacimiento']);
            $fechaNacimiento = date_format($fechaNacimiento, 'd \d\e F \d\e Y');

            $table .= ' <li>
                            <div class="collapsible-header">
                                <strong>'. $row['ApellidoPaterno'] .' '. $row['ApellidoMaterno'] .' '. $row['Nombre'] .'</strong>
                            </div>
                            <div class="collapsible-body">
                                <i class = "small material-icons">today</i> &nbsp &nbsp <strong>'. $fechaNacimiento .'</strong>
                                <br>
                                <i class = "small material-icons">person_pin_circle</i> &nbsp &nbsp <strong>'. $row['Matricula'] .' </strong>
                                <br><br>
                                <div class="divider"></div>
                                <br>
                                <i class = "small material-icons">group</i> &nbsp &nbsp <strong> '. $row["NombreTutor"] .' </strong>
                                <br>
                                <i class = "small material-icons">email</i> &nbsp &nbsp <strong>'. $row['CorreoElectronico'] .'</strong>
                                <br>
                                <i class = "small material-icons">phone</i> &nbsp &nbsp <strong>'. $row['Telefono'] .' </strong>
                                <br>
                                <div class="right">
                                    <a href="editarAlumno.php?id=' . $row["idUsuario"] . '"><i class="material-icons">mode_edit</i></a>
                                    <a><i class="material-icons delete" style="cursor:pointer"
                                    onclick=borrarItem('. $row['idUsuario'] .',"'. $tabla .'") >delete</i></a>
                                </div>
                            </div>
                        </li>';
        }

        $table .= '</ul>';



        mysqli_free_result($result);

        disconnect($connect);

        return $table;

    }


    function nuevoAlumno($nombre, $apellP, $apellM, $correo, $tel, $fechaN, $tutor, $matr, $pass){

        $connect = connect();

        $query='    INSERT INTO Usuario (Nombre, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Telefono,
                fechaNacimiento, Password, idRoles)
                VALUES (?,?,?,?,?,?,?,?)';

        $rol = "A";

        // Preparing the statement
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        // Binding statement params
       if (!$statement->bind_param("ssssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $pass, $rol)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }

        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);

        $last_id = $connect->insert_id;

        $query='    INSERT INTO Alumno (idUsuario, NombreTutor, Matricula)
                    VALUES (?,?,?)';

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        // Binding statement params
        if (!$statement->bind_param("sss", $last_id, $tutor, $matr)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }
        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }


        disconnect($connect);


    }


    function formaEditarAlumno($id){

        $connect = connect();

        $query =    "SELECT *
                    FROM Usuario U, Alumno A
                    WHERE U.idUsuario = A.idUsuario
                    AND U.idUsuario = ". $id ;

        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result)){

            $form .=    '<div class="row">
                            <div class="col s6 m2 l2"></div>
                            <div class="col s12 m8 l8">
                                <label for="first_name" class="left-align">
                                    Nombre
                                </label>
                                <input id="first_name" type="text" class="validate" name="nombreAlumno" value="'. $row['Nombre'] .'" required>
                            </div>
                            <div class="col s6 m2 l2"></div>
                        </div>';

            $form .=    '<div class="row">
                            <div class="col s6 m2 l2"></div>
                            <div class="col s12 m4 l4">
                                <label for="last_name"  class="left-align">
                                    Apellido Paterno
                                </label>
                                <input id="last_name" type="text" class="validate" name="apellidoPaterno" value="'. $row['ApellidoPaterno'] .'" required>
                            </div>
                            <div class="col s12 m4 l4">
                                <label for="last_nameM"  class="left-align">
                                    Apellido Materno
                                    </label>
                                <input id="last_nameM" type="text" class="validate" name="apellidoMaterno" value="'. $row['ApellidoMaterno'] .'" required>
                            </div>
                            <div class="col s6 m2 l2"></div>
                        </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="fechaNacimiento"  class="left-align">
                                Fecha de Nacimiento
                            </label>
                            <input id="fechaNacimiento" type="date" class="datepicker" name="fechaNacimiento" value="'. $row['fechaNacimiento'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s6 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="matriculaG" class="left-align">
                                Matricula Gigis Playhouse
                            </label>
                            <input id="matriculaG" name="matricula" type="text" class="validate" value="'. $row['Matricula'] .'" required>
                        </div>
                        <div class="col s6 m2 l2"></div>
                    </div>';

            $form .=    '<div class="row">
                            <div class="col s0 m2 l2"></div>
                            <div class="col s12 m8 l8">
                                <label for="nombreTutor">Nombre Padre/Madre</label>
                                <input id="nombreTutor" type="text" name="nombreTutor" value="'. $row['NombreTutor'] .'" class="validate" required>
                            </div>
                            <div class="col s0 m2 l2"></div>
                        </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                        <!--<i class="material-icons prefix">phone</i>-->
                            <label for="telefono"  class="left-align">
                                Teléfono Celular
                            </label>
                            <input id="telefono" type="tel" class="validate" name="telefonoCelular" value="'. $row['Telefono'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="email"  class="left-align">
                                Email
                            </label>
                            <input id="email" type="email" class="validate" name="correoElectronico" value="'. $row['CorreoElectronico'] .'" required>
                        </div>
                        <div class="col s12 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="password"  class="left-align">Nueva Contraseña</label>
                            <input id="password" type="password" class="validate" name="newPass" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,15}" data-length="15">
                        </div>
                        <div class="col s0 m2 l2"></div>
                      </div>

                      <div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="passwordConfirm" data-error="Las contraseñas no coinciden"
                            data-success=""  class="left-align">Confirmar Nueva Contraseña</label>
                            <input id="passwordConfirm" type="password" name="newPassConf">
                        </div>
                        <div class="col s0 m2 l2"></div>
                      </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <input name="idAl" type="number" value="'. $id .'" hidden>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

        }

        mysqli_free_result($result);

        disconnect($connect);

        return $form;

    }

    function guardarAlumno($id, $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $nomTutor, $matr, $newP) {

        $connect = connect();

        if($newP){

            $query="UPDATE Usuario SET Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, CorreoElectronico=?, Telefono=?,
            fechaNacimiento=?, Password=? WHERE idUsuario=?";

        }else{

            $query="UPDATE Usuario SET Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, CorreoElectronico=?, Telefono=?,
            fechaNacimiento=? WHERE idUsuario=?";

        }

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }

        // Binding statement params
        if($newP){

            if (!$statement->bind_param("ssssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $newP, $id)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
            }

        }else{

            if (!$statement->bind_param("sssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $id)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
            }
        }

         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);




        $query="UPDATE Alumno  SET NombreTutor=?, Matricula=?  WHERE idUsuario=?";

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        // Binding statement params

        if (!$statement->bind_param("sss", $nomTutor, $matr, $id)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);

        //mysqli_free_result($result);

        disconnect($connect);

    }

     // -----------------------------------------------------------------------------------------------------------------------------//

     // -------------------------------VOLUNTARIOS-----------------------------------------------------------------------------------//


     function listaVoluntarios(){

        $connect = connect();

        $query =    "SELECT *
                    FROM Usuario U, Voluntario V
                    WHERE U.idUsuario = V.idUsuario
                    ORDER BY U.ApellidoPaterno";

        $result = mysqli_query($connect, $query);

        $tabla = "Voluntario";

        $table.=    '<br><br>
                    <ul class="collapsible" data-collapsible="expandable">';

        while($row = mysqli_fetch_array($result)){

            $fechaNacimiento = date_create($row['fechaNacimiento']);
            $fechaNacimiento = date_format($fechaNacimiento, 'd \d\e F \d\e Y');

            $table .= ' <li>
                            <div class="collapsible-header">
                                <strong>'. $row['ApellidoPaterno'] .' '. $row['ApellidoMaterno'] .' '. $row['Nombre'] .'</strong> (  '. $row['Ocupacion'] .'  )
                            </div>
                            <div class="collapsible-body">
                                <i class = "small material-icons">today</i> &nbsp &nbsp <strong>'. $fechaNacimiento .'</strong>
                                <br>
                                <i class = "small material-icons">email</i> &nbsp &nbsp <strong>'. $row['CorreoElectronico'] .'</strong>
                                <br>
                                <i class = "small material-icons">phone</i> &nbsp &nbsp <strong>'. $row['Telefono'] .' </strong>
                                <br>
                                <div class="right">
                                    <a href="editarVoluntario.php?id=' . $row["idUsuario"] . '"><i class="material-icons">mode_edit</i></a>
                                    <a><i class="material-icons delete" style="cursor:pointer"
                                    onclick=borrarItem('. $row['idUsuario'] .',"'. $tabla .'") >delete</i></a>
                                </div>
                            </div>
                        </li>';
        }

        $table .= '</ul>';



        mysqli_free_result($result);

        disconnect($connect);

        return $table;


    }


    function formaEditarVoluntario($id){

        $connect = connect();

        $query =    "SELECT *
                    FROM Usuario U, Voluntario V
                    WHERE U.idUsuario = V.idUsuario
                    AND U.idUsuario = ". $id ;

        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result)){

            $form .=    '<div class="row">
                            <div class="col s6 m2 l2"></div>
                            <div class="col s12 m8 l8">
                                <label for="first_name" class="left-align">
                                    Nombre
                                </label>
                                <input id="first_name" type="text" class="validate" name="nombreVoluntario" value="'. $row['Nombre'] .'" required>
                            </div>
                            <div class="col s6 m2 l2"></div>
                        </div>';

            $form .=    '<div class="row">
                            <div class="col s6 m2 l2"></div>
                            <div class="col s12 m4 l4">
                                <label for="last_name"  class="left-align">
                                    Apellido Paterno
                                </label>
                                <input id="last_name" type="text" class="validate" name="apellidoPaterno" value="'. $row['ApellidoPaterno'] .'" required>
                            </div>
                            <div class="col s12 m4 l4">
                                <label for="last_nameM"  class="left-align">
                                    Apellido Materno
                                    </label>
                                <input id="last_nameM" type="text" class="validate" name="apellidoMaterno" value="'. $row['ApellidoMaterno'] .'" required>
                            </div>
                            <div class="col s6 m2 l2"></div>
                        </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                        <!--<i class="material-icons prefix">mail</i>-->
                            <label for="email"  class="left-align">
                                Email
                            </label>
                            <input id="email" type="email" class="validate" name="correoElectronico" value="'. $row['CorreoElectronico'] .'" required>
                        </div>
                        <div class="col s12 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                        <!--<i class="material-icons prefix">phone</i>-->
                            <label for="telefono"  class="left-align">
                                Teléfono Celular
                            </label>
                            <input id="telefono" type="tel" class="validate" name="telefonoCelular" value="'. $row['Telefono'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="fechaNacimiento"  class="left-align">
                                Fecha de Nacimiento
                            </label>
                            <input id="fechaNacimiento" type="date" class="datepicker" name="fechaNacimiento" value="'. $row['fechaNacimiento'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="ocupacionVoluntario"  class="left-align">
                                Ocupación
                            </label>
                            <input id="ocupacionVoluntario" type="text" class= "validate" name="ocupacionVoluntario" value="'. $row['Ocupacion'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="password"  class="left-align">Nueva Contraseña</label>
                            <input id="password" type="password" class="validate" name="newPass" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,15}" data-length="15">
                        </div>
                        <div class="col s0 m2 l2"></div>
                      </div>

                      <div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="passwordConfirm" data-error="Las contraseñas no coinciden"
                            data-success=""  class="left-align">Confirmar Nueva Contraseña</label>
                            <input id="passwordConfirm" type="password" name="newPassConf">
                        </div>
                        <div class="col s0 m2 l2"></div>
                      </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <input name="idVol" type="number" value="'. $id .'" hidden>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

        }

        mysqli_free_result($result);

        disconnect($connect);

        return $form;

    }

    function guardarVoluntario($id, $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $ocup, $newP) {

        $connect = connect();

        if($newP){

            $query="UPDATE Usuario SET Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, CorreoElectronico=?, Telefono=?,
            fechaNacimiento=?, Password=? WHERE idUsuario=?";

        }else{

            $query="UPDATE Usuario SET Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, CorreoElectronico=?, Telefono=?,
            fechaNacimiento=? WHERE idUsuario=?";

        }

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }

        // Binding statement params
        if($newP){

            if (!$statement->bind_param("ssssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $newP, $id)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
            }

        }else{

            if (!$statement->bind_param("sssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $id)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
            }
        }

         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);




        $query="UPDATE Voluntario  SET Ocupacion=?  WHERE idUsuario=?";

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        // Binding statement params

        if (!$statement->bind_param("ss", $ocup, $id)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);

        //mysqli_free_result($result);

        disconnect($connect);

    }


    function nuevoVoluntario($nombre, $apellP, $apellM, $correo, $tel, $fechaN, $ocupacion, $pass){

        $connect = connect();

        $query='    INSERT INTO Usuario (Nombre, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Telefono,
                fechaNacimiento, Password, idRoles)
                VALUES (?,?,?,?,?,?,?,?)';

        $rol = "C";

        // Preparing the statement
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }

        // Binding statement params
        if (!$statement->bind_param("ssssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $pass, $rol)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }

        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);

        $last_id = $connect->insert_id;

        $query='    INSERT INTO Voluntario (idUsuario, Ocupacion)
                    VALUES (?,?)';

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        // Binding statement params
        if (!$statement->bind_param("ss", $last_id, $ocupacion)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }
        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }


        disconnect($connect);


    }


    // ------------------------------------------------------------------------------------------------------------------------------//

     // -------------------------------SERVICIO SOCIAL-----------------------------------------------------------------------------------//


     function listaServicioSocial(){
        $connect = connect();

        $query =    "SELECT *
                    FROM Usuario U, ServicioSocial S, UsuarioOrganizacion UO, Organizacion O
                    WHERE U.idUsuario = S.idUsuario
                    AND U.idUsuario = UO.idUsuario
                    AND UO.idOrganizacion = O.idOrganizacion
                    ORDER BY U.apellidoPaterno";

        $result = mysqli_query($connect, $query);

        $tabla = "ServicioSocial";

        $table.=    '<br><br>
                    <ul class="collapsible" data-collapsible="expandable">';

        while($row = mysqli_fetch_array($result)){

            $fechaNacimiento = date_create($row['fechaNacimiento']);
            $fechaNacimiento = date_format($fechaNacimiento, 'd \d\e F \d\e Y');
            if($row['tipoOrganizacion'] == 1){
                $tipoOrg = "Preparatoria";
            }else{
                $tipoOrg = "Universidad";
            }

            $table .= ' <li>
                            <div class="collapsible-header">
                                <strong>'. $row['ApellidoPaterno'] .' '. $row['ApellidoMaterno'] .' '. $row['Nombre'] .'</strong> ('. $row['nombreOrganizacion'] .'  )
                            </div>
                            <div class="collapsible-body">
                                <i class = "small material-icons">today</i> &nbsp &nbsp <strong>'. $fechaNacimiento .'</strong>
                                <br>
                                <i class = "small material-icons">email</i> &nbsp &nbsp <strong>'. $row['CorreoElectronico'] .'</strong>
                                <br>
                                <i class = "small material-icons">phone</i> &nbsp &nbsp <strong>'. $row['Telefono'] .' </strong>
                                <br>
                                <i class = "small material-icons">format_color_text</i> &nbsp &nbsp <strong>'. $row['Matricula'] .' </strong>
                                <br>
                                <i class = "small material-icons">school</i>
                                    &nbsp &nbsp
                                    <strong>'. $tipoOrg .' - '. $row['Semestre'] .'° semestre </strong>
                                <br>
                                <i class = "small material-icons">alarm</i> &nbsp &nbsp <strong>'. $row['horasCubiertas'] .' Horas Servicio</strong>
                                <div class="right">
                                    <a href="editarServicioSocial.php?id=' . $row["idUsuario"] . '"><i class="material-icons">mode_edit</i></a>
                                    <a><i class="material-icons delete" style="cursor:pointer"
                                    onclick=borrarItem('. $row['idUsuario'] .',"'. $tabla .'") >delete</i></a>
                                </div>
                            </div>
                        </li>';
        }

        $table .= '</ul>';



        mysqli_free_result($result);

        disconnect($connect);

        return $table;


    }


    function nuevoSS($nombre, $apellP, $apellM, $correo, $tel, $fechaN, $idOrg, $semestre, $matr, $pass){

        $connect = connect();

        $query='    INSERT INTO Usuario (Nombre, ApellidoPaterno, ApellidoMaterno, CorreoElectronico, Telefono,
                fechaNacimiento, Password, idRoles)
                VALUES (?,?,?,?,?,?,?,?)';

        $rol = "B";

        // Preparing the statement
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        // Binding statement params
       if (!$statement->bind_param("ssssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $pass, $rol)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }

        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);

        $last_id = $connect->insert_id;

        $query='    INSERT INTO ServicioSocial (idUsuario, Semestre, Matricula)
                    VALUES (?,?,?)';

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        // Binding statement params
        if (!$statement->bind_param("sss", $last_id, $semestre, $matr)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }
        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);

        $query='    INSERT INTO UsuarioOrganizacion (idUsuario, idOrganizacion)
                    VALUES (?,?)';

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $connect->errno . ") " . $connect->error);
        }
        // Binding statement params
        if (!$statement->bind_param("ss", $last_id, $idOrg)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }
        // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }


        disconnect($connect);


    }


    function formaEditarSS($id){

        $connect = connect();

        $query =    "SELECT *
                    FROM Usuario U, ServicioSocial SS, Organizacion O, UsuarioOrganizacion UO
                    WHERE U.idUsuario = SS.idUsuario
                    AND U.idUsuario = UO.idUsuario
                    AND UO.idOrganizacion = O.idOrganizacion
                    AND U.idUsuario = " . $id ."
                    ORDER BY U.ApellidoPaterno";

        $result = mysqli_query($connect, $query);

        while($row = mysqli_fetch_array($result)){

            $form .=    '<div class="row">
                            <div class="col s6 m2 l2"></div>
                            <div class="col s12 m8 l8">
                                <label for="first_name" class="left-align">
                                    Nombre
                                </label>
                                <input id="first_name" type="text" class="validate" name="nombreAlumno" value="'. $row['Nombre'] .'" required>
                            </div>
                            <div class="col s6 m2 l2"></div>
                        </div>';

            $form .=    '<div class="row">
                            <div class="col s6 m2 l2"></div>
                            <div class="col s12 m4 l4">
                                <label for="last_name"  class="left-align">
                                    Apellido Paterno
                                </label>
                                <input id="last_name" type="text" class="validate" name="apellidoPaterno" value="'. $row['ApellidoPaterno'] .'" required>
                            </div>
                            <div class="col s12 m4 l4">
                                <label for="last_nameM"  class="left-align">
                                    Apellido Materno
                                    </label>
                                <input id="last_nameM" type="text" class="validate" name="apellidoMaterno" value="'. $row['ApellidoMaterno'] .'" required>
                            </div>
                            <div class="col s6 m2 l2"></div>
                        </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="fechaNacimiento"  class="left-align">
                                Fecha de Nacimiento
                            </label>
                            <input id="fechaNacimiento" type="date" class="datepicker" name="fechaNacimiento" value="'. $row['fechaNacimiento'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                        <!--<i class="material-icons prefix">phone</i>-->
                            <label for="telefono"  class="left-align">
                                Teléfono Celular
                            </label>
                            <input id="telefono" type="tel" class="validate" name="telefonoCelular" value="'. $row['Telefono'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="email"  class="left-align">
                                Email
                            </label>
                            <input id="email" type="email" class="validate" name="correoElectronico" value="'. $row['CorreoElectronico'] .'" required>
                        </div>
                        <div class="col s12 m2 l2"></div>
                    </div>';

            $form.= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="organizacionSS">Organizacion</label>
                            <select name="organizacionSS">
                                '. listaOrganizaciones($row['idOrganizacion']) .'
                            </select>
                        </div>
                        <div class="col s12 m2 l3"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="semestre">Semestre</label>
                            <input type="number" name="semestre" class="validate" min="1" max="15" value="'. $row['Semestre'] .'" required>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="matricula">Matricula</label>
                            <input name="matricula" type="text" class="validate" value="'. $row['Matricula'] .'" required>
                        </div>
                        <div class="col s12 m2 l3"></div>
                    </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="password"  class="left-align">Nueva Contraseña</label>
                            <input id="password" type="password" class="validate" name="newPass" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,15}" data-length="15">
                        </div>
                        <div class="col s0 m2 l2"></div>
                      </div>

                      <div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <label for="passwordConfirm" data-error="Las contraseñas no coinciden"
                            data-success=""  class="left-align">Confirmar Nueva Contraseña</label>
                            <input id="passwordConfirm" type="password" name="newPassConf">
                        </div>
                        <div class="col s0 m2 l2"></div>
                      </div>';

            $form .= '<div class="row">
                        <div class="col s0 m2 l2"></div>
                        <div class="col s12 m8 l8">
                            <input name="idSS" type="number" value="'. $id .'" hidden>
                        </div>
                        <div class="col s0 m2 l2"></div>
                    </div>';

        }

        mysqli_free_result($result);

        disconnect($connect);

        return $form;

    }

    function guardarSS($id, $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $organ, $semestre, $matr, $newP) {

        $connect = connect();

        if($newP){

            $query="UPDATE Usuario SET Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, CorreoElectronico=?, Telefono=?,
            fechaNacimiento=?, Password=? WHERE idUsuario=?";

        }else{

            $query="UPDATE Usuario SET Nombre=?, ApellidoPaterno=?, ApellidoMaterno=?, CorreoElectronico=?, Telefono=?,
            fechaNacimiento=? WHERE idUsuario=?";

        }

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }

        // Binding statement params
        if($newP){

            if (!$statement->bind_param("ssssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $newP, $id)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
            }

        }else{

            if (!$statement->bind_param("sssssss", $nombre, $apellP, $apellM, $correo, $tel, $fechaN, $id)) {
                die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
            }
        }

         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);



        $query="UPDATE ServicioSocial  SET Semestre=?, Matricula=?  WHERE idUsuario=?";

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        // Binding statement params

        if (!$statement->bind_param("sss", $semestre, $matr, $id)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);



        $query="UPDATE UsuarioOrganizacion  SET idOrganizacion=? WHERE idUsuario=?";

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        // Binding statement params

        if (!$statement->bind_param("ss", $organ, $id)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        // var_dump($statement);

        disconnect($connect);

    }



    function listaOrganizaciones($idOrg){

        $connect = connect();

        $query = "  SELECT *
                    FROM Organizacion
                    ORDER BY nombreOrganizacion";

        $result = mysqli_query($connect, $query);

        if(!$idOrg){

            $options = "<option value='' disabled selected>Selecciona una opción</option>";

            while($row = mysqli_fetch_array($result)){

                $options .= '<option value="'. $row['idOrganizacion']  .'">'. $row['nombreOrganizacion']  . '</option>';

            }
        }else{

            $options = "<option value='' disabled>Selecciona una opción</option>";

            while($row = mysqli_fetch_array($result)){

                if($row['idOrganizacion'] == $idOrg){

                    $options .= '<option value="'. $row['idOrganizacion']  .'" selected>'. $row['nombreOrganizacion']  . '</option>';

                }else{

                    $options .= '<option value="'. $row['idOrganizacion']  .'">'. $row['nombreOrganizacion']  . '</option>';
                }



            }


        }



        mysqli_free_result($result);

        disconnect($connect);

        return $options;


    }


    // ------------------------------------------------------------------------------------------------------------------------------//

    // -------------------------------------------------CHANGE PASSWORD--------------------------------------------------------------//
    
    function changePassword($id, $newPass){

        $connect = connect();

        $query="UPDATE Usuario SET Password=? WHERE idUsuario=?";

        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }

        // Binding statement params
        if (!$statement->bind_param("ss", $newPass, $id)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }

         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }

        disconnect($connect);

    }
