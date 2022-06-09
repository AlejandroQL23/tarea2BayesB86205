<?php
/*
RESUMEN DE ESTE ARCHIVO 
LINEA -->calculos de frecuencia
LINEA -->tabla sumar.si
LINEA --> tabla estilos1_prob y formula Bayes final


rangos para CA, EC, EA, OR, se hace esto reducir la cantidad de codigo 

1 = 6-10
2 = 11-15
3 = 16-20
4 = 21-24

rangos para Promedios, se hace esto para reducir la cantidad de codigo
A = 0,1,2
B = 3,4,5
C = 6,7,8
D = 9,10
*/

//Aca se obtendra la frecuencia de cada una de las clases (M, F) para este caso
//ademas se obtendra el P(vj) --> el valor por el cual se multiplica la provabilidad condicional
//por otro lado se obtendra el p que es la cantidad  de datos distintos entre 1
include("conexionDB.php");// se instancia la clase
$con=conexionDB();//se llama a la funcion 

//echo "Se logro una exitosa conexion a la base";

//Para iniciar crearemos la tabla sexo_freq_pvj_p, con int de 11 pensando en un futuro incremento
/*
$creaTabla = "CREATE TABLE sexo_freq_pvj_p(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
    freqFE int (11),
    freqMA int (11),
    pvjFE float (11),
    pvjMA float (11),
    p float (11),
    pp float (11),
    m int (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/

//sentencias que cuenta las frecuencias de F Y M
$freqFE = current($con->query("SELECT COUNT(Sexo) FROM sexo WHERE Sexo = 'F'")->fetch_assoc());
$freqMA = current($con->query("SELECT COUNT(Sexo) FROM sexo WHERE Sexo = 'M'")->fetch_assoc());
//sentencia que cuenta el total de registros
$tot = current($con->query("SELECT COUNT(Sexo) FROM sexo")->fetch_assoc());
//sentencias para obtener los valores distintos de cada columna, con esto se hara el 1/calcPCA
$calcPRecinto = current($con->query("SELECT COUNT(DISTINCT Recinto) FROM sexo")->fetch_assoc());
$calcPPpromedio = current($con->query("SELECT COUNT(DISTINCT Promedio) FROM sexo")->fetch_assoc());
// se determina el valor de m(numero de columnas)
$m = 7;


//ingresamos los datos a la tabla
/*
$insertar ="INSERT INTO sexo_freq_pvj_p (freqFE, freqMA, pvjFE, pvjMA, p,  pp, m) 
VALUES ($freqFE, $freqMA, $freqFE/$tot, $freqMA/$tot, 1/$calcPRecinto, 1/($calcPPpromedio+1) , $m)";
$con->query($insertar);
*/

$sql = "SELECT Recinto, Promedio, CA, EC, EA, RO, Estilo FROM sexo"; 
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){//si hay mas de 0 filas ...
        while($row = mysqli_fetch_assoc($result)){

          $datas[]= $row;// lo que hace es insertar cada una de las filas de la tabla como arreglos en la variable datas[] 
               
        }
}

$sumatoriaRecinFemeT = 0;
$sumatoriaRecinMascT = 0;

$sumatoriaRecinFemeP = 0;
$sumatoriaRecinMascP = 0;

echo nl2br("\n");

for($i=0;$i<=12;$i++){                       //rango de Femenino en BD, se contempla uno menos, debido a que empezamos en 0
    if($datas[$i]['Recinto'] == 'Turrialba'){
        $sumatoriaRecinFemeT ++;
    }
}
print_r($sumatoriaRecinFemeT."  ");

for($i=13;$i<=76;$i++){                      //rango de Masculino en BD, se contempla uno menos, debido a que empezamos en 13
    if($datas[$i]['Recinto'] == 'Turrialba'){
        $sumatoriaRecinMascT ++;
    }
}
print_r($sumatoriaRecinMascT."  ");

