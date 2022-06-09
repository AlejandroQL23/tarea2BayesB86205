<!-- Alejandro Quesada Leiva B86205--> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
  
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>Estilos</title>

  
  
  <script language="JavaScript">

//Se calculan los campos correspondientes
function calcular(){

	ec = parseInt(document.estilo.c5.value)+parseInt(document.estilo.c9.value)+parseInt(document.estilo.c13.value)+parseInt(document.estilo.c17.value)+parseInt(document.estilo.c25.value)+parseInt(document.estilo.c29.value);
	or = parseInt(document.estilo.c2.value)+parseInt(document.estilo.c10.value)+parseInt(document.estilo.c22.value)+parseInt(document.estilo.c26.value)+parseInt(document.estilo.c30.value)+parseInt(document.estilo.c34.value);
	ca = parseInt(document.estilo.c7.value)+parseInt(document.estilo.c11.value)+parseInt(document.estilo.c15.value)+parseInt(document.estilo.c19.value)+parseInt(document.estilo.c31.value)+parseInt(document.estilo.c35.value);
	ea = parseInt(document.estilo.c4.value)+parseInt(document.estilo.c12.value)+parseInt(document.estilo.c24.value)+parseInt(document.estilo.c28.value)+parseInt(document.estilo.c32.value)+parseInt(document.estilo.c36.value);

	
	document.final.EC.value = ec;
	document.final.RO.value = or;
	document.final.CA.value = ca;
	document.final.EA.value = ea;
	
}

  </script> <!-- aprovecho los calculos de EC,OR,CA y EA que ya se nos daban--> 
  <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8">
  <meta name="generator" content="Bluefish 2.2.2" >

  
  <style type="text/css">
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
body{
  background-color: #43A074;
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
      
<p class="western" align="justify" lang="es-ES"><font color="#FF0000"><font size="3"><b>CUAL ES SU ESTILO DE APRENDIZAJE?</b></font></font></p>
<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"><b>Instrucciones:</b></font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> </font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> Para
utilizar el instrumento usted debe conceder una calificación alta a
aquellas palabras que mejor caracterizan la forma en que usted
aprende, y una calificación baja a las palabras que menos
caracterizan su estilo de aprendizaje.</font></font></p>

<p class="western" lang="es-ES"> Le puede ser difícil seleccionar
las palabras que mejor describen su estilo de aprendizaje, ya que no
hay respuestas correctas o incorrectas.</p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> Todas
las respuestas son buenas, ya que el fin del instrumento es describir
cómo y no juzgar su habilidad para aprender.</font></font></p>

<p class="western" align="justify" lang="es-ES"><font color="#000000"><font size="3"> De
inmediato encontrará nueve series o líneas de cuatro palabras cada una.
Ordene de mayor a menor cada serie o juego de cuatro palabras que hay en cada línea,
ubicando 4 en la palabra que mejor caracteriza su estilo de
aprendizaje, un 3 en la palabra siguiente en cuanto a la
correspondencia con su estilo; a la siguiente un 2, y un 1 a la
palabra que menos caracteriza su estilo. Tenga cuidado de ubicar un
número distinto al lado de cada palabra en la misma línea. </font></font></p>

<big><big><br>
Yo aprendo...</big></big>
<form name="estilo" >
  <table style="text-align: left; width: 100%;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c1">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
discerniendo<br>
        </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c2">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
ensayando<br>
        </td>
        <td style="vertical-align: top;">
        <select name="c3">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
involucrándome</td>
        <td style="vertical-align: top;">
        <select name="c4">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
practicando</td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c5">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
receptivamente </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c6">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
relacionando </td>
        <td style="vertical-align: top;">
        <select name="c7">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
analíticamente </td>
        <td style="vertical-align: top;">
        <select name="c8">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
imparcialmente </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c9">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
sintiendo </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c10">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
observando </td>
        <td style="vertical-align: top;">
        <select name="c11">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
pensando </td>
        <td style="vertical-align: top;">
        <select name="c12">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
haciendo </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c13">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aceptando </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c14">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
arriesgando </td>
        <td style="vertical-align: top;">
        <select name="c15">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
evaluando </td>
        <td style="vertical-align: top;">
        <select name="c16">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
con cautela </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c17">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
intuitivamente </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c18">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
productivamente </td>
        <td style="vertical-align: top;">
        <select name="c19">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
lógicamente </td>
        <td style="vertical-align: top;">
        <select name="c20">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
cuestionando </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c21">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
abstracto </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c22">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
observando </td>
        <td style="vertical-align: top;">
        <select name="c23">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
concreto </td>
        <td style="vertical-align: top;">
        <select name="c24">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
activo </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c25">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
orientado al presente </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c26">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
reflexivamente </td>
        <td style="vertical-align: top;">
        <select name="c27">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
orientado hacia el futuro </td>
        <td style="vertical-align: top;">
        <select name="c28">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
pragmático </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c29">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la experiencia </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c30">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la observación </td>
        <td style="vertical-align: top;">
        <select name="c31">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la conceptualización </td>
        <td style="vertical-align: top;">
        <select name="c32">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
aprendo más de la experimentación </td>
      </tr>
      <tr>
        <td style="vertical-align: top; width: 25%;">
        <select name="c33">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
emotivo </td>
        <td style="vertical-align: top; width: 25%;">
        <select name="c34">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
reservado </td>
        <td style="vertical-align: top;">
        <select name="c35">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
racional </td>
        <td style="vertical-align: top;">
        <select name="c36">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        </select>
abierto </td>
      </tr>

    </tbody>
  </table>
  <br>
  <font color="#ff0000"><font size="4"> ------------------</font></font><input value="CALCULAR" onclick="calcular()" type="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</form>
<!-- Estos son los inputs usados para captar la informacion ingresada por el usuario -->
<form name="final"  method="POST">
<input name="EC" maxlength="12" size="12"  >
<input name="RO" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="CA" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="EA" maxlength="12" size="12"  ><br>


  <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font><input name="submit" value="Obtener Resultado" type="submit">
</form>

</body></html>

<?php

include("conexionDB.php"); //se instanncia la clase
$con=conexionDB();//se llama la funcion

//echo "Se logro una exitosa conexion a la base";

function resultadoFinal($aprendizaje){ // esta funcion ayudará a mostrar el resultado final al usuario

        echo "Tu tipo de aprendizaje segun el cálculo es: ".$aprendizaje;
}

//obtenemos los resultados aprovechando las sumatorias desde el js
if ($_POST){ // evita errores
        $ec = $_POST["EC"];
       // echo "solo bueno".$ec;

        $ro = $_POST["RO"];
       // echo "solo bueno".$ro;

        $ca = $_POST["CA"];
      //  echo "solo bueno".$ca;

        $ea = $_POST["EA"];
       // echo "solo bueno".$ea;

        //haremos un array de los resultados obtenidos en la pag
        $resultadosPag = array($ca, $ec, $ea, $ro);
        //echo "sum(a) = " . array_sum($resultadosPag) . "\n";







$sql = "SELECT * FROM estilos1"; // se tuvo que hacer un cambio de nombre en la columna OR por RO ya que la identificaba como una op logica
$result = mysqli_query($con, $sql); // conexion y sentencia
$datas = array(); // se inicializa la variable datas
if(mysqli_num_rows($result)>0){ //si hay mas de 0 filas ...
 
        while($row = mysqli_fetch_assoc($result)){
                $datas[]= $row;// lo que hace es insertar cada una de las filas de la tabla de BD como arreglos en la variable datas[]

        }
}
//mysqli_fetch
//print_r($datas[0]);/// muestra la primera fila de la tabla
//echo "sum(assssssssssssss) = " . array_sum($datas[0]) . "\n";  //da la suma de la primera fila

$operacion=array(); // se tuvo que hacer array, ya que la funcion min solo me quizo  funcionar si le pasaba como parametro un array
//Se hace uso de la funcion array_sum para sumar los valores del arreglo que se obtuvo con la informacion suministrada
//por el usuario, a esto se le resta la suma de cada uno de los valores (EC,RO,CA,EA) a su vez se usa la funcion pow para elevar a la 2
//y por ultimo la funcion sqrt para obtener la raiz de todo lo anterior ya descrito
for($i=0;$i<=221;$i++){//el que mueve de fila en fila en bd 221 porque hay de 222 registros de 0 a 221 hay 222

        //(sumatoria del dado por el usuario - sumatoria de cada una de las filas-columnas de la tabla de la bd)^2
        $operacion[] = sqrt(pow((array_sum($resultadosPag)-($datas[$i]['EC']+$datas[$i]['RO']+$datas[$i]['CA']+$datas[$i]['EA'])),2));// sumatoria, elevar y sqrt
        //se tratan los datos de la bd como una matriz para traer solo los datos necesarios
       // echo $operacion[$i]."</br>"; // da cada uno de los resultados de la operacion indicada arriba
}

//encuentra el minimo del arreglo operacion y lo compara con cada uno de los resultados obtenidos de operacion en el indice j
//esto con el fin de obtener la fila en la base de datos que contiene esa informacion
//y con ello el estilo al cual esta mas cercana
$estiloFinalMasParecido="";
for($j=0;$j<=221;$j++){//el que mueve de fila en fila

        if($operacion[$j] == min($operacion)){
                $estiloFinalMasParecido = $datas[$j]['Estilo']; // se guarda en la variable "estiloFinal..." el resultado final 
        }        
}

        resultadoFinal($estiloFinalMasParecido);//se usa la funcion de arriba y se le pasa como parametro variable "estiloFinal..."

}else{
        echo "Debes precionar primero el boton de calcular, y luego el boton de obtener resultado";
}
?>