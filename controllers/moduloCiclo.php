<?php 


    include_once("moduloSesiones.php");
 

    
    
    function infoCiclo(){
        
        
        $connect = connect();
        
          $query = 'SELECT * FROM Ciclo';
        
        $result = mysqli_query($connect, $query);
        
        $fechaInicio = date_create($row['fechaInicio']);
        
        while($row = mysqli_fetch_array($result)){
            
            setlocale(LC_TIME, 'es_ES.UTF-8');
            date_default_timezone_set ('America/Mexico_City');
            
            $mesV = date_create ($row['fechaInicio']);
            $mesV = date_format($mesV, 'F');
            
            $mesP = date_create($row['fechaTermino']);
            $mesP = date_format($mesP,'F');


            if ($mesV == 'January'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \E\n\e\r\o \d\e\l Y');
            }
            
            if ($mesV == 'February'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \F\e\b\r\e\r\o \d\e\l Y');
            }            
            if ($mesV == 'March'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \M\a\r\z\o \d\e\l Y');
            }
            
            if ($mesV == 'April'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \A\b\r\i\l \d\e\l Y');
            }
            if ($mesV == 'May'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \M\a\y\o \d\e\l Y');
            }
            
            if ($mesV == 'June'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \J\u\n\i\o \d\e\l Y');
            }            
            if ($mesV == 'July'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \J\u\l\i\o \d\e\l Y');
            }
            
            if ($mesV == 'August'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \A\g\o\s\t\o \d\e\l Y');
            }
            if ($mesV == 'September'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \S\e\p\t\i\e\m\b\r\e \d\e\l Y');
            }
            
            if ($mesV == 'October'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \O\c\t\u\b\r\e \d\e\l Y');
            }
            if ($mesV == 'November'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \N\o\v\i\e\m\b\r\e \d\e\l Y');
            }
            
            if ($mesV == 'December'){
                $fechaInicio = date_create($row['fechaInicio']);
                $fechaInicio = date_format($fechaInicio, 'd \d\e \D\i\c\i\e\m\b\r\e \d\e\l Y');
            } 
            
            // $fechaInicio = date_create($row['fechaInicio']);
            // // $fechaInicio = date_format($fechaInicio, 'd \d\e F \d\e\l Y');
            
            //  $fechaInicio = date_format($fechaInicio, 'd \d\e F \d\e\l Y');
            
            if ($mesP == 'January'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \E\n\e\r\o \d\e\l Y');
            }
            
            if ($mesP == 'February'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \F\e\b\r\e\r\o \d\e\l Y');
            }            
            if ($mesP == 'March'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \M\a\r\z\o \d\e\l Y');
            }
            
            if ($mesP == 'April'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \A\b\r\i\l \d\e\l Y');
            }
            if ($mesP == 'May'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \M\a\y\o \d\e\l Y');
            }
            
            if ($mesP == 'June'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \J\u\n\i\o \d\e\l Y');
            }            
            if ($mesP == 'July'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \J\u\l\i\o \d\e\l Y');
            }
            
            if ($mesP == 'August'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \A\g\o\s\t\o \d\e\l Y');
            }
            if ($mesP == 'September'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \S\e\p\t\i\e\m\b\r\e \d\e\l Y');
            }
            
            if ($mesP == 'October'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \O\c\t\u\b\r\e \d\e\l Y');
            }
            if ($mesP == 'November'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \N\o\v\i\e\m\b\r\e \d\e\l Y');
            }
            
            if ($mesP == 'December'){
                $fechaTermino = date_create($row['fechaTermino']);
                $fechaTermino = date_format($fechaTermino, 'd \d\e \D\i\c\i\e\m\b\r\e \d\e\l Y');
            } 
            
            // $fechaTermino = date_create($row['fechaTermino']);
            // $fechaTermino = date_format($fechaTermino, 'd \d\e F \d\e\l Y');
            
            $info = '<span class="card-title"><strong>'. $row['nombreCiclo'] .'</strong></span>
                    <ul>
                        <li><strong>Fecha de Inicio: </strong>'. $fechaInicio .'</li>
                        <li><strong>Fecha de Término: </strong>'. $fechaTermino .'</li>
                    </ul>';
            
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $info;
        
    }
    
    
    
    function editarCiclo(){
        
        $connect = connect();
        
        $query = "SELECT * FROM Ciclo";
        
        $result = mysqli_query($connect, $query);
        
        $forma = '<nav id="titulo"  class="cyan">
                    <div class="container">
                        <div class="nav-wrapper"><a class="page-title">EDITAR CICLO</a></div>
                    </div>
                </nav>
                
                <a class="btn-large cyan top btn-flat"><i class="material-icons cwhite" onclick="goBack()">arrow_back</i></a>
                
                
                <div class="center-align">
                    
                    <br><br>
                    <form  action="editarCiclo.php" method="POST" >
                        <div class="row">
                            <div class="input-field col s3"></div>
                            <div class="input-field col s6">';
                            
        while($row = mysqli_fetch_array($result)){
            

            
            $forma .= '<label for="nombre_ciclo" >Nombre</label>
                        <input id="nombre_ciclo" name="nombreCiclo" type="text" class="validate"
                            data-length="40" value="'. $row['nombreCiclo'] .'" required>
                        <span class = "error"></span>
                    </div>
                    <div class="input-field col s3"></div>
                </div>
                
                <div class="row">
                    <div class="input-field col s3"></div>
                    <div class="input-field col s6">
                        <input id="fechaInicio" name="fechaInicio" type="date" class="datepicker"
                            value="'. $row['fechaInicio'].'" required>
                        <label for="fechaInicio">Fecha de Inicio</label>
                    </div>
                    <div class="input-field col s3"></div>
                </div>
                
                <div class="row">
                    <div class="input-field col s3"></div>
                    <div class="input-field col s6">
                        <input id="fechaTermino" name="fechaTermino" type="date" class="datepicker"
                            value="'. $row['fechaTermino'] .'" required>
                        <label for="fechaTermino">Fecha de Término</label>
                    </div>
                    <div class="input-field col s3"></div>
                </div>';
        }
        
        
        mysqli_free_result($result);
        
        disconnect($connect);
    
        return $forma;
    
        
    }
    
    
    function guardarCiclo($inicio, $termino, $nombre){
        
        $fechaI = date_create($inicio);
        $fechaT = date_create($termino);
            
        $connect = connect();
        
        $query="UPDATE Ciclo SET nombreCiclo=?, fechaInicio=?, fechaTermino=?";
            
        if (!($statement = $connect->prepare($query))) {
            die("Preparation failed: (" . $mysql->errno . ") " . $mysql->error);
        }
        
        // Binding statement params 
        if (!$statement->bind_param("sss", $nombre, $inicio, $termino)) {
            die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error); 
        }
        
         // Executing the statement
        if (!$statement->execute()) {
            die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        } 
        
        disconnect($connect);

        
        
        
    }


    function getFechaInicio(){
        
        $connect = connect();
        
        $query = 'SELECT fechaInicio FROM Ciclo';
        
        $result = mysqli_query($connect, $query);
        
        while($row = mysqli_fetch_array($result)){
        
            $fechaInicio = date_create($row['fechaInicio']);
            
        }
        
        mysqli_free_result($result);
        
        disconnect($connect);
        
        $today = new DateTime();
        
        if($today < $fechaInicio){
            
            return 1;
            
        }else{
            
            return 0;
        }
        
    }

?>