//---------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Recinto'] == 'Paraiso'){
        $sumatoriaRecinFemeP ++;
    }
}
print_r($sumatoriaRecinFemeP."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Recinto'] == 'Paraiso'){
        $sumatoriaRecinMascP ++;
    }
}
print_r($sumatoriaRecinMascP."  ");

//-------------------------------------------------------------------Promedio--------------------------------------------------------

$sumatoriaPromFemeA = 0;
$sumatoriaPromMascA = 0;

$sumatoriaPromFemeB = 0;
$sumatoriaPromMascB = 0;

$sumatoriaPromFemeC = 0;
$sumatoriaPromMascC = 0;

$sumatoriaPromFemeD = 0;
$sumatoriaPromMascD = 0;

echo nl2br("\n");

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Promedio'] == 'A'){
        $sumatoriaPromFemeA ++;
    }
}
print_r($sumatoriaPromFemeA."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Promedio'] == 'A'){
        $sumatoriaPromMascA ++;
    }
}
print_r($sumatoriaPromMascA."  ");

//----------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Promedio'] == 'B'){
        $sumatoriaPromFemeB ++;
    }
}
print_r($sumatoriaPromFemeB."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Promedio'] == 'B'){
        $sumatoriaPromMascB ++;
    }
}
print_r($sumatoriaPromMascB."  ");

//------------------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Promedio'] == 'C'){
        $sumatoriaPromFemeC ++;
    }
}
print_r($sumatoriaPromFemeC."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Promedio'] == 'C'){
        $sumatoriaPromMascC ++;
    }
}
print_r($sumatoriaPromMascC."  ");

//----------------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Promedio'] == 'D'){
        $sumatoriaPromFemeD ++;
    }
}
print_r($sumatoriaPromFemeD."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Promedio'] == 'D'){
        $sumatoriaPromMascD ++;
    }
}
print_r($sumatoriaPromMascD."  ");

//----------------------------------------------------------------------CA-------------------------------------------------

$sumatoriaCAFeme1 = 0;
$sumatoriaCAMasc1 = 0;

$sumatoriaCAFeme2 = 0;
$sumatoriaCAMasc2 = 0;

$sumatoriaCAFeme3 = 0;
$sumatoriaCAMasc3 = 0;

$sumatoriaCAFeme4 = 0;
$sumatoriaCAMasc4 = 0;

echo nl2br("\n");

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['CA'] == '1'){
        $sumatoriaCAFeme1 ++;
    }
}
print_r($sumatoriaCAFeme1."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['CA'] == '1'){
        $sumatoriaCAMasc1 ++;
    }
}
print_r($sumatoriaCAMasc1."  ");

//--------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['CA'] == '2'){
        $sumatoriaCAFeme2 ++;
    }
}
print_r($sumatoriaCAFeme2."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['CA'] == '2'){
        $sumatoriaCAMasc2 ++;
    }
}
print_r($sumatoriaCAMasc2."  ");

//---------------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['CA'] == '3'){
        $sumatoriaCAFeme3 ++;
    }
}
print_r($sumatoriaCAFeme3."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['CA'] == '3'){
        $sumatoriaCAMasc3 ++;
    }
}
print_r($sumatoriaCAMasc3."  ");

//-------------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['CA'] == '4'){
        $sumatoriaCAFeme4 ++;
    }
}
print_r($sumatoriaCAFeme4."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['CA'] == '4'){
        $sumatoriaCAMasc4 ++;
    }
}
print_r($sumatoriaCAMasc4."  ");


//-------------------------------------------------------------------EC---------------------------------------------------------------------

$sumatoriaECFeme1 = 0;
$sumatoriaECMasc1 = 0;

$sumatoriaECFeme2 = 0;
$sumatoriaECMasc2 = 0;

$sumatoriaECFeme3 = 0;
$sumatoriaECMasc3 = 0;

$sumatoriaECFeme4 = 0;
$sumatoriaECMasc4 = 0;

echo nl2br("\n");

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['EC'] == '1'){
        $sumatoriaECFeme1 ++;
    }
}
print_r($sumatoriaECFeme1."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['EC'] == '1'){
        $sumatoriaECMasc1 ++;
    }
}
print_r($sumatoriaECMasc1."  ");

