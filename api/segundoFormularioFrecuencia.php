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

//Aca se obtendra la frecuencia de cada una de las clases (PARAISO, TURRIALBA) para este caso
//ademas se obtendra el P(vj) --> el valor por el cual se multiplica la provabilidad condicional
//por otro lado se obtendra el p que es la cantidad  de datos distintos entre 1
include("conexionDB.php");// se instancia la clase
$con=conexionDB();//se llama a la funcion 

//echo "Se logro una exitosa conexion a la base";

//Para iniciar crearemos la tabla recinto_freq_pvj_p, con int de 11 pensando en un futuro incremento
/*
$creaTabla = "CREATE TABLE recinto_freq_pvj_p(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
    freqTU int (11),
    freqPA int (11),
    pvjTU float (11),
    pvjPA float (11),
    p float (11),
    pp float (11),
    m int (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/

//sentencias que cuenta las frecuencias de TURRI Y PARAISO
$freqTU = current($con->query("SELECT COUNT(Recinto) FROM recinto WHERE Recinto = 'Turrialba'")->fetch_assoc());
$freqPA = current($con->query("SELECT COUNT(Recinto) FROM recinto WHERE Recinto = 'Paraiso'")->fetch_assoc());
//sentencia que cuenta el total de registros
$tot = current($con->query("SELECT COUNT(Recinto) FROM recinto")->fetch_assoc());
//sentencias para obtener los valores distintos de cada columna, con esto se hara el 1/calcPsexo, 1/calcPPpromedio
$calcPSexo = current($con->query("SELECT COUNT(DISTINCT Sexo) FROM recinto")->fetch_assoc());
$calcPPpromedio = current($con->query("SELECT COUNT(DISTINCT Promedio) FROM recinto")->fetch_assoc());
// se determina el valor de m(numero de columnas)
$m = 7;


//ingresamos los datos a la tabla
/*
$insertar ="INSERT INTO recinto_freq_pvj_p (freqTU, freqPA, pvjTU, pvjPA, p,  pp, m) 
VALUES ($freqTU, $freqPA, $freqTU/$tot, $freqPA/$tot, 1/$calcPSexo, 1/($calcPPpromedio+1) , $m)";
$con->query($insertar);
*/

$sql = "SELECT Sexo, Promedio, CA, EC, EA, RO, Estilo FROM recinto"; 
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){//si hay mas de 0 filas ...
        while($row = mysqli_fetch_assoc($result)){

          $datas[]= $row;// lo que hace es insertar cada una de las filas de la tabla como arreglos en la variable datas[] 
               
        }
}


$sumatoriaSexoTum = 0;
$sumatoriaSexoPam = 0;

$sumatoriaSexoTuf = 0;
$sumatoriaSexoPaf = 0;

echo nl2br("\n");

for($i=0;$i<=37;$i++){                       //rango de Turrialba en BD, se contempla uno menos, debido a que empezamos en 0
    if($datas[$i]['Sexo'] == 'M'){
        $sumatoriaSexoTum ++;
    }
}
print_r($sumatoriaSexoTum."  ");

for($i=38;$i<=76;$i++){                      //rango de Paraisp en BD, se contempla uno menos, debido a que empezamos en 38
    if($datas[$i]['Sexo'] == 'M'){
        $sumatoriaSexoPam ++;
    }
}
print_r($sumatoriaSexoPam."  ");

//-----------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Sexo'] == 'F'){
        $sumatoriaSexoTuf ++;
    }
}
print_r($sumatoriaSexoTuf."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Sexo'] == 'F'){
        $sumatoriaSexoPaf ++;
    }
}
print_r($sumatoriaSexoPaf."  ");

//-----------------------------------------------PROMEDIO--------------------------------------------------------------------

$sumatoriaPromTuA = 0;
$sumatoriaPromPaA = 0;

$sumatoriaPromTuB = 0;
$sumatoriaPromPaB = 0;

$sumatoriaPromTuC = 0;
$sumatoriaPromPaC = 0;

$sumatoriaPromTuD = 0;
$sumatoriaPromPaD = 0;

echo nl2br("\n");

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Promedio'] == 'A'){
        $sumatoriaPromTuA ++;
    }
}
print_r($sumatoriaPromTuA."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Promedio'] == 'A'){
        $sumatoriaPromPaA ++;
    }
}
print_r($sumatoriaPromPaA."  ");

///---------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Promedio'] == 'B'){
        $sumatoriaPromTuB ++;
    }
}
print_r($sumatoriaPromTuB."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Promedio'] == 'B'){
        $sumatoriaPromPaB ++;
    }
}
print_r($sumatoriaPromPaB."  ");

