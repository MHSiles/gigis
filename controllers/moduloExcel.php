<?php

    include_once("moduloSesiones.php");
    
    if($_GET['reporte'] == 1){
        excelAlumnos();
    } else if($_GET['reporte'] == 2){
        excelVoluntarios();
    } else if($_GET['reporte'] == 3){
        excelSS();
    } else if($_GET['reporte'] == 4){
        excelProgramas();
    }
    
    function excelAlumnos(){
        
        $connect = connect();
    
        $query = "SELECT U.idUsuario , A.Matricula, U.ApellidoPaterno, U.ApellidoMaterno,
                        U.Nombre, U.fechaNacimiento, A.NombreTutor, U.Telefono, U.CorreoElectronico
                  FROM Usuario U, Alumno A
                  WHERE U.idUsuario = A.idUsuario   
                  AND idRoles = 'A'
                  ORDER BY U.ApellidoPaterno";
                  
        $result = mysqli_query($connect, $query);
        
        function cleanData(&$str){
            
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')){
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
            
        }
        
        // file name for download
        $filename = "Reporte_Alumnos_" . date('Y/m/d') . ".csv";
        
        
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        
        echo pack("CCC",0xef,0xbb,0xbf);
        
        $flag = true;
        
        foreach($result as $row){
        
            $query2 = "  SELECT DISTINCT P.nombrePrograma as 'Programas Registrados'
                                FROM Usuario U, UsuarioActividad UA, Actividad A, Programa P
                                WHERE UA.idUsuario = U.idUsuario
                                AND A.idActividad = UA.idActividad
                                AND P.idPrograma = A.idPrograma
                                AND U.idUsuario = " . $row['idUsuario'] ."
                                ORDER BY P.nombrePrograma";
                                
            $result2 = mysqli_query($connect, $query2);
        
            if($flag) {
                
                // display field/column names as first row
                echo 'Matrícula Gigis';
                echo "," . 'Apellido Paterno';
                echo "," . 'Apellido Materno';
                echo "," . 'Nombre';
                echo "," . 'Fecha de Nacimiento';
                echo "," . 'Padre / Madre';
                echo "," . 'Telefono';
                echo "," . 'Correo Electronico';
                echo "," . 'Programas Registrados' . "\n";
                // echo implode("\t", array_keys($result2)) . "\n";
                $flag = false;
            }
            
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo $row['Matricula'];
            echo "," . $row['ApellidoPaterno'];
            echo "," . $row['ApellidoMaterno'];
            echo "," . $row['Nombre'];
            echo "," . $row['fechaNacimiento'];
            echo "," . $row['NombreTutor'];
            echo "," . $row['Telefono'];
            echo "," . $row['CorreoElectronico'];
            
            // echo implode("\t", array_values($row));
            echo",";
            
            foreach($result2 as $row2){
                
                echo $row2['Programas Registrados'];
                echo " | ";
            }
            
            echo "\n";
            
        }
        
        exit;
    }
    
    //------------------------------------------------------------------------------------------------//
    
    function excelVoluntarios(){
        
        $connect = connect();
    
        $query = "SELECT U.idUsuario, U.ApellidoPaterno, U.ApellidoMaterno,
                        U.Nombre, V.Ocupacion, U.fechaNacimiento, U.Telefono, U.CorreoElectronico
                  FROM Usuario U, Voluntario V
                  WHERE U.idUsuario = V.idUsuario   
                  AND idRoles = 'C'
                  ORDER BY U.ApellidoPaterno";
                  
        $result = mysqli_query($connect, $query);
        
        function cleanData(&$str){
            
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')){
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
            
        }
        
        // file name for download
        $filename = "Reporte_Voluntarios_" . date('Y/m/d') . ".csv";
        
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        
        echo pack("CCC",0xef,0xbb,0xbf);
        
        $flag = true;
        
        foreach($result as $row){
        
            $query2 = "  SELECT DISTINCT P.nombrePrograma as 'Programas Registrados'
                                FROM Usuario U, UsuarioActividad UA, Actividad A, Programa P
                                WHERE UA.idUsuario = U.idUsuario
                                AND A.idActividad = UA.idActividad
                                AND P.idPrograma = A.idPrograma
                                AND U.idUsuario = " . $row['idUsuario'] ."
                                ORDER BY P.nombrePrograma";
                                
            $result2 = mysqli_query($connect, $query2);
        
            if($flag) {
                // display field/column names as first row
                echo 'Apellido Paterno';
                echo "," . 'Apellido Materno';
                echo "," . 'Nombre';
                echo "," . 'Ocupacion';
                echo "," . 'Fecha de Nacimiento';
                echo "," . 'Teléfono';
                echo "," . 'Correo Electronico';
                echo "," . 'Programas Registrados' . "\n";
                // echo implode("\t", array_keys($result2)) . "\n";
                $flag = false;
            }
            
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo $row['ApellidoPaterno'];
            echo "," . $row['ApellidoMaterno'];
            echo "," . $row['Nombre'];
            echo "," . $row['Ocupacion'];
            echo "," . $row['fechaNacimiento'];
            echo "," . $row['Telefono'];
            echo "," . $row['CorreoElectronico'];
            
            // echo implode("\t", array_values($row));
            echo",";
            
            foreach($result2 as $row2){
                
                echo $row2['Programas Registrados'];
                echo " | ";
            }
            
            echo "\n";
            
        }
        
        exit;
    }


    //------------------------------------------------------------------------------------------//
    
    function excelSS(){
        
        $connect = connect();
        
        $query = "  SELECT U.idUsuario, U.ApellidoPaterno, U.ApellidoMaterno,
                        U.Nombre, U.fechaNacimiento, U.Telefono, U.CorreoElectronico, O.nombreOrganizacion,
                        SS.Matricula, SS.Semestre, O.horasCubiertas
                    FROM Usuario U, ServicioSocial SS, UsuarioOrganizacion UO, Organizacion O
                    WHERE U.idUsuario = SS.idUsuario
                    AND U.idUsuario = UO.idUsuario
                    AND O.idOrganizacion = UO.idOrganizacion
                    AND idRoles = 'B'
                    ORDER BY U.ApellidoPaterno";
                  
        $result = mysqli_query($connect, $query);
        
        function cleanData(&$str){
            
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')){
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
            
        }
        
        // file name for download
        $filename = "Reporte_ServicioSoc_" . date('Y/m/d') . ".csv";
        
        
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        
        echo pack("CCC",0xef,0xbb,0xbf);
        
        
        $flag = true;
        
        foreach($result as $row){
        
            $query2 = "  SELECT DISTINCT P.nombrePrograma as 'Programas Registrados'
                                FROM Usuario U, UsuarioActividad UA, Actividad A, Programa P
                                WHERE UA.idUsuario = U.idUsuario
                                AND A.idActividad = UA.idActividad
                                AND P.idPrograma = A.idPrograma
                                AND U.idUsuario = " . $row['idUsuario'] ."
                                ORDER BY P.nombrePrograma";
                                
            $result2 = mysqli_query($connect, $query2);
        
            if($flag) {
                // display field/column names as first row
                echo 'Apellido Paterno';
                echo "," . 'Apellido Materno';
                echo "," . 'Nombre';
                echo "," . 'Fecha de Nacimiento';
                echo "," . 'Telefono';
                echo "," . 'Correo Electronico';
                echo "," . 'Organización';
                echo "," . 'Matrícula';
                echo "," . 'Semestre';
                echo "," . 'Horas de Servicio';
                echo "," . 'Programas Registrados' . "\n";
                // echo implode("\t", array_keys($result2)) . "\n";
                $flag = false;
            }
            
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo $row['ApellidoPaterno'];
            echo "," . $row['ApellidoMaterno'];
            echo "," . $row['Nombre'];
            echo "," . $row['fechaNacimiento'];
            echo "," . $row['Telefono'];
            echo "," . $row['CorreoElectronico'];
            echo "," . $row['nombreOrganizacion'];
            echo "," . $row['Matricula'];
            echo "," . $row['Semestre'];
            echo "," . $row['horasCubiertas'];
            
            // echo implode("\t", array_values($row));
            echo",";
            
            foreach($result2 as $row2){
                
                echo $row2['Programas Registrados'];
                echo " | ";
            }
            
            echo "\n";
            
        }
        
        exit;
    }
    
    
    
    //------------------------------------------------------------------------------------------//
    
    
    function excelProgramas(){
        
        $connect = connect();
        
        $query = "  SELECT C.nombreCiclo, P.nombrePrograma
                    FROM Programa P, Ciclo C";
                  
        $result = mysqli_query($connect, $query);
        //mysqli_set_charset($resul,"utf8");
        
        function cleanData(&$str){
            
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')){
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
            
        }
        
        // file name for download
        $filename = "Reporte_Programas_" . date('Y/m/d') . ".csv";
        
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        
        echo pack("CCC",0xef,0xbb,0xbf);
        
        $flag = true;
        
        foreach($result as $row){
        
            if($flag) {
                // display field/column names as first row
                echo 'Ciclo';
                echo "," . 'Programa' . "\n";
                // echo implode("\t", array_keys($result2)) . "\n";
                $flag = false;
            }
            
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo $row['nombreCiclo'];
            echo "," . $row['nombrePrograma'];
            
            // echo implode("\t", array_values($row));
            
            echo ",";
            
            echo "\n";
            
        }
        
        exit;
    }
    
    

?>