//----------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['EC'] == '2'){
        $sumatoriaECFeme2 ++;
    }
}
print_r($sumatoriaECFeme2."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['EC'] == '2'){
        $sumatoriaECMasc2 ++;
    }
}
print_r($sumatoriaECMasc2."  ");

//---------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['EC'] == '3'){
        $sumatoriaECFeme3 ++;
    }
}
print_r($sumatoriaECFeme3."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['EC'] == '3'){
        $sumatoriaECMasc3 ++;
    }
}
print_r($sumatoriaECMasc3."  ");

//--------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['EC'] == '4'){
        $sumatoriaECFeme4 ++;
    }
}
print_r($sumatoriaECFeme4."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['EC'] == '4'){
        $sumatoriaECMasc4 ++;
    }
}
print_r($sumatoriaECMasc4."  ");

//------------------------------------------------------------------------EA---------------------------------------------------

$sumatoriaEAFeme1 = 0;
$sumatoriaEAMasc1 = 0;

$sumatoriaEAFeme2 = 0;
$sumatoriaEAMasc2 = 0;

$sumatoriaEAFeme3 = 0;
$sumatoriaEAMasc3 = 0;

$sumatoriaEAFeme4 = 0;
$sumatoriaEAMasc4 = 0;


echo nl2br("\n");

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['EA'] == '1'){
        $sumatoriaEAFeme1 ++;
    }
}
print_r($sumatoriaEAFeme1."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['EA'] == '1'){
        $sumatoriaEAMasc1 ++;
    }
}
print_r($sumatoriaEAMasc1."  ");

//----------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['EA'] == '2'){
        $sumatoriaEAFeme2 ++;
    }
}
print_r($sumatoriaEAFeme2."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['EA'] == '2'){
        $sumatoriaEAMasc2 ++;
    }
}
print_r($sumatoriaEAMasc2."  ");

//----------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['EA'] == '3'){
        $sumatoriaEAFeme3 ++;
    }
}
print_r($sumatoriaEAFeme3."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['EA'] == '3'){
        $sumatoriaEAMasc3 ++;
    }
}
print_r($sumatoriaEAMasc3."  ");

//-------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['EA'] == '4'){
        $sumatoriaEAFeme4 ++;
    }
}
print_r($sumatoriaEAFeme4."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['EA'] == '4'){
        $sumatoriaEAMasc4 ++;
    }
}
print_r($sumatoriaEAMasc4."  ");


//-----------------------------------------------------------------RO-------------------------------------------------

$sumatoriaROFeme1 = 0;
$sumatoriaROMasc1 = 0;

$sumatoriaROFeme2 = 0;
$sumatoriaROMasc2 = 0;

$sumatoriaROFeme3 = 0;
$sumatoriaROMasc3 = 0;

$sumatoriaROFeme4 = 0;
$sumatoriaROMasc4 = 0;


echo nl2br("\n");

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['RO'] == '1'){
        $sumatoriaROFeme1 ++;
    }
}
print_r($sumatoriaROFeme1."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['RO'] == '1'){
        $sumatoriaROMasc1 ++;
    }
}
print_r($sumatoriaROMasc1."  ");

//----------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['RO'] == '2'){
        $sumatoriaROFeme2 ++;
    }
}
print_r($sumatoriaROFeme2."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['RO'] == '2'){
        $sumatoriaROMasc2 ++;
    }
}
print_r($sumatoriaROMasc2."  ");

//--------------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['RO'] == '3'){
        $sumatoriaROFeme3 ++;
    }
}
print_r($sumatoriaROFeme3."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['RO'] == '3'){
        $sumatoriaROMasc3 ++;
    }
}
print_r($sumatoriaROMasc3."  ");

//-----------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['RO'] == '4'){
        $sumatoriaROFeme4 ++;
    }
}
print_r($sumatoriaROFeme4."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['RO'] == '4'){
        $sumatoriaROMasc4 ++;
    }
}
print_r($sumatoriaROMasc4."  ");

