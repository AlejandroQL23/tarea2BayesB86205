<!-- Alejandro Quesada Leiva B86205--> 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
  
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <title>Tipo de profesor</title>

  <script language="JavaScript">

//Se usa js para hacer los calculos de lo que ingresa el usuario
function calcular(){

ag = parseFloat(document.profe.ag.value);
sex = parseInt(document.profe.sex.value);
sk = parseInt(document.profe.sk.value);
tch = parseFloat(document.profe.tch.value);
exp = parseInt(document.profe.exp.value);
comp = parseInt(document.profe.comp.value);
tech = parseFloat(document.profe.tech.value);
Utech = parseInt(document.profe.Utech.value);




document.final.ag.value = ag;
document.final.sex.value = sex;
document.final.sk.value = sk;
document.final.tch.value = tch;
document.final.exp.value = exp;
document.final.comp.value = comp;
document.final.tech.value = tech;
document.final.Utech.value = Utech;



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



<form name="profe" action="estilo.php" method="post">
     <!--Se le asignan valores a cada una de las opciones  -->
    Edad:<select name="ag" value="Age">
          <option value="1">Menor de 30</option>
          <option value="2">Entre 30 y 55</option>
          <option value="3">Mas de 55</option>
          </select><br>
    Sexo:<select name="sex" value="Sexo">
            <option value="1">Femenino</option>
            <option value="2">Masculino</option>
            <option value="3">Prefiero no decir</option>
            </select><br>
    Experiencia:<select name="sk" value="Skill">
         <option value="1">principiante</option>
         <option value="2">intermedio</option>
         <option value="3">experto</option>
         </select><br>
    Veces impartidas:<select name="tch" value="Teacher">
         <option value="1">nunca</option>
         <option value="2">entre 1-5</option>
         <option value="3">más de 5</option>
         </select><br>
    Área de especialización:<select name="exp" value="expertise">
         <option value="1">Toma de decisiones</option>
         <option value="2">diseño de red</option>
         <option value="3">Otro</option>
         </select><br>
    Habilidad del uso de computadoras:<select name="comp" value="computers">
         <option value="1">poca</option>
         <option value="2">media veces</option>
         <option value="3">alta</option>
         </select><br>
    Experiencia en tecnología:<select name="tech" value="technology">
         <option value="1">nula</option>
         <option value="2">media</option>
         <option value="3">alta</option>
         </select><br>
    Experiencia usando pag web:<select name="Utech" value="technology">
         <option value="1">nula</option>
         <option value="2">media</option>
         <option value="3">alta</option>
         </select><br>

        
         <font color="#ff0000"><font size="4"> ------------------</font></font><input value="CALCULAR" onclick="calcular()" type="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</form>
<!-- Se guardan en estos inputs los resultados de los datos ingresados por el usuario -->
<form name="final"  method="POST">
<input name="ag" maxlength="12" size="12"  >
<input name="sex" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="sk" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="tch" maxlength="12" size="12"  >
<input name="exp" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="comp" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input name="tech" maxlength="12" size="12"  >
<input name="Utech" maxlength="12" size="12"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 




  <font color="#ff0000"><font size="4"> -------------------------------------------------</font></font><input name="submit" value="Obtener Resultado" type="submit">
</form>

</body></html>

<?php

include("conexionDB.php");//se instancia la clase
$con=conexionDB();//se llama a la funcion

//echo "Se logro una exitosa conexion a la base";

function resultadoFinal($profe){ // esta funcion ayudará a mostrar el resultado final al usuario

        echo "El resultado es: ".$profe;
}

if ($_POST){ // evita errores
  $ag = $_POST["ag"];
 // echo "solo bueno".$ag;

  $sex = $_POST["sex"];
  //echo "solo bueno".$sex;

  $sk = $_POST["sk"];
  //echo "solo bueno".$sk;

  $tch = $_POST["tch"];
  //echo "solo bueno".$tch;

  $exp = $_POST["exp"];
  //echo "solo bueno".$exp;

  $comp = $_POST["comp"];
  //echo "solo bueno".$comp;

  $tech = $_POST["tech"];
  //echo "solo bueno".$tech;

  $Utech = $_POST["Utech"];
  //echo "solo bueno".$Utech;

  //haremos un array de los resultados obtenidos en la pag
  $resultadosPag = array($ag, $sex, $sk, $tch,$exp,$comp,$tech,$Utech );
  //echo "sum(a) = " . array_sum($resultadosPag). "\n";

  // estas variables ayudan a guarddar los valores numericos que se les asignaran a las datos que vienen de bd
$age=0;
$so=0;
$skk=0;
$tchn=0;
$expe=0;
$compp=0;
$techo=0;
$Utecho=0;
$sql = "SELECT * FROM profesores"; 
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
//por el usuario, a esto se le resta la suma de cada uno de los valores (age,so,skk,tchn,expe,compp,techo,Utecho) a su vez se usa la funcion pow para elevar a la 2
//y por ultimo la funcion sqrt para obtener la raiz de todo lo anterior ya descrito
for($i=0;$i<=19;$i++){//el que mueve de fila en fila en bd 19 porque hay de 20 registros de 0 a 19 hay 20

                 //Reemplazaremos los valores string por int, con el fin  de facilitar el calculo de la formula 
               //esto lo haremos con ayuda de la condicional if

               if($datas[$i]['A']){
                $age= $datas[$i]['A'];
               }

               if($datas[$i]['B'] == 'F'){
                 $so= "1";
               }else if($datas[$i]['B'] == 'M'){
                $so= "2";
               }else{
                $so= "3";
               }

               if($datas[$i]['C'] == 'B'){
                $skk= "1";
              }else if($datas[$i]['C'] == 'I'){
                $skk= "2";
              }else{
               $skk= "3";
              }

              if($datas[$i]["D"]){
                $tchn= $datas[$i]["D"];
              }

              if($datas[$i]['E'] == 'DM'){
                $expe= "1";
              }else if($datas[$i]['E'] == 'ND'){
                $expe= "2";
              }else{
               $expe= "3";
              }

               if($datas[$i]['F'] == 'L'){
                $compp= "1";
              }else if($datas[$i]['F'] == 'A'){
                $compp= "2";
              }else{
               $compp= "3";
              }

              if($datas[$i]['G'] == 'N'){
                $compp= "1";
              }else if($datas[$i]['F'] == 'S'){
                $compp= "2";
              }else{
               $compp= "3";
              }


              if($datas[$i]['H'] == 'N'){
                $compp= "1";
              }else if($datas[$i]['F'] == 'S'){
                $compp= "2";
              }else{
               $compp= "3";
              }




        //(sumatoria del dado por el usuario - sumatoria de cada una de las filas de la tabla de la bd)^2
        $operacion[] = sqrt(pow((array_sum($resultadosPag)-($age+ $so+$skk+ $tchn+ $expe+ $compp+ $techo+ $Utecho)),2));// sumatoria y elevar
        //echo $operacion[$i]."</br>"; // da cada uno de los resultados de la operacion indicada arriba
       
}
//echo min($operacion)." este es el valor minimo de todos los resultados xd</br>"; // esto nos da el valor minimo de todos los resultados guardados en este array

//encuentra el minimo del arreglo operacion y lo compara con cada uno de los resultados obtenidos de operacion en el indice j
//esto con el fin de obtener la fila en la base de datos que contiene esa informacion
//y con ello el tipo de profesor al cual esta mas cercano 
$profeFinalMasParecido="";
for($j=0;$j<=19;$j++){
        if($operacion[$j] == min($operacion)){
                $profeFinalMasParecido = $datas[$j]['Class']; // se guarda en la variable "profeFinalMasParecido..." el resultado final                      
        }        
}

        resultadoFinal($profeFinalMasParecido);  //se usa la funcion de arriba y se le pasa como parametro variable "profeFinalMasParecido..."

}else{
  echo "Debes precionar primero el boton de calcular, y luego el boton de obtener resultado";
}

?>