//----------------------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Promedio'] == 'C'){
        $sumatoriaPromTuC ++;
    }
}
print_r($sumatoriaPromTuC."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Promedio'] == 'C'){
        $sumatoriaPromPaC ++;
    }
}
print_r($sumatoriaPromPaC."  ");

//--------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Promedio'] == 'D'){
        $sumatoriaPromTuD ++;
    }
}
print_r($sumatoriaPromTuD."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Promedio'] == 'D'){
        $sumatoriaPromPaD ++;
    }
}
print_r($sumatoriaPromPaD."  ");

//-----------------------------------------------------------CA ------------------------------------------------------------

$sumatoriaCATu1 = 0;
$sumatoriaCAPa1 = 0;

$sumatoriaCATu2 = 0;
$sumatoriaCAPa2 = 0;

$sumatoriaCATu3 = 0;
$sumatoriaCAPa3 = 0;

$sumatoriaCATu4 = 0;
$sumatoriaCAPa4 = 0;

echo nl2br("\n");

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['CA'] == '1'){
        $sumatoriaCATu1 ++;
    }
}
print_r($sumatoriaCATu1."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['CA'] == '1'){
        $sumatoriaCAPa1 ++;
    }
}
print_r($sumatoriaCAPa1."  ");

//-------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['CA'] == '2'){
        $sumatoriaCATu2 ++;
    }
}
print_r($sumatoriaCATu2."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['CA'] == '2'){
        $sumatoriaCAPa2 ++;
    }
}
print_r($sumatoriaCAPa2."  ");

//---------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['CA'] == '3'){
        $sumatoriaCATu3 ++;
    }
}
print_r($sumatoriaCATu3."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['CA'] == '3'){
        $sumatoriaCAPa3 ++;
    }
}
print_r($sumatoriaCAPa3."  ");

//------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['CA'] == '4'){
        $sumatoriaCATu4 ++;
    }
}
print_r($sumatoriaCATu4."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['CA'] == '4'){
        $sumatoriaCAPa4 ++;
    }
}
print_r($sumatoriaCAPa4."  ");

//-----------------------------------------------------------------------------------EC-----------------------------------------------

$sumatoriaECTu1 = 0;
$sumatoriaECPa1 = 0;

$sumatoriaECTu2 = 0;
$sumatoriaECPa2 = 0;

$sumatoriaECTu3 = 0;
$sumatoriaECPa3 = 0;

$sumatoriaECTu4 = 0;
$sumatoriaECPa4 = 0;


echo nl2br("\n");

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['EC'] == '1'){
        $sumatoriaECTu1 ++;
    }
}
print_r($sumatoriaECTu1."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['EC'] == '1'){
        $sumatoriaECPa1 ++;
    }
}
print_r($sumatoriaECPa1."  ");

//-------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['EC'] == '2'){
        $sumatoriaECTu2 ++;
    }
}
print_r($sumatoriaECTu2."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['EC'] == '2'){
        $sumatoriaECPa2 ++;
    }
}
print_r($sumatoriaECPa2."  ");

//----------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['EC'] == '3'){
        $sumatoriaECTu3 ++;
    }
}
print_r($sumatoriaECTu3."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['EC'] == '3'){
        $sumatoriaECPa3 ++;
    }
}
print_r($sumatoriaECPa3."  ");

//--------------------------------------


for($i=0;$i<=37;$i++){                       
    if($datas[$i]['EC'] == '4'){
        $sumatoriaECTu4 ++;
    }
}
print_r($sumatoriaECTu4."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['EC'] == '4'){
        $sumatoriaECPa4 ++;
    }
}
print_r($sumatoriaECPa4."  ");

//-------------------------------------------------------------------------EA-----------------------------------------------------

$sumatoriaEATu1 = 0;
$sumatoriaEAPa1 = 0;

$sumatoriaEATu2 = 0;
$sumatoriaEAPa2 = 0;

$sumatoriaEATu3 = 0;
$sumatoriaEAPa3 = 0;

$sumatoriaEATu4 = 0;
$sumatoriaEAPa4 = 0;



echo nl2br("\n");

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['EA'] == '1'){
        $sumatoriaEATu1 ++;
    }
}
print_r($sumatoriaEATu1."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['EA'] == '1'){
        $sumatoriaEAPa1 ++;
    }
}
print_r($sumatoriaEAPa1."  ");

//----------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['EA'] == '2'){
        $sumatoriaEATu2 ++;
    }
}
print_r($sumatoriaEATu2."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['EA'] == '2'){
        $sumatoriaEAPa2 ++;
    }
}
print_r($sumatoriaEAPa2."  ");

//---------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['EA'] == '3'){
        $sumatoriaEATu3 ++;
    }
}
print_r($sumatoriaEATu3."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['EA'] == '3'){
        $sumatoriaEAPa3 ++;
    }
}
print_r($sumatoriaEAPa3."  ");