//--------------------------------------------------------Estilo------------------------------------------------------------------

$sumatoriaEstiFeme1 = 0;
$sumatoriaEstiMasc1 = 0;

$sumatoriaEstiFeme2 = 0;
$sumatoriaEstiMasc2 = 0;

$sumatoriaEstiFeme3 = 0;
$sumatoriaEstiMasc3 = 0;

$sumatoriaEstiFeme4 = 0;
$sumatoriaEstiMasc4 = 0;


echo nl2br("\n");

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Estilo'] == 'ACOMODADOR'){
        $sumatoriaEstiFeme1 ++;
    }
}
print_r($sumatoriaEstiFeme1."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Estilo'] == 'ACOMODADOR'){
        $sumatoriaEstiMasc1 ++;
    }
}
print_r($sumatoriaEstiMasc1."  ");

//-----------------------------------

for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Estilo'] == 'ASIMILADOR'){
        $sumatoriaEstiFeme2 ++;
    }
}
print_r($sumatoriaEstiFeme2."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Estilo'] == 'ASIMILADOR'){
        $sumatoriaEstiMasc2 ++;
    }
}
print_r($sumatoriaEstiMasc2."  ");

//---------------------------------------
for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Estilo'] == 'CONVERGENTE'){
        $sumatoriaEstiFeme3 ++;
    }
}
print_r($sumatoriaEstiFeme3."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Estilo'] == 'CONVERGENTE'){
        $sumatoriaEstiMasc3 ++;
    }
}
print_r($sumatoriaEstiMasc3."  ");
//--------------------------------------------
for($i=0;$i<=12;$i++){                       
    if($datas[$i]['Estilo'] == 'DIVERGENTE'){
        $sumatoriaEstiFeme4 ++;
    }
}
print_r($sumatoriaEstiFeme4."  ");

for($i=13;$i<=76;$i++){                      
    if($datas[$i]['Estilo'] == 'DIVERGENTE'){
        $sumatoriaEstiMasc4 ++;
    }
}
print_r($sumatoriaEstiMasc4."  ");



//crearemos la tabla suma_si_sexo, calculos SUMAR.SI de cada una de las funciones
/*
$creaTabla = "CREATE TABLE suma_si_sexo(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
     Recinto int (11),
     Promedio int (11),
     CA int (11),
     EC int (11),
     EA int (11),
     RO int (11),
     Estilo int (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);

*/


/*
VALUES ($sumatoriaRecinFemeT, $sumatoriaPromFemeA, $sumatoriaCAFeme1, $sumatoriaECFeme1, $sumatoriaEAFeme1, $sumatoriaROFeme1, $sumatoriaEstiFeme1)";
VALUES ($sumatoriaRecinMascT, $sumatoriaPromMascA, $sumatoriaCAMasc1, $sumatoriaECMasc1, $sumatoriaEAMasc1, $sumatoriaROMasc1, $sumatoriaEstiMasc1)";

VALUES ($sumatoriaRecinFemeP, $sumatoriaPromFemeB, $sumatoriaCAFeme2, $sumatoriaECFeme2, $sumatoriaEAFeme2, $sumatoriaROFeme2, $sumatoriaEstiFeme2)";
VALUES ($sumatoriaRecinMascP, $sumatoriaPromMascB, $sumatoriaCAMasc2, $sumatoriaECMasc2, $sumatoriaEAMasc2, $sumatoriaROMasc2, $sumatoriaEstiMasc2)";

VALUES (0, $sumatoriaPromFemeC, $sumatoriaCAFeme3, $sumatoriaECFeme3, $sumatoriaEAFeme3, $sumatoriaROFeme3, $sumatoriaEstiFeme3)";
VALUES (0, $sumatoriaPromMascC, $sumatoriaCAMasc3, $sumatoriaECMasc3, $sumatoriaEAMasc3, $sumatoriaROMasc3, $sumatoriaEstiMasc3)";

VALUES (0, $sumatoriaPromFemeD, $sumatoriaCAFeme4, $sumatoriaECFeme4, $sumatoriaEAFeme4, $sumatoriaROFeme4, $sumatoriaEstiFeme4)";
VALUES (0, $sumatoriaPromMascD, $sumatoriaCAMasc4, $sumatoriaECMasc4, $sumatoriaEAMasc4, $sumatoriaROMasc4, $sumatoriaEstiMasc4)";

*/

