<?php

/*
RESUMEN DE ESTE ARCHIVO 
LINEA 38-->calculos de frecuencia
LINEA 340-->tabla sumar.si
LINEA 378--> tabla redes_prob y formula Bayes final
*/

//Aca se obtendra la frecuencia de cada una de las clases (A, B) para este caso
//ademas se obtendra el P(vj) --> el valor por el cual se multiplica la provabilidad condicional
//por otro lado se obtendra el p que es la cantidad  de datos distintos entre 1
include("conexionDB.php");// se instancia la clase
$con=conexionDB();//se llama a la funcion 

//echo "Se logro una exitosa conexion a la base";

//Para iniciar crearemos la tabla redes_freq_pvj_p, con int de 11 pensando en un futuro incremento
/*
$creaTabla = "CREATE TABLE redes_freq_pvj_p(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
    freqA int (11),
    freqB int (11),
    pvjA float (11),
    pvjB float (11),
    p float (11),
    pp float (11),
    m int (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/


//sentencias que cuenta las frecuencias de A y de B
$freqA = current($con->query("SELECT COUNT(Class) FROM redes WHERE Class = 'A'")->fetch_assoc());
$freqB = current($con->query("SELECT COUNT(Class) FROM redes WHERE Class = 'B'")->fetch_assoc());
//sentencia que cuenta el total de registros
$tot = current($con->query("SELECT COUNT(Class) FROM redes")->fetch_assoc());
//sentencias para obtener los valores distintos de cada columna, no se toma en cuanta la colunma costo,  ya que tiene solo 3 valores al igual que la coiumna Capacity, entonces para ahorra lineas de codigo no lo pondre, ya que se puede usar el mismo calculo de P para ambas
$calcPRelia = current($con->query("SELECT COUNT(DISTINCT Reliability) FROM redes")->fetch_assoc());
$calcPPNumberof = current($con->query("SELECT COUNT(DISTINCT Numberoflinks) FROM redes")->fetch_assoc()) ;
// se determina el valor de m(numero de columnas)
$m = 4;

/*
echo "Valor A ".$freqA/$tot;
echo "Valor B ".$freqB/$tot;
*/
//ingresamos los datos a la tabla
/*
$insertar ="INSERT INTO redes_freq_pvj_p (freqA, freqB, pvjA, pvjB, p, pp, m) 
VALUES ($freqA, $freqB, $freqA/$tot, $freqB/$tot, 1/$calcPRelia, 1/$calcPPNumberof, $m)";
$con->query($insertar);
*/

$sql = "SELECT Reliability, Numberoflinks, Capacity, Costo FROM redes"; 
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){//si hay mas de 0 filas ...
        while($row = mysqli_fetch_assoc($result)){

          $datas[]= $row;// lo que hace es insertar cada una de las filas de la tabla como arreglos en la variable datas[] 
               
        }
}

//Calculos para la tabla sumar.si
$sumatoriaRelA2=0;
$sumatoriaRelB2=0;

$sumatoriaRelA3=0;
$sumatoriaRelB3=0;

$sumatoriaRelA5=0;
$sumatoriaRelB5=0;

$sumatoriaRelA4=0;
$sumatoriaRelB4=0;
/* la idea era traer los valores distintos, pero solo me trae el 4, por eso es que tuve que hacerlo con los valores puestos manualmente
$valDis =array();
for($i=0;$i<=3;$i++){ 
    $valDis[$i]  = current($con->query("SELECT COUNT(DISTINCT Reliability) FROM redes")->fetch_assoc());
}
echo $valDis[3]
*/

for($i=0;$i<=15;$i++){                       //rango de A en BD, se contempla uno menos, debido a que empezamos en 0
    if($datas[$i]['Reliability'] == 2){
        $sumatoriaRelA2 ++;
    }
}
print_r($sumatoriaRelA2."  ");

for($i=16;$i<=34;$i++){                      //rango de B en BD, se contempla uno menos, debido a que empezamos en 16
    if($datas[$i]['Reliability'] == 2){
        $sumatoriaRelB2 ++;
    }
}
print_r($sumatoriaRelB2."  ");

//---

for($i=0;$i<=15;$i++){
    if($datas[$i]['Reliability'] == 3){
        $sumatoriaRelA3 ++;
    }
}
print_r($sumatoriaRelA3."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Reliability'] == 3){
        $sumatoriaRelB3 ++;
    }
}
print_r($sumatoriaRelB3."  ");

//----

for($i=0;$i<=15;$i++){
    if($datas[$i]['Reliability'] == 5){
        $sumatoriaRelA5 ++;
    }
}
print_r($sumatoriaRelA5."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Reliability'] == 5){
        $sumatoriaRelB5 ++;
    }
}
print_r($sumatoriaRelB5."  ");



///----

for($i=0;$i<=15;$i++){
    if($datas[$i]['Reliability'] == 4){
        $sumatoriaRelA4 ++;
    }
}
print_r($sumatoriaRelA4."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Reliability'] == 4){
        $sumatoriaRelB4 ++;
    }
}
print_r($sumatoriaRelB4."  ");