///-----------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['EA'] == '4'){
        $sumatoriaEATu4 ++;
    }
}
print_r($sumatoriaEATu4."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['EA'] == '4'){
        $sumatoriaEAPa4 ++;
    }
}
print_r($sumatoriaEAPa4."  ");

///--------------------------------------------------------------------RO------------------------------------------------------------

$sumatoriaROTu1 = 0;
$sumatoriaROPa1 = 0;

$sumatoriaROTu2 = 0;
$sumatoriaROPa2 = 0;

$sumatoriaROTu3 = 0;
$sumatoriaROPa3 = 0;

$sumatoriaROTu4 = 0;
$sumatoriaROPa4 = 0;

echo nl2br("\n");

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['RO'] == '1'){
        $sumatoriaROTu1 ++;
    }
}
print_r($sumatoriaROTu1."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['RO'] == '1'){
        $sumatoriaROPa1 ++;
    }
}
print_r($sumatoriaROPa1."  ");

//----------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['RO'] == '2'){
        $sumatoriaROTu2 ++;
    }
}
print_r($sumatoriaROTu2."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['RO'] == '2'){
        $sumatoriaROPa2 ++;
    }
}
print_r($sumatoriaROPa2."  ");

//------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['RO'] == '3'){
        $sumatoriaROTu3 ++;
    }
}
print_r($sumatoriaROTu3."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['RO'] == '3'){
        $sumatoriaROPa3 ++;
    }
}
print_r($sumatoriaROPa3."  ");

//--------------------------------------


for($i=0;$i<=37;$i++){                       
    if($datas[$i]['RO'] == '4'){
        $sumatoriaROTu4 ++;
    }
}
print_r($sumatoriaROTu4."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['RO'] == '4'){
        $sumatoriaROPa4 ++;
    }
}
print_r($sumatoriaROPa4."  ");





//------------------------------------------------------ESTIOLO---------------------------------------


$sumatoriaESTITuAcom = 0;
$sumatoriaESTIPaAcom = 0;

$sumatoriaESTITuAsim = 0;
$sumatoriaESTIPaAsim = 0;

$sumatoriaESTITuConv = 0;
$sumatoriaESTIPaConv = 0;

$sumatoriaESTITuDiv = 0;
$sumatoriaESTIPaDiv = 0;



echo nl2br("\n");


for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Estilo'] == 'ACOMODADOR'){
        $sumatoriaESTITuAcom ++;
    }
}
print_r($sumatoriaESTITuAcom."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Estilo'] == 'ACOMODADOR'){
        $sumatoriaESTIPaAcom ++;
    }
}
print_r($sumatoriaESTIPaAcom."  ");

//-----------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Estilo'] == 'ASIMILADOR'){
        $sumatoriaESTITuAsim ++;
    }
}
print_r($sumatoriaESTITuAsim."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Estilo'] == 'ASIMILADOR'){
        $sumatoriaESTIPaAsim ++;
    }
}
print_r($sumatoriaESTIPaAsim."  ");

/////////------------------------------------------
for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Estilo'] == 'CONVERGENTE'){
        $sumatoriaESTITuConv ++;
    }
}
print_r($sumatoriaESTITuConv."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Estilo'] == 'CONVERGENTE'){
        $sumatoriaESTIPaConv ++;
    }
}
print_r($sumatoriaESTIPaConv."  ");

//------------------------------------------

for($i=0;$i<=37;$i++){                       
    if($datas[$i]['Estilo'] == 'DIVERGENTE'){
        $sumatoriaESTITuDiv ++;
    }
}
print_r($sumatoriaESTITuDiv."  ");

for($i=38;$i<=76;$i++){                      
    if($datas[$i]['Estilo'] == 'DIVERGENTE'){
        $sumatoriaESTIPaDiv ++;
    }
}
print_r($sumatoriaESTIPaDiv."  ");