/*
$insertar ="INSERT INTO suma_si_sexo (Recinto, Promedio, CA, EC, EA, RO, Estilo) 
VALUES (0, $sumatoriaPromMascD, $sumatoriaCAMasc4, $sumatoriaECMasc4, $sumatoriaEAMasc4, $sumatoriaROMasc4, $sumatoriaEstiMasc4)";
$con->query($insertar);
*/

//crearemos la tabla sexo_prob, 
/*
$creaTabla = "CREATE TABLE sexo_prob(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
     Recinto float (11),
     Promedio float (11),
     CA float (11),
     EC float (11),
     EA float (11),
     RO float (11),
     Estilo float (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/

/*

VALUES (($sumatoriaRecinFemeT+$m*(1/$calcPRecinto))/($freqFE+$m), ($sumatoriaPromFemeA+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaCAFeme1+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaECFeme1+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaEAFeme1+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaROFeme1+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaEstiFeme1+$m*(1/$calcPPpromedio))/($freqFE+$m))";
VALUES (($sumatoriaRecinMascT+$m*(1/$calcPRecinto))/($freqMA+$m), ($sumatoriaPromMascA+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaCAMasc1+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaECMasc1+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEAMasc1+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaROMasc1+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEstiMasc1+$m*(1/$calcPPpromedio))/($freqMA+$m))";

VALUES (($sumatoriaRecinFemeP+$m*(1/$calcPRecinto))/($freqFE+$m), ($sumatoriaPromFemeB+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaCAFeme2+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaECFeme2+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaEAFeme2+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaROFeme2+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaEstiFeme2+$m*(1/$calcPPpromedio))/($freqFE+$m))";
VALUES (($sumatoriaRecinMascP+$m*(1/$calcPRecinto))/($freqMA+$m), ($sumatoriaPromMascB+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaCAMasc2+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaECMasc2+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEAMasc2+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaROMasc2+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEstiMasc2+$m*(1/$calcPPpromedio))/($freqMA+$m))";

VALUES ((0+$m*(1/$calcPRecinto))/($freqFE+$m), ($sumatoriaPromFemeC+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaCAFeme3+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaECFeme3+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaEAFeme3+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaROFeme3+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaEstiFeme3+$m*(1/$calcPPpromedio))/($freqFE+$m))";
VALUES ((0+$m*(1/$calcPRecinto))/($freqMA+$m), ($sumatoriaPromMascC+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaCAMasc3+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaECMasc3+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEAMasc3+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaROMasc3+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEstiMasc3+$m*(1/$calcPPpromedio))/($freqMA+$m))";


VALUES ((0+$m*(1/$calcPRecinto))/($freqFE+$m), ($sumatoriaPromFemeD+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaCAFeme4+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaECFeme4+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaEAFeme4+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaROFeme4+$m*(1/$calcPPpromedio))/($freqFE+$m), ($sumatoriaEstiFeme4+$m*(1/$calcPPpromedio))/($freqFE+$m))";
VALUES ((0+$m*(1/$calcPRecinto))/($freqMA+$m), ($sumatoriaPromMascD+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaCAMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaECMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEAMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaROMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEstiMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m))";

*/

/*
$insertar ="INSERT INTO sexo_prob (Recinto, Promedio, CA, EC, EA, RO, Estilo) 
VALUES ((0+$m*(1/$calcPRecinto))/($freqMA+$m), ($sumatoriaPromMascD+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaCAMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaECMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEAMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaROMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m), ($sumatoriaEstiMasc4+$m*(1/$calcPPpromedio))/($freqMA+$m))";
if($con->query($insertar) === True)
    echo " inserta fila";
else
    die( "fila no creada".$con->error);
*/

?>