//-------------------------------------------------NumberOfLink------------------------------------------------------------------
/*
se hicieron rangos para acortar los calculo que se hubieran tenido que realizar
1 = 7-12 
2 = 13-16
3 = 17-20
*/

$sumatoriaNOLa1=0;
$sumatoriaNOLb1=0;

$sumatoriaNOLa2=0;
$sumatoriaNOLb2=0;

$sumatoriaNOLa3=0;
$sumatoriaNOLb3=0;

echo nl2br("\n");


for($i=0;$i<=15;$i++){
    if($datas[$i]['Numberoflinks'] == 1){
        $sumatoriaNOLa1 ++;
    }
}
print_r($sumatoriaNOLa1."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Numberoflinks'] == 1){
        $sumatoriaNOLb1 ++;
    }
}
print_r($sumatoriaNOLb1."  ");

//----------------------------------
for($i=0;$i<=15;$i++){
    if($datas[$i]['Numberoflinks'] == 2){
        $sumatoriaNOLb2 ++;
    }
}
print_r($sumatoriaNOLa2."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Numberoflinks'] == 2){
        $sumatoriaNOLb2 ++;
    }
}
print_r($sumatoriaNOLb2."  ");

//-----------------------------

for($i=0;$i<=15;$i++){
    if($datas[$i]['Numberoflinks'] == 3){
        $sumatoriaNOLa3 ++;
    }
}
print_r($sumatoriaNOLa3."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Numberoflinks'] == 3){
        $sumatoriaNOLb3 ++;
    }
}
print_r($sumatoriaNOLb3."  ");




//---------------------------------------------------CAPACITY------------------------------------------------------------------
$sumatoriaCAHa1=0;
$sumatoriaCAHb1=0;

$sumatoriaCAHa2=0;
$sumatoriaCAHb2=0;

$sumatoriaCAHa3=0;
$sumatoriaCAHb3=0;

echo nl2br("\n");

for($i=0;$i<=15;$i++){
    if($datas[$i]['Capacity'] == 'High'){
        $sumatoriaCAHa1 ++;
    }
}
print_r($sumatoriaCAHa1."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Capacity'] == 'High'){
        $sumatoriaCAHb1 ++;
    }
}
print_r($sumatoriaCAHb1."  ");

//------------------

for($i=0;$i<=15;$i++){
    if($datas[$i]['Capacity'] == 'Medium'){
        $sumatoriaCAHa2 ++;
    }
}
print_r($sumatoriaCAHa2."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Capacity'] == 'Medium'){
        $sumatoriaCAHb2 ++;
    }
}
print_r($sumatoriaCAHb2."  ");

//--------------------

for($i=0;$i<=15;$i++){
    if($datas[$i]['Capacity'] == 'Low'){
        $sumatoriaCAHa3 ++;
    }
}
print_r($sumatoriaCAHa3."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Capacity'] == 'Low'){
        $sumatoriaCAHb3 ++;
    }
}
print_r($sumatoriaCAHb3."  ");

//---------------------------------------------------COSTO------------------------------------------------------------------
$sumatoriaCOSTOa1=0;
$sumatoriaCOSTOb1=0;

$sumatoriaCOSTOa2=0;
$sumatoriaCOSTOb2=0;

$sumatoriaCOSTOa3=0;
$sumatoriaCOSTOb3=0;

echo nl2br("\n");

for($i=0;$i<=15;$i++){
    if($datas[$i]['Costo'] == 'High'){
        $sumatoriaCOSTOa1 ++;
    }
}
print_r($sumatoriaCOSTOa1."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Costo'] == 'High'){
        $sumatoriaCOSTOb1 ++;
    }
}
print_r($sumatoriaCOSTOb1."  ");

//------------------

for($i=0;$i<=15;$i++){
    if($datas[$i]['Costo'] == 'Medium'){
        $sumatoriaCOSTOa2 ++;
    }
}
print_r($sumatoriaCOSTOa2."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Costo'] == 'Medium'){
        $sumatoriaCOSTOb2 ++;
    }
}
print_r($sumatoriaCOSTOb2."  ");

//--------------------

for($i=0;$i<=15;$i++){
    if($datas[$i]['Costo'] == 'Low'){
        $sumatoriaCOSTOa3 ++;
    }
}
print_r($sumatoriaCOSTOa3."  ");

for($i=16;$i<=34;$i++){
    if($datas[$i]['Costo'] == 'Low'){
        $sumatoriaCOSTOb3 ++;
    }
}
print_r($sumatoriaCOSTOb3."  ");

