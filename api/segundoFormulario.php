<!-- Alejandro Quesada Leiva B86205--> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
  
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>Recinto</title>
  <script language="JavaScript">

//Se usa js para hacer los calculos de lo que ingresa el usuario
function calcular(){

	prom = parseFloat(document.recinto.promedio.value); // promedio
	estilo = parseInt(document.recinto.style.value);
	sexo = parseInt(document.recinto.sex.value);
  
	
	document.final.prom.value = prom;
	document.final.estilo.value = estilo;
	document.final.sexo.value = sexo;

	
}

  </script> 

  <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8">

  
  <meta name="generator" content="Bluefish 2.2.2" >

  
  <style type="text/css">

body{
  background-color: #43A074;
}
	<!--
		@page { margin: 2cm }
		P { margin-bottom: 0cm; text-align: justify }
		P.western { so-language: es-ES }
	-->

    ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

	</style>
</head>
<body>

 <!-- Se hace el menu bar -->
    <ul>
        <li><a class="active" href="primerFormulario.php">Estilos de Aprendizaje</a></li>
        <li><a href="segundoFormulario.php">Adivina el recinto</a></li>
        <li><a href="tercerFormulario.php">Adivina el sexo</a></li>
        <li><a href="cuartoFormulario.php">Estilos de Aprendizaje 2</a></li>
        <li><a href="quintoFormulario.php">Tipo de profesor</a></li>
        <li><a href="sextoFormulario.php">Clasifiación de redes</a></li>
      </ul>
<form name="recinto" action="estilo.php" method="post">
    
<!-- Se limita el input numeral a que sea entre 0 y 10 -->
      Escriba su último promedio de matricula:<input type="number" min="0" max="10" name="promedio"><br>
       <!--Se le asignan valores a cada una de las opciones  -->
      Estilo de aprendizaje:<select name="style" value="styleA">
            <option value="1">divirgente</option>
            <option value="2">convergente</option>
            <option value="3">asimilador</option>
            <option value="4">acomodador</option>
            </select><br>
      Sexo:<select name="sex" value="Sexo">
            <option value="1">Femenino</option>
            <option value="2">Masculino</option>
            </select><br>

  <font color="#ff0000"><font size="4"> ------------------</font></font><input value="CALCULAR" onclick="calcular()" type="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</form>
<!-- Se guardan en estos inputs los resultados de los datos ingresados por el usuario -->
<form name="final"  method="POST">
<input name="prom" maxlength="12" size="12"  >
<input name="estilo" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="sexo" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 



  <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font><input name="submit" value="Obtener Resultado" type="submit">
</form>
</body></html>

<?php


include("conexionDB.php");//se instancia la clase
$con=conexionDB();//se llama a la funccion

//echo "Se logro una exitosa conexion a la base";

function resultadoFinal($recinto){
 // esta funcion ayudará a mostrar el resultado final al usuario

        echo "El resultado es: ".$recinto;
}

if ($_POST){ // evita errores
  $prom = $_POST["prom"];
  //echo "solo bueno".$prom;

  $estilo = $_POST["estilo"];
  //echo "solo bueno".$estilo;

  $sexo = $_POST["sexo"];
  //echo "solo bueno".$sexo;



  //haremos un array de los resultados obtenidos en la pag
  $resultadosPag = array($prom, $estilo, $sexo);
  //echo "sum(a) = " . array_sum($resultadosPag) . "</br>";

// estas variables ayudan a guarddar los valores numericos que se les asignaran a las datos que vienen de bd
$pm=0;
$rc=0;
$sx=0;
//Promedio, Estilo, Sexo 
$sql = "SELECT * FROM recinto"; 
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0){ //si hay mas de 0 filas ...
        while($row = mysqli_fetch_assoc($result)){

               $datas[]= $row;// lo que hace es insertar cada una de las filas de la tabla como arreglos en la variable datas[]
               
               
        }
}
//mysqli_fetch
//print_r($datas[0]);/// muestra la primera fila de la tabla
//echo "</br>sum(assssssssssssss) = " . array_sum($datas[0]) . "</br>";  //da la suma de la primera fila

$operacion=array(); // se tuvo que hacer array, ya que la funcion min solo me quizo  funcionar si le pasaba como parametro un array
//Se hace uso de la funcion array_sum para sumar los valores del arreglo que se obtuvo con la informacion suministrada
//por el usuario, a esto se le resta la suma de cada uno de los valores (pm,rc,sx) a su vez se usa la funcion pow para elevar a la 2
//y por ultimo la funcion sqrt para obtener la raiz de todo lo anterior ya descrito
for($i=0;$i<=76;$i++){//el que mueve de fila en fila en bd 76 porque hay de 77 registros de 0 a 76 hay 77

               //Reemplazaremos los valores string por int, con el fin  de facilitar el calculo de la formula 
               //esto lo haremos con ayuda de la condicional if
  if($datas[$i]['Promedio']){
    $pm= $datas[$i]['Promedio'];
   }
  
   if($datas[$i]['Estilo'] == 'DIVERGENTE'){
    $rc= "1";
   }else if ($datas[$i]['Estilo'] == 'CONVERGENTE'){
    $rc= "2";
   }
   else if ($datas[$i]['Estilo'] == 'ASIMILADOR'){
    $rc= "3";
   }
   else{
    $rc= "4";
   }

   if($datas[$i]['Sexo'] == 'F'){
     $sx= "1";
   }else{
    $sx= "2";
   }

        //(sumatoria del dado por el usuario - sumatoria de cada una de las filas de la tabla de la bd)^2
        $operacion[] = sqrt(pow((array_sum($resultadosPag)-($pm+$rc+$sx)),2));// sumatoria, elevar y sqrt
        //echo $operacion[$i]."</br>"; // da cada uno de los resultados de la operacion indicada arriba

  
}
//echo "ppppppppppppppppppppppppppppppppppppppppppppp".min($operacion);
//encuentra el minimo del arreglo operacion y lo compara con cada uno de los resultados obtenidos de operacion en el indice j
//esto con el fin de obtener la fila en la base de datos que contiene esa informacion
//y con ello el recinto al cual esta mas cercano
$recintoFinalMasParecido="";
for($j=0;$j<=76;$j++){

        if($operacion[$j] == min($operacion)){
                $recintoFinalMasParecido = $datas[$j]['Recinto']; // se guarda en la variable "recintoFinalMasParecido..." el resultado final
                
          
        }        

}

resultadoFinal($recintoFinalMasParecido); //se usa la funcion de arriba y se le pasa como parametro variable "recintoFinalMasParecido..."

}else{
  echo "Debes precionar primero el boton de calcular, y luego el boton de obtener resultado";
}



?>