//crearemos la tabla suma_si_recinto, calculos SUMAR.SI de cada una de las funciones
/*
$creaTabla = "CREATE TABLE suma_si_recinto(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
     Sexo int (11),
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
VALUES ($sumatoriaSexoTum, $sumatoriaPromTuA, $sumatoriaCATu1, $sumatoriaECTu1, $sumatoriaEATu1, $sumatoriaROTu1, $sumatoriaESTITuAcom )";
VALUES ($sumatoriaSexoPam, $sumatoriaPromPaA, $sumatoriaCAPa1, $sumatoriaECPa1, $sumatoriaEAPa1, $sumatoriaROPa1, $sumatoriaESTIPaAcom )";

VALUES ($sumatoriaSexoTuf, $sumatoriaPromTuB, $sumatoriaCATu2, $sumatoriaECTu2, $sumatoriaEATu2, $sumatoriaROTu2, $sumatoriaESTITuAsim )";
VALUES ($sumatoriaSexoPaf, $sumatoriaPromPaB, $sumatoriaCAPa2, $sumatoriaECPa2, $sumatoriaEAPa2, $sumatoriaROPa2, $sumatoriaESTIPaAsim )";

VALUES (0, $sumatoriaPromTuC, $sumatoriaCATu3, $sumatoriaECTu3, $sumatoriaEATu3, $sumatoriaROTu3, $sumatoriaESTITuConv )";
VALUES (0, $sumatoriaPromPaC, $sumatoriaCAPa3, $sumatoriaECPa3, $sumatoriaEAPa3, $sumatoriaROPa3, $sumatoriaESTIPaConv )";

VALUES (0, $sumatoriaPromTuD, $sumatoriaCATu4, $sumatoriaECTu4, $sumatoriaEATu4, $sumatoriaROTu4, $sumatoriaESTITuDiv )";
VALUES (0, $sumatoriaPromPaD, $sumatoriaCAPa4, $sumatoriaECPa4, $sumatoriaEAPa4, $sumatoriaROPa4, $sumatoriaESTIPaDiv )";

*/

/*
$insertar ="INSERT INTO suma_si_recinto (Sexo, Promedio, CA, EC, EA, RO, Estilo) 
VALUES (0, $sumatoriaPromPaD, $sumatoriaCAPa4, $sumatoriaECPa4, $sumatoriaEAPa4, $sumatoriaROPa4, $sumatoriaESTIPaDiv )";
$con->query($insertar);
*/

//crearemos la tabla recinto_prob, 
/*
$creaTabla = "CREATE TABLE recinto_prob(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
     Sexo float (11),
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

VALUES (($sumatoriaSexoTum+$m*(1/$calcPSexo))/($freqTU+$m), ($sumatoriaPromTuA+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaCATu1+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaECTu1+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaEATu1+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaROTu1+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaESTITuAcom+$m*(1/$calcPPpromedio))/($freqTU+$m))";
VALUES (($sumatoriaSexoPam+$m*(1/$calcPSexo))/($freqPA+$m), ($sumatoriaPromPaA+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaCAPa1+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaECPa1+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaEAPa1+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaROPa1+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaESTIPaAcom+$m*(1/$calcPPpromedio))/($freqPA+$m) )";

VALUES (($sumatoriaSexoTuf+$m*(1/$calcPSexo))/($freqTU+$m), ($sumatoriaPromTuB+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaCATu2+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaECTu2+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaEATu2+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaROTu2+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaESTITuAsim+$m*(1/$calcPPpromedio))/($freqTU+$m) )";
VALUES (($sumatoriaSexoPaf+$m*(1/$calcPSexo))/($freqPA+$m), ($sumatoriaPromPaB+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaCAPa2+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaECPa2+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaEAPa2+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaROPa2+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaESTIPaAsim+$m*(1/$calcPPpromedio))/($freqPA+$m) )";

VALUES ((0+$m*(1/$calcPSexo))/($freqTU+$m), ($sumatoriaPromTuC+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaCATu3+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaECTu3+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaEATu3+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaROTu3+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaESTITuConv+$m*(1/$calcPPpromedio))/($freqTU+$m) )";
VALUES ((0+$m*(1/$calcPSexo))/($freqPA+$m), ($sumatoriaPromPaC+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaCAPa3+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaECPa3+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaEAPa3+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaROPa3+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaESTIPaConv+$m*(1/$calcPPpromedio))/($freqPA+$m) )";

VALUES ((0+$m*(1/$calcPSexo))/($freqTU+$m), ($sumatoriaPromTuD+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaCATu4+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaECTu4+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaEATu4+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaROTu4+$m*(1/$calcPPpromedio))/($freqTU+$m), ($sumatoriaESTITuDiv+$m*(1/$calcPPpromedio))/($freqTU+$m) )";
VALUES ((0+$m*(1/$calcPSexo))/($freqPA+$m), ($sumatoriaPromPaD+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaCAPa4+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaECPa4+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaEAPa4+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaROPa4+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaESTIPaDiv+$m*(1/$calcPPpromedio))/($freqPA+$m) )";

*/

/*
$insertar ="INSERT INTO recinto_prob (Sexo, Promedio, CA, EC, EA, RO, Estilo) 
VALUES ((0+$m*(1/$calcPSexo))/($freqPA+$m), ($sumatoriaPromPaD+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaCAPa4+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaECPa4+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaEAPa4+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaROPa4+$m*(1/$calcPPpromedio))/($freqPA+$m), ($sumatoriaESTIPaDiv+$m*(1/$calcPPpromedio))/($freqPA+$m) )";
if($con->query($insertar) === True)
    echo " inserta fila";
else
    die( "fila no creada".$con->error);
*/
?>