//crearemos la tabla suma_si_redes, calculos SUMAR.SI de cada una de las funciones
/*
$creaTabla = "CREATE TABLE suma_si_redes(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
     Reliability int (11),
     Numberoflinks int (11),
     Capacity int (11),
     Costo int (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/

/*
VALUES ($sumatoriaRelA2, $sumatoriaNOLa1, $sumatoriaCAHa1, $sumatoriaCOSTOa1)";
VALUES ($sumatoriaRelB2, $sumatoriaNOLb1, $sumatoriaCAHb1, $sumatoriaCOSTOb1)";

VALUES ($sumatoriaRelA3, $sumatoriaNOLa2, $sumatoriaCAHa2, $sumatoriaCOSTOa2)";
VALUES ($sumatoriaRelB3, $sumatoriaNOLb2, $sumatoriaCAHb2, $sumatoriaCOSTOb2)";

VALUES ($sumatoriaRelA5, $sumatoriaNOLa3, $sumatoriaCAHa3, $sumatoriaCOSTOa3)";
VALUES ($sumatoriaRelB5, $sumatoriaNOLb3, $sumatoriaCAHb3, $sumatoriaCOSTOb3)";

VALUES ($sumatoriaRelA4, 0, 0, 0)";
VALUES ($sumatoriaRelB4, 0, 0, 0)";



*/

/*
$insertar ="INSERT INTO suma_si_redes (Reliability,Numberoflinks,Capacity,Costo) 
VALUES ($sumatoriaRelB4, 0, 0, 0)";
$con->query($insertar);
*/

//crearemos la tabla redes_prob, 
/*
$creaTabla = "CREATE TABLE redes_prob(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
     Reliability float (11),
     Numberoflinks float (11),
     Capacity float (11),
     Costo float (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/

/*
VALUES (($sumatoriaRelA2+$m*(1/$calcPRelia))/($freqA+$m), ($sumatoriaNOLa1+$m*(1/$calcPPNumberof))/($freqA+$m), ($sumatoriaCAHa1+$m*(1/$calcPPNumberof))/($freqA+$m), ($sumatoriaCOSTOa1+$m*(1/$calcPPNumberof))/($freqA+$m))";
VALUES (($sumatoriaRelB2+$m*(1/$calcPRelia))/($freqB+$m), ($sumatoriaNOLb1+$m*(1/$calcPPNumberof))/($freqB+$m), ($sumatoriaCAHb1+$m*(1/$calcPPNumberof))/($freqB+$m), ($sumatoriaCOSTOb1+$m*(1/$calcPPNumberof))/($freqB+$m))";

VALUES (($sumatoriaRelA3+$m*(1/$calcPRelia))/($freqA+$m), ($sumatoriaNOLa2+$m*(1/$calcPPNumberof))/($freqA+$m), ($sumatoriaCAHa2+$m*(1/$calcPPNumberof))/($freqA+$m), ($sumatoriaCOSTOa2+$m*(1/$calcPPNumberof))/($freqA+$m))";
VALUES (($sumatoriaRelB3+$m*(1/$calcPRelia))/($freqB+$m), ($sumatoriaNOLb2+$m*(1/$calcPPNumberof))/($freqB+$m), ($sumatoriaCAHb2+$m*(1/$calcPPNumberof))/($freqB+$m), ($sumatoriaCOSTOb2+$m*(1/$calcPPNumberof))/($freqB+$m))";

VALUES (($sumatoriaRelA5+$m*(1/$calcPRelia))/($freqA+$m), ($sumatoriaNOLa3+$m*(1/$calcPPNumberof))/($freqA+$m), ($sumatoriaCAHa3+$m*(1/$calcPPNumberof))/($freqA+$m), ($sumatoriaCOSTOa3+$m*(1/$calcPPNumberof))/($freqA+$m))";
VALUES (($sumatoriaRelB5+$m*(1/$calcPRelia))/($freqB+$m), ($sumatoriaNOLb3+$m*(1/$calcPPNumberof))/($freqB+$m), ($sumatoriaCAHb3+$m*(1/$calcPPNumberof))/($freqB+$m), ($sumatoriaCOSTOb3+$m*(1/$calcPPNumberof))/($freqB+$m))";

VALUES (($sumatoriaRelA4+$m*(1/$calcPRelia))/($freqA+$m), (0+$m*(1/$calcPPNumberof))/($freqA+$m), (0+$m*(1/$calcPPNumberof))/($freqA+$m), (0+$m*(1/$calcPPNumberof))/($freqA+$m))";
VALUES (($sumatoriaRelB4+$m*(1/$calcPRelia))/($freqB+$m), (0+$m*(1/$calcPPNumberof))/($freqB+$m), (0+$m*(1/$calcPPNumberof))/($freqB+$m), (0+$m*(1/$calcPPNumberof))/($freqB+$m))";

*/

/*
$insertar ="INSERT INTO redes_prob (Reliability,Numberoflinks,Capacity,Costo) 
VALUES (($sumatoriaRelB4+$m*(1/$calcPRelia))/($freqB+$m), (0+$m*(1/$calcPPNumberof))/($freqB+$m), (0+$m*(1/$calcPPNumberof))/($freqB+$m), (0+$m*(1/$calcPPNumberof))/($freqB+$m))";
$con->query($insertar);
*/
?>