<?php
/*
RESUMEN DE ESTE ARCHIVO 
LINEA 37-->calculos de frecuencia
LINEA 725-->tabla sumar.si
LINEA 774--> tabla prof_prob y formula Bayes final
*/
//Aca se obtendra la frecuencia de cada una de las clases (Avanzado, Intermedio, principiante) para este caso
//ademas se obtendra el P(vj) --> el valor por el cual se multiplica la provabilidad condicional
//por otro lado se obtendra el p que es la cantidad  de datos distintos entre 1
include("conexionDB.php");// se instancia la clase
$con=conexionDB();//se llama a la funcion 

//echo "Se logro una exitosa conexion a la base";

//Para iniciar crearemos la tabla prof_freq_pvj_p, con int de 11 pensando en un futuro incremento
/*
$creaTabla = "CREATE TABLE prof_freq_pvj_p(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
    freqBeg int (11),
    freqInter int (11),
    freqAdv int (11),
    pvjBeg float (11),
    pvjInter float (11),
    pvjAdv float (11),
    p float (11),
    m int (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/


//sentencias que cuenta las frecuencias de Beg, Inter y Adv
$freqBeg = current($con->query("SELECT COUNT(Class) FROM profesores WHERE Class = 'Beginner'")->fetch_assoc());
$freqInter = current($con->query("SELECT COUNT(Class) FROM profesores WHERE Class = 'Intermediate'")->fetch_assoc());
$freqAdv = current($con->query("SELECT COUNT(Class) FROM profesores WHERE Class = 'Advanced'")->fetch_assoc());

//sentencia que cuenta el total de registros
$tot = current($con->query("SELECT COUNT(Class) FROM profesores")->fetch_assoc());
//sentencias para obtener los valores distintos de cada columna, solo se toma en cuenta 1 porque en todas las columnas solo hay 3 valores posibles, entonces para ahorra lineas de codigo no lo pondre, ya que se puede usar el mismo calculo de P para todas
$calcPa = current($con->query("SELECT COUNT(DISTINCT A) FROM profesores")->fetch_assoc());
// se determina el valor de m(numero de columnas)
$m = 8;

/*
echo "Valor beg ".$freqBeg/$tot;
echo "Valor inter ".$freqInter/$tot;
echo "Valor adv ".$freqAdv/$tot;
*/

//ingresamos los datos a la tabla
/*
$insertar ="INSERT INTO prof_freq_pvj_p (freqBeg, freqInter, freqAdv, pvjBeg, pvjInter, pvjAdv, p, m) 
VALUES ($freqBeg, $freqInter, $freqAdv, $freqBeg/$tot, $freqInter/$tot, $freqAdv/$tot,  1/$calcPa, $m)";
$con->query($insertar);
*/

$sql = "SELECT A, B, C, D, E, F, G, H FROM profesores"; 
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){//si hay mas de 0 filas ...
        while($row = mysqli_fetch_assoc($result)){

          $datas[]= $row;// lo que hace es insertar cada una de las filas de la tabla como arreglos en la variable datas[] 
               
        }
}

//Calculos para la tabla sumar.si

$sumatoriaABeg=0;
$sumatoriaAInter=0;
$sumatoriaAadv=0;

$sumatoriaABeg2=0;
$sumatoriaAInter2=0;
$sumatoriaAadv2=0;

$sumatoriaABeg3=0;
$sumatoriaAInter3=0;
$sumatoriaAadv3=0;

echo nl2br("\n");


for($i=0;$i<=8;$i++){           //rango de Beginner en BD, se contempla uno menos, debido a que empezamos en 0
    if($datas[$i]['A'] == 3){
        $sumatoriaABeg ++;
    }
}
print_r($sumatoriaABeg."  ");

for($i=9;$i<=14;$i++){          //rango de Intermedio en BD, se contempla uno menos, debido a que empezamos en 9
    if($datas[$i]['A'] == 3){
        $sumatoriaAInter ++;
    }
}
print_r($sumatoriaAInter."  ");

