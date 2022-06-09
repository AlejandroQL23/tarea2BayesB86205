<!-- Alejandro Quesada Leiva B86205--> 
<?php

    function conexionDB(){

      //se definen los parametros que son necesarios par utilizar mysqli
        $servidor="163.178.107.10";
        $usuario="laboratorios";
        $contraseña="KmZpo.2796";
        $db="if7103_tardos_b86205";


        
        $conexion = new mysqli($servidor,$usuario,$contraseña,$db); //permite la conexion

        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error(); //por si se da un error
          exit();
        }
        return $conexion;

    }



?>