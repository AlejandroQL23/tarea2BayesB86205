<!-- Alejandro Quesada Leiva B86205--> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
  
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>Tipo de profesor</title>

  <script language="JavaScript">

//Se usa js para hacer los calculos de lo que ingresa el usuario
  function calcular(){

  Fiabilidad = parseInt(document.redes.Fiabilidad.value);
  links = parseInt(document.redes.links.value);
  ccap = parseInt(document.redes.ccap.value);
  ccos = parseInt(document.redes.ccos.value);
  
	
	document.final.Fiabilidad.value = Fiabilidad;
	document.final.links.value = links;
  document.final.ccap.value = ccap;
  document.final.ccos.value = ccos;

	
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



<form name="redes" action="estilo.php" method="post">
        

             <!-- Se limita el input numeral a que sea entre 2 y 5 -->
  Fiabilidad de la red (de 2 a 5)&nbsp;&nbsp; <input type="number" min="2" max="5" name="Fiabilidad">
  <br>
      <!-- Se limita el input numeral a que sea entre 7 y 20 -->
  Numero de links(de 7 a 20)&nbsp;&nbsp; <input type="number" min="7" max="20" name="links">
  <br>
   <!--Se le asignan valores a cada una de las opciones  -->
    Capacidad de red:<select name="ccap" value="ccap">
         <option value="1">nula</option>
         <option value="2">media</option>
         <option value="3">alta</option>
         </select><br>
    Costo de red:<select name="ccos" value="ccos">
          <option value="1">nula</option>
          <option value="2">media</option>
          <option value="3">alta</option>
          </select><br>
          <font color="#ff0000"><font size="4"> ------------------</font></font><input value="CALCULAR" onclick="calcular()" type="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</form>
<!-- Se guardan en estos inputs los resultados de los datos ingresados por el usuario -->
<form name="final"  method="POST">
<input name="Fiabilidad" maxlength="12" size="12"  >
<input name="links" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="ccap" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="ccos" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 




  <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font><input name="submit" value="Obtener Resultado" type="submit">
</form>
</body></html>

<?php

include("conexionDB.php");// se instancia la clase
$con=conexionDB();//se llama a la funcion 

//echo "Se logro una exitosa conexion a la base";

function resultadoFinal($redes){ // esta funcion ayudará a mostrar el resultado final al usuario

        echo "El resultado es: ".$redes;
}

if ($_POST){ // evita errores
  $Fiabilidad = $_POST["Fiabilidad"];
  //echo "solo bueno".$Fiabilidad;

  $links = $_POST["links"];
  //echo "solo bueno".$links;

  $ccap = $_POST["ccap"];
  //echo "solo bueno".$ccap;

  $ccos = $_POST["ccos"];
  //echo "solo bueno".$ccos;

  //haremos un array de los resultados obtenidos en la pag
  $resultadosPag = array($Fiabilidad, $links, $ccap, $ccos);
  //echo "sum(a) = " . array_sum($resultadosPag) . "\n";

// estas variables ayudan a guarddar los valores numericos que se les asignaran a las datos que vienen de bd
$fia=0;
$lik=0;
$cp=0;
$cto=0;
$sql = "SELECT * FROM redes"; 
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){//si hay mas de 0 filas ...
        while($row = mysqli_fetch_assoc($result)){

          $datas[]= $row;// lo que hace es insertar cada una de las filas de la tabla como arreglos en la variable datas[] 
               
        }
}
//mysqli_fetch
//print_r($datas[0]);/// muestra la primera fila de la tabla
//echo "sum(assssssssssssss) = " . array_sum($datas[0]) . "\n";  //da la suma de la primera fila

$operacion=array(); // se tuvo que hacer array, ya que la funcion min solo me quizo  funcionar si le pasaba como parametro un array
//Se hace uso de la funcion array_sum para sumar los valores del arreglo que se obtuvo con la informacion suministrada
//por el usuario, a esto se le resta la suma de cada uno de los valores (fia,lik,cp,cto) a su vez se usa la funcion pow para elevar a la 2
//y por ultimo la funcion sqrt para obtener la raiz de todo lo anterior ya descrito
for($i=0;$i<=34;$i++){//el que mueve de fila en fila en bd 34 porque hay de 35 registros de 0 a 34 hay 35

  //Reemplazaremos los valores string por int, con el fin  de facilitar el calculo de la formula 
               //esto lo haremos con ayuda de la condicional if

               if($datas[$i]["Reliability"]){
                $fia= $datas[$i]["Reliability"];
               }

               if($datas[$i]["Numberoflinks"]){
                $lik= $datas[$i]["Numberoflinks"];
               }

               if($datas[$i]['Capacity'] == 'Low'){
                $cp= "1";
              }else if ($datas[$i]['Capacity'] == 'Medium'){
                $cp= "2";
              }
              else{
                $cp= "3";
               }

               if($datas[$i]['Costo'] == 'Low'){
                $cto= "1";
              }else if ($datas[$i]['Costo'] == 'Medium'){
                $cto= "2";
              }
              else{
                $cto= "3";
               }
            

        //(sumatoria del dado por el usuario - sumatoria de cada una de las filas de la tabla de la bd)^2
        $operacion[] = sqrt(pow((array_sum($resultadosPag)-($fia+ $lik+ $cp+ $cto)),2));// sumatoria y elevar
       // echo $operacion[$i]."</br>"; // da cada uno de los resultados de la operacion indicada arriba
       
}
//echo min($operacion)." este es el valor minimo de todos los resultados xd</br>"; // esto nos da el valor minimo de todos los resultados guardados en este array
//encuentra el minimo del arreglo operacion y lo compara con cada uno de los resultados obtenidos de operacion en el indice j
//esto con el fin de obtener la fila en la base de datos que contiene esa informacion
//y con ello la red a la cual esta mas cercana
$redesFinalMasParecido="";
for($j=0;$j<=19;$j++){

        if($operacion[$j] == min($operacion)){
                $redesFinalMasParecido = $datas[$j]['Class']; // se guarda en la variable "redesFinalMasParecido..." el resultado final             
        }        

}
        resultadoFinal($redesFinalMasParecido); //se usa la funcion de arriba y se le pasa como parametro variable "redesFinalMasParecido..."
}else{
  echo "Debes precionar primero el boton de calcular, y luego el boton de obtener resultado";
}


?>