for($i=15;$i<=19;$i++){         //rango de Advanced en BD, se contempla uno menos, debido a que empezamos en 15
    if($datas[$i]['A'] == 3){
        $sumatoriaAadv ++;
    }
}
print_r($sumatoriaAadv."  ");

//---------------------
for($i=0;$i<=8;$i++){
    if($datas[$i]['A'] == 2){
        $sumatoriaABeg2 ++;
    }
}
print_r($sumatoriaABeg2."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['A'] == 2){
        $sumatoriaAInter2 ++;
    }
}
print_r($sumatoriaAInter2."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['A'] == 2){
        $sumatoriaAadv2 ++;
    }
}
print_r($sumatoriaAadv2."  ");

//---------------------

for($i=0;$i<=8;$i++){
    if($datas[$i]['A'] == 1){
        $sumatoriaABeg3 ++;
    }
}
print_r($sumatoriaABeg3."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['A'] == 1){
        $sumatoriaAInter3 ++;
    }
}
print_r($sumatoriaAInter3."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['A'] == 1){
        $sumatoriaAadv3 ++;
    }
}
print_r($sumatoriaAadv3."  ");

//--------------------------------------------------B--------------------------------------------------------------------

$sumatoriBBeg=0;
$sumatoriaBInter=0;
$sumatoriaBadv=0;

$sumatoriaBBeg2=0;
$sumatoriaBInter2=0;
$sumatoriaBadv2=0;

$sumatoriaBBeg3=0;
$sumatoriaBInter3=0;
$sumatoriaBadv3=0;
echo nl2br("\n");

for($i=0;$i<=8;$i++){
    if($datas[$i]['B'] == 'M'){
        $sumatoriBBeg ++;
    }
}
print_r($sumatoriBBeg."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['B'] == 'M'){
        $sumatoriaBInter ++;
    }
}
print_r($sumatoriaBInter."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['B'] == 'M'){
        $sumatoriaBadv ++;
    }
}
print_r($sumatoriaBadv."  ");

//---------------------
for($i=0;$i<=8;$i++){
    if($datas[$i]['B'] == 'F'){
        $sumatoriaBBeg2 ++; 
    }
}
print_r($sumatoriaBBeg2."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['B'] == 'F'){
        $sumatoriaBInter2 ++;
    }
}
print_r($sumatoriaBInter2."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['B'] == 'F'){
        $sumatoriaBadv2 ++;
    }
}
print_r($sumatoriaBadv2."  ");

//---------------------

for($i=0;$i<=8;$i++){
    if($datas[$i]['B'] == 'NA'){
        $sumatoriaBBeg3 ++;
    }
}
print_r($sumatoriaBBeg3."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['B'] == 'NA'){
        $sumatoriaBInter3 ++;
    }
}
print_r($sumatoriaBInter3."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['B'] == 'NA'){
        $sumatoriaBadv3 ++;
    }
}
print_r($sumatoriaBadv3."  ");

//-----------------------------------------------------------------C----------------------------------------

$sumatoriaCBeg=0;
$sumatoriaCInter=0;
$sumatoriaCadv=0;

$sumatoriaCBeg2=0;
$sumatoriaCInter2=0;
$sumatoriaCadv2=0;

$sumatoriaCBeg3=0;
$sumatoriaCInter3=0;
$sumatoriaCadv3=0;
echo nl2br("\n");

for($i=0;$i<=8;$i++){
    if($datas[$i]['C'] == 'I'){
        $sumatoriaCBeg ++;
    }
}
print_r($sumatoriaCBeg."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['C'] == 'I'){
        $sumatoriaCInter ++;
    }
}
print_r($sumatoriaCInter."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['C'] == 'I'){
        $sumatoriaCadv ++;
    }
}
print_r($sumatoriaCadv."  ");

//---------------------
for($i=0;$i<=8;$i++){
    if($datas[$i]['C'] == 'B'){
        $sumatoriaCBeg2 ++;
    }
}
print_r($sumatoriaCBeg2."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['C'] == 'B'){
        $sumatoriaCInter2 ++;
    }
}
print_r($sumatoriaCInter2."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['C'] == 'B'){
        $sumatoriaCadv2 ++;
    }
}
print_r($sumatoriaCadv2."  ");

//---------------------

for($i=0;$i<=8;$i++){
    if($datas[$i]['C'] == 'A'){
        $sumatoriaCBeg3 ++;
    }
}
print_r($sumatoriaCBeg3."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['C'] == 'A'){
        $sumatoriaCInter3 ++;
    }
}
print_r($sumatoriaCInter3."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['C'] == 'A'){
        $sumatoriaCadv3 ++;
    }
}
print_r($sumatoriaCadv3."  ");

//-------------------------------------------------------------------D------------------------------------------------

$sumatoriaDBeg=0;
$sumatoriaDInter=0;
$sumatoriaDadv=0;

$sumatoriaDBeg2=0;
$sumatoriaDInter2=0;
$sumatoriaDadv2=0;

$sumatoriaDBeg3=0;
$sumatoriaDInter3=0;
$sumatoriaDadv3=0;

echo nl2br("\n");
for($i=0;$i<=8;$i++){
    if($datas[$i]['D'] == 3){
        $sumatoriaDBeg ++;
    }
}
print_r($sumatoriaDBeg."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['D'] == 3){
        $sumatoriaDInter ++;
    }
}
print_r($sumatoriaDInter."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['D'] == 3){
        $sumatoriaDadv ++;
    }
}
print_r($sumatoriaDadv."  ");

//---------------------
for($i=0;$i<=8;$i++){
    if($datas[$i]['D'] == 2){
        $sumatoriaDBeg2 ++;
    }
}
print_r($sumatoriaDBeg2."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['D'] == 2){
        $sumatoriaDInter2 ++;
    }
}
print_r($sumatoriaDInter2."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['D'] == 2){
        $sumatoriaDadv2 ++;
    }
}
print_r($sumatoriaDadv2."  ");

//---------------------

for($i=0;$i<=8;$i++){
    if($datas[$i]['D'] == 1){
        $sumatoriaDBeg3 ++;
    }
}
print_r($sumatoriaDBeg3."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['D'] == 1){
        $sumatoriaDInter3 ++;
    }
}
print_r($sumatoriaDInter3."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['D'] == 1){
        $sumatoriaDadv3 ++;
    }
}
print_r($sumatoriaDadv3."  ");

//---------------------------------------------------------------------------E--------------------------------------------

$sumatoriaEBeg=0;
$sumatoriaEInter=0;
$sumatoriaEadv=0;

$sumatoriaEBeg2=0;
$sumatoriaEInter2=0;
$sumatoriaEadv2=0;

$sumatoriaEBeg3=0;
$sumatoriaEInter3=0;
$sumatoriaEadv3=0;
echo nl2br("\n");

for($i=0;$i<=8;$i++){
    if($datas[$i]['E'] == 'ND'){
        $sumatoriaEBeg ++;
    }
}
print_r($sumatoriaEBeg."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['E'] == 'ND'){
        $sumatoriaEInter ++;
    }
}
print_r($sumatoriaEInter."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['E'] == 'ND'){
        $sumatoriaEadv ++;
    }
}
print_r($sumatoriaEadv."  ");

//---------------------
for($i=0;$i<=8;$i++){
    if($datas[$i]['E'] == 'DM'){
        $sumatoriaEBeg2 ++;
    }
}
print_r($sumatoriaEBeg2."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['E'] == 'DM'){
        $sumatoriaEInter2 ++;
    }
}
print_r($sumatoriaEInter2."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['E'] == 'DM'){
        $sumatoriaEadv2 ++;
    }
}
print_r($sumatoriaEadv2."  ");

//---------------------

for($i=0;$i<=8;$i++){
    if($datas[$i]['E'] == 'O'){
        $sumatoriaEBeg3 ++;
    }
}
print_r($sumatoriaEBeg3."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['E'] == 'O'){
        $sumatoriaEInter3 ++;
    }
}
print_r($sumatoriaEInter3."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['E'] == 'O'){
        $sumatoriaEadv3 ++;
    }
}
print_r($sumatoriaEadv3."  ");


//----------------------------------------------------------------------------F------------------------------------------

$sumatoriaFBeg=0;
$sumatoriaFInter=0;
$sumatoriaFadv=0;

$sumatoriaFBeg2=0;
$sumatoriaFInter2=0;
$sumatoriaFadv2=0;

$sumatoriaFBeg3=0;
$sumatoriaFInter3=0;
$sumatoriaFadv3=0;
echo nl2br("\n");

for($i=0;$i<=8;$i++){
    if($datas[$i]['F'] == 'A'){
        $sumatoriaFBeg ++;
    }
}
print_r($sumatoriaFBeg."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['F'] == 'A'){
        $sumatoriaFInter ++;
    }
}
print_r($sumatoriaFInter."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['F'] == 'A'){
        $sumatoriaFadv ++;
    }
}
print_r($sumatoriaFadv."  ");

//---------------------
for($i=0;$i<=8;$i++){
    if($datas[$i]['F'] == 'H'){
        $sumatoriaFBeg2 ++;
    }
}
print_r($sumatoriaFBeg2."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['F'] == 'H'){
        $sumatoriaFInter2 ++;
    }
}
print_r($sumatoriaFInter2."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['F'] == 'H'){
        $sumatoriaFadv2 ++;
    }
}
print_r($sumatoriaFadv2."  ");

//---------------------

for($i=0;$i<=8;$i++){
    if($datas[$i]['F'] == 'L'){
        $sumatoriaFBeg3 ++;
    }
}
print_r($sumatoriaFBeg3."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['F'] == 'L'){
        $sumatoriaFInter3 ++;
    }
}
print_r($sumatoriaFInter3."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['F'] == 'L'){
        $sumatoriaFadv3 ++;
    }
}
print_r($sumatoriaFadv3."  ");

//------------------------------------------------------------------------G-------------------------------------------

$sumatoriaGBeg=0;
$sumatoriaGInter=0;
$sumatoriaGadv=0;

$sumatoriaGBeg2=0;
$sumatoriaGInter2=0;
$sumatoriaGadv2=0;

$sumatoriaGBeg3=0;
$sumatoriaGInter3=0;
$sumatoriaGadv3=0;
echo nl2br("\n");

for($i=0;$i<=8;$i++){
    if($datas[$i]['G'] == 'N'){
        $sumatoriaGBeg ++;
    }
}
print_r($sumatoriaGBeg."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['G'] == 'N'){
        $sumatoriaGInter ++;
    }
}
print_r($sumatoriaGInter."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['G'] == 'N'){
        $sumatoriaGadv ++;
    }
}
print_r($sumatoriaGadv."  ");

//---------------------
for($i=0;$i<=8;$i++){
    if($datas[$i]['G'] == 'S'){
        $sumatoriaGBeg2 ++;
    }
}
print_r($sumatoriaGBeg2."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['G'] == 'S'){
        $sumatoriaGInter2 ++;
    }
}
print_r($sumatoriaGInter2."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['G'] == 'S'){
        $sumatoriaGadv2 ++;
    }
}
print_r($sumatoriaGadv2."  ");

//---------------------

for($i=0;$i<=8;$i++){
    if($datas[$i]['G'] == 'O'){
        $sumatoriaGBeg3 ++;
    }
}
print_r($sumatoriaGBeg3."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['G'] == 'O'){
        $sumatoriaGInter3 ++;
    }
}
print_r($sumatoriaGInter3."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['G'] == 'O'){
        $sumatoriaGadv3 ++;
    }
}
print_r($sumatoriaGadv3."  ");

//-------------------------------------------------------------------H---------------------------------------------------

$sumatoriaHBeg=0;
$sumatoriaHInter=0;
$sumatoriaHadv=0;

$sumatoriaHBeg2=0;
$sumatoriaHInter2=0;
$sumatoriaHadv2=0;

$sumatoriaHBeg3=0;
$sumatoriaHInter3=0;
$sumatoriaHadv3=0;
echo nl2br("\n");


for($i=0;$i<=8;$i++){
    if($datas[$i]['H'] == 'O'){
        $sumatoriaHBeg ++;
    }
}
print_r($sumatoriaHBeg."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['H'] == 'O'){
        $sumatoriaHInter ++;
    }
}
print_r($sumatoriaHInter."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['H'] == 'O'){
        $sumatoriaHadv ++;
    }
}
print_r($sumatoriaHadv."  ");

//---------------------
for($i=0;$i<=8;$i++){
    if($datas[$i]['H'] == 'S'){
        $sumatoriaHBeg2 ++;
    }
}
print_r($sumatoriaHBeg2."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['H'] =='S'){
        $sumatoriaHInter2 ++;
    }
}
print_r($sumatoriaHInter2."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['H'] == 'S'){
        $sumatoriaHadv2 ++;
    }
}
print_r($sumatoriaHadv2."  ");

//---------------------

for($i=0;$i<=8;$i++){
    if($datas[$i]['H'] == 'N'){
        $sumatoriaHBeg3 ++;
    }
}
print_r($sumatoriaHBeg3."  ");

for($i=9;$i<=14;$i++){
    if($datas[$i]['H'] == 'N'){
        $sumatoriaHInter3 ++;
    }
}
print_r($sumatoriaHInter3."  ");

for($i=15;$i<=19;$i++){
    if($datas[$i]['H'] == 'N'){
        $sumatoriaHadv3 ++;
    }
}
print_r($sumatoriaHadv3."  ");



//crearemos la tabla suma_si_profesor, calculos SUMAR.SI de cada una de las funciones
/*
$creaTabla = "CREATE TABLE suma_si_profesor(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
    A int (11),
    B int (11),
    C int (11),
    D int (11),
    E int (11),
    F int (11),
    G int (11),
    H int (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/

//Ahora insertamos lo datos calculados


/*
VALUES ($sumatoriaABeg, $sumatoriBBeg, $sumatoriaCBeg, $sumatoriaDBeg, $sumatoriaEBeg, $sumatoriaFBeg, $sumatoriaGBeg, $sumatoriaHBeg )";
VALUES ($sumatoriaAInter, $sumatoriaBInter, $sumatoriaCInter, $sumatoriaDInter, $sumatoriaEInter, $sumatoriaFInter, $sumatoriaGInter, $sumatoriaHInter )";
VALUES ($sumatoriaAadv, $sumatoriaBadv, $sumatoriaCadv, $sumatoriaDadv, $sumatoriaEadv, $sumatoriaFadv, $sumatoriaGadv, $sumatoriaHadv )";

VALUES ($sumatoriaABeg2, $sumatoriaBBeg2, $sumatoriaCBeg2, $sumatoriaDBeg2, $sumatoriaEBeg2, $sumatoriaFBeg2, $sumatoriaGBeg2, $sumatoriaHBeg2 )";
VALUES ($sumatoriaAInter2, $sumatoriaBInter2, $sumatoriaCInter2, $sumatoriaDInter2, $sumatoriaEInter2, $sumatoriaFInter2, $sumatoriaGInter2, $sumatoriaHInter2 )";
VALUES ($sumatoriaAadv2, $sumatoriaBadv2, $sumatoriaCadv2, $sumatoriaDadv2, $sumatoriaEadv2, $sumatoriaFadv2, $sumatoriaGadv2, $sumatoriaHadv2 )";

VALUES ($sumatoriaABeg3, $sumatoriaBBeg3, $sumatoriaCBeg3, $sumatoriaDBeg3, $sumatoriaEBeg3, $sumatoriaFBeg3, $sumatoriaGBeg3, $sumatoriaHBeg3 )";
VALUES ($sumatoriaAInter3, $sumatoriaBInter3, $sumatoriaCInter3, $sumatoriaDInter3, $sumatoriaEInter3, $sumatoriaFInter3, $sumatoriaGInter3, $sumatoriaHInter3 )";
VALUES ($sumatoriaAadv3, $sumatoriaBadv3, $sumatoriaCadv3, $sumatoriaDadv3, $sumatoriaEadv3, $sumatoriaFadv3, $sumatoriaGadv3, $sumatoriaHadv3 )";

*/

/*
$insertar ="INSERT INTO suma_si_profesor (A,B,C,D,E,F,G,H) 
VALUES ($sumatoriaAadv3, $sumatoriaBadv3, $sumatoriaCadv3, $sumatoriaDadv3, $sumatoriaEadv3, $sumatoriaFadv3, $sumatoriaGadv3, $sumatoriaHadv3 )";
$con->query($insertar);
*/







//Para iniciar crearemos la tabla prof_prob, con int de 11 pensando en un futuro incremento
/*
$creaTabla = "CREATE TABLE prof_prob(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
    A float (11),
    B float (11),
    C float (11),
    D float (11),
    E float (11),
    F float (11),
    G float (11),
    H float (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/

//Calculamos ahora si, por fin, las probabilidades con la formula (nc+m*p)/(n+m)
/*

VALUES (($sumatoriaABeg+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriBBeg+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaCBeg+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaDBeg+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaEBeg+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaFBeg+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaGBeg+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaHBeg+$m*(1/$calcPa))/($freqBeg+$m) )";
VALUES (($sumatoriaAInter+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaBInter+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaCInter+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaDInter+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaEInter+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaFInter+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaGInter+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaHInter+$m*(1/$calcPa))/($freqInter+$m) )";
VALUES (($sumatoriaAadv+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaBadv+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaCadv+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaDadv+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaEadv+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaFadv+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaGadv+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaHadv+$m*(1/$calcPa))/($freqAdv+$m) )";

VALUES (($sumatoriaABeg2+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaBBeg2+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaCBeg2+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaDBeg2+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaEBeg2+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaFBeg2+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaGBeg2+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaHBeg2+$m*(1/$calcPa))/($freqBeg+$m) )";
VALUES (($sumatoriaAInter2+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaBInter2+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaCInter2+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaDInter2+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaEInter2+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaFInter2+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaGInter2+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaHInter2+$m*(1/$calcPa))/($freqInter+$m) )";
VALUES (($sumatoriaAadv2+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaBadv2+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaCadv2+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaDadv2+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaEadv2+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaFadv2+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaGadv2+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaHadv2+$m*(1/$calcPa))/($freqAdv+$m) )";

VALUES (($sumatoriaABeg3+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaBBeg3+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaCBeg3+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaDBeg3+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaEBeg3+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaFBeg3+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaGBeg3+$m*(1/$calcPa))/($freqBeg+$m), ($sumatoriaHBeg3+$m*(1/$calcPa))/($freqBeg+$m) )";
VALUES (($sumatoriaAInter3+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaBInter3+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaCInter3+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaDInter3+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaEInter3+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaFInter3+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaGInter3+$m*(1/$calcPa))/($freqInter+$m), ($sumatoriaHInter3+$m*(1/$calcPa))/($freqInter+$m) )";
VALUES (($sumatoriaAadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaBadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaCadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaDadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaEadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaFadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaGadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaHadv3+$m*(1/$calcPa))/($freqAdv+$m) )";
*/

//echo $sumatoriaABeg." ";
//echo $m." ";
//echo $calcPa." fdsfdsfds ";
//echo $freqBeg." ";


/* continusr
$insertar ="INSERT INTO prof_prob (A,B,C,D,E,F,G,H)
VALUES (($sumatoriaAadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaBadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaCadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaDadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaEadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaFadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaGadv3+$m*(1/$calcPa))/($freqAdv+$m), ($sumatoriaHadv3+$m*(1/$calcPa))/($freqAdv+$m) )";
$con->query($insertar);
*/



?>

