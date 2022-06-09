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

//Aca se obtendra la frecuencia de cada una de las clases (Acomodador, Asimilador, Convergente, Divergente) para este caso
//ademas se obtendra el P(vj) --> el valor por el cual se multiplica la provabilidad condicional
//por otro lado se obtendra el p que es la cantidad  de datos distintos entre 1
include("conexionDB.php");// se instancia la clase
$con=conexionDB();//se llama a la funcion 

//echo "Se logro una exitosa conexion a la base";

//Para iniciar crearemos la tabla estilo2_freq_pvj_p, con int de 11 pensando en un futuro incremento
/*
$creaTabla = "CREATE TABLE estilo2_freq_pvj_p(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
    freqAcom int (11),
    freqAsim int (11),
    freqConv int (11),
    freqDiv int (11),
    pvjAcom float (11),
    pvjAsim float (11),
    pvjConv float (11),
    pvjDiv float (11),
    p float (11),
    pp float (11),
    m int (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/

//sentencias que cuenta las frecuencias de Acomodador, Asimilador, Convergente, Divergente
$freqAcom = current($con->query("SELECT COUNT(Estilo) FROM estilos2 WHERE Estilo = 'ACOMODADOR'")->fetch_assoc());
$freqAsim = current($con->query("SELECT COUNT(Estilo) FROM estilos2 WHERE Estilo = 'ASIMILADOR'")->fetch_assoc());
$freqConv = current($con->query("SELECT COUNT(Estilo) FROM estilos2 WHERE Estilo = 'CONVERGENTE'")->fetch_assoc());
$freqDiv = current($con->query("SELECT COUNT(Estilo) FROM estilos2 WHERE Estilo = 'DIVERGENTE'")->fetch_assoc());
//sentencia que cuenta el total de registros
$tot = current($con->query("SELECT COUNT(Estilo) FROM estilos2")->fetch_assoc());
//sentencias para obtener los valores distintos de cada columna, no se toma en cuanta las columnas EC EA RO, con esto se hara el 1/calcPCA
$calcPCA = current($con->query("SELECT COUNT(DISTINCT CA) FROM estilos2")->fetch_assoc());
$calcPRec = current($con->query("SELECT COUNT(DISTINCT Recinto) FROM estilos2")->fetch_assoc());
// se determina el valor de m(numero de columnas)
$m = 7;


//ingresamos los datos a la tabla
/*
$insertar ="INSERT INTO estilo2_freq_pvj_p (freqAcom, freqAsim, freqConv, freqDiv, pvjAcom, pvjAsim, pvjConv, pvjDiv,  p, pp,  m) 
VALUES ($freqAcom, $freqAsim, $freqConv, $freqDiv, $freqAcom/$tot, $freqAsim/$tot, $freqConv/$tot, $freqDiv/$tot, 1/$calcPCA, 1/$calcPRec,  $m)";
$con->query($insertar);
*/

$sql = "SELECT Sexo, Recinto, Promedio, CA, EC, EA, RO FROM estilos2"; 
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result)>0){//si hay mas de 0 filas ...
        while($row = mysqli_fetch_assoc($result)){

          $datas[]= $row;// lo que hace es insertar cada una de las filas de la tabla como arreglos en la variable datas[] 
               
        }
}
//Calculos para la tabla sumar.si
$sumatoriaSEXComF=0;
$sumatoriaSEXAsimF=0;
$sumatoriaSEXConvF=0;
$sumatoriaSEXDivF=0;

$sumatoriaSEXComM=0;
$sumatoriaSEXAsimM=0;
$sumatoriaSEXConvM=0;
$sumatoriaSEXDivM=0;

echo nl2br("\n");


for($i=0;$i<=13;$i++){                       //rango de Acomoddaor en BD, se contempla uno menos, debido a que empezamos en 0
    if($datas[$i]['Sexo'] == 'F'){
        $sumatoriaSEXComF ++;
    }
}
print_r($sumatoriaSEXComF."  ");

for($i=14;$i<=34;$i++){                      //rango de Asimilador en BD, se contempla uno menos, debido a que empezamos en 14
    if($datas[$i]['Sexo'] == 'F'){
        $sumatoriaSEXAsimF ++;
    }
}
print_r($sumatoriaSEXAsimF."  ");


for($i=35;$i<=55;$i++){                       //rango de Convergente en BD, se contempla uno menos, debido a que empieza en 35      
    if($datas[$i]['Sexo'] == 'F'){
        $sumatoriaSEXConvF ++;
    }
}
print_r($sumatoriaSEXConvF."  ");

for($i=56;$i<=76;$i++){                        //rango de Divergente en BD, se contempla uno menos, debido a que empieza en 35 
    if($datas[$i]['Sexo'] == 'F'){
        $sumatoriaSEXDivF ++;
    }
}
print_r($sumatoriaSEXDivF."  ");

//--------------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['Sexo'] == 'M'){
        $sumatoriaSEXComM ++;
    }
}
print_r($sumatoriaSEXComM."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['Sexo'] == 'M'){
        $sumatoriaSEXAsimM ++;
    }
}
print_r($sumatoriaSEXAsimM."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['Sexo'] == 'M'){
        $sumatoriaSEXConvM ++;
    }
}
print_r($sumatoriaSEXConvM."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['Sexo'] == 'M'){
        $sumatoriaSEXDivM ++;
    }
}
print_r($sumatoriaSEXDivM."  ");


//----------------------------------------------------------------- RECINTO ----------------------------------------------------

$sumatoriaREComT=0;
$sumatoriaREAsimT=0;
$sumatoriaREConvT=0;
$sumatoriaREDivT=0;

$sumatoriaREComP=0;
$sumatoriaREAsimP=0;
$sumatoriaREConvP=0;
$sumatoriaREDivP=0;

echo nl2br("\n");


for($i=0;$i<=13;$i++){                       
    if($datas[$i]['Recinto'] == 'Turrialba'){
        $sumatoriaREComT ++;
    }
}
print_r($sumatoriaREComT."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['Recinto'] == 'Turrialba'){
        $sumatoriaREAsimT ++;
    }
}
print_r($sumatoriaREAsimT."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['Recinto'] == 'Turrialba'){
        $sumatoriaREConvT ++;
    }
}
print_r($sumatoriaREConvT."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['Recinto'] == 'Turrialba'){
        $sumatoriaREDivT ++;
    }
}
print_r($sumatoriaREDivT."  ");

//---------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['Recinto'] == 'Paraiso'){
        $sumatoriaREComP ++;
    }
}
print_r($sumatoriaREComP."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['Recinto'] == 'Paraiso'){
        $sumatoriaREAsimP ++;
    }
}
print_r($sumatoriaREAsimP."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['Recinto'] == 'Paraiso'){
        $sumatoriaREConvP ++;
    }
}
print_r($sumatoriaREConvP."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['Recinto'] == 'Paraiso'){
        $sumatoriaREDivP ++;
    }
}
print_r($sumatoriaREDivP."  ");

//-------------------------------------------------------------------- PROMEDIO ---------------------------------------------------

$sumatoriaPRComA=0;
$sumatoriaPRAsimA=0;
$sumatoriaPRConvA=0;
$sumatoriaPRDivA=0;

$sumatoriaPRComB=0;
$sumatoriaPRAsimB=0;
$sumatoriaPRConvB=0;
$sumatoriaPRDivB=0;

$sumatoriaPRComC=0;
$sumatoriaPRAsimC=0;
$sumatoriaPRConvC=0;
$sumatoriaPRDivC=0;

$sumatoriaPRComD=0;
$sumatoriaPRAsimD=0;
$sumatoriaPRConvD=0;
$sumatoriaPRDivD=0;



echo nl2br("\n");


for($i=0;$i<=13;$i++){                       
    if($datas[$i]['Promedio'] == 'A'){
        $sumatoriaPRComA ++;
    }
}
print_r($sumatoriaPRComA."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['Promedio'] == 'A'){
        $sumatoriaPRAsimA ++;
    }
}
print_r($sumatoriaPRAsimA."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['Promedio'] == 'A'){
        $sumatoriaPRConvA ++;
    }
}
print_r($sumatoriaPRConvA."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['Promedio'] == 'A'){
        $sumatoriaPRDivA ++;
    }
}
print_r($sumatoriaPRDivA."  ");

//----------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['Promedio'] == 'B'){
        $sumatoriaPRComB ++;
    }
}
print_r($sumatoriaPRComB."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['Promedio'] == 'B'){
        $sumatoriaPRAsimB ++;
    }
}
print_r($sumatoriaPRAsimB."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['Promedio'] == 'B'){
        $sumatoriaPRConvB ++;
    }
}
print_r($sumatoriaPRConvB."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['Promedio'] == 'B'){
        $sumatoriaPRDivB ++;
    }
}
print_r($sumatoriaPRDivB."  ");

//--------------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['Promedio'] == 'C'){
        $sumatoriaPRComC ++;
    }
}
print_r($sumatoriaPRComC."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['Promedio'] == 'C'){
        $sumatoriaPRAsimC ++;
    }
}
print_r($sumatoriaPRAsimC."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['Promedio'] == 'C'){
        $sumatoriaPRConvC ++;
    }
}
print_r($sumatoriaPRConvC."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['Promedio'] == 'C'){
        $sumatoriaPRDivC ++;
    }
}
print_r($sumatoriaPRDivC."  ");


//---------------------------------


for($i=0;$i<=13;$i++){                       
    if($datas[$i]['Promedio'] == 'D'){
        $sumatoriaPRComD ++;
    }
}
print_r($sumatoriaPRComD."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['Promedio'] == 'D'){
        $sumatoriaPRAsimD ++;
    }
}
print_r($sumatoriaPRAsimD."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['Promedio'] == 'D'){
        $sumatoriaPRConvD ++;
    }
}
print_r($sumatoriaPRConvD."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['Promedio'] == 'D'){
        $sumatoriaPRDivD ++;
    }
}
print_r($sumatoriaPRDivD."  ");



//------------------------------------------------------------CA---------------------------------------------------------
$sumatoriaCACom1=0;
$sumatoriaCAAsim1=0;
$sumatoriaCAConv1=0;
$sumatoriaCADiv1=0;

$sumatoriaCACom2=0;
$sumatoriaCAAsim2=0;
$sumatoriaCAConv2=0;
$sumatoriaCADiv2=0;

$sumatoriaCACom3=0;
$sumatoriaCAAsim3=0;
$sumatoriaCAConv3=0;
$sumatoriaCADiv3=0;

$sumatoriaCACom4=0;
$sumatoriaCAAsim4=0;
$sumatoriaCAConv4=0;
$sumatoriaCADiv4=0;



echo nl2br("\n");


for($i=0;$i<=13;$i++){                       
    if($datas[$i]['CA'] == '1'){
        $sumatoriaCACom1 ++;
    }
}
print_r($sumatoriaCACom1."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['CA'] == '1'){
        $sumatoriaCAAsim1 ++;
    }
}
print_r($sumatoriaCAAsim1."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['CA'] == '1'){
        $sumatoriaCAConv1 ++;
    }
}
print_r($sumatoriaCAConv1."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['CA'] == '1'){
        $sumatoriaCADiv1 ++;
    }
}
print_r($sumatoriaCADiv1."  "); 

//--------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['CA'] == '2'){
        $sumatoriaCACom2 ++;
    }
}
print_r($sumatoriaCACom2."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['CA'] == '2'){
        $sumatoriaCAAsim2 ++;
    }
}
print_r($sumatoriaCAAsim2."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['CA'] == '2'){
        $sumatoriaCAConv2 ++;
    }
}
print_r($sumatoriaCAConv2."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['CA'] == '2'){
        $sumatoriaCADiv2 ++;
    }
}
print_r($sumatoriaCADiv2."  ");

//--------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['CA'] == '3'){
        $sumatoriaCACom3 ++;
    }
}
print_r($sumatoriaCACom3."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['CA'] == '3'){
        $sumatoriaCAAsim3 ++;
    }
}
print_r($sumatoriaCAAsim3."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['CA'] == '3'){
        $sumatoriaCAConv3 ++;
    }
}
print_r($sumatoriaCAConv3."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['CA'] == '3'){
        $sumatoriaCADiv3 ++;
    }
}
print_r($sumatoriaCADiv3."  ");

//----------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['CA'] == '4'){
        $sumatoriaCACom4 ++;
    }
}
print_r($sumatoriaCACom4."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['CA'] == '4'){
        $sumatoriaCAAsim4 ++;
    }
}
print_r($sumatoriaCAAsim4."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['CA'] == '4'){
        $sumatoriaCAConv4 ++;
    }
}
print_r($sumatoriaCAConv4."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['CA'] == '4'){
        $sumatoriaCADiv4 ++;
    }
}
print_r($sumatoriaCADiv4."  ");
//-------------------------------------------------EC------------------------------------------------------------------------

$sumatoriaECCom1=0;
$sumatoriaECAsim1=0;
$sumatoriaECConv1=0;
$sumatoriaECDiv1=0;

$sumatoriaECCom2=0;
$sumatoriaECAsim2=0;
$sumatoriaECConv2=0;
$sumatoriaECDiv2=0;

$sumatoriaECCom3=0;
$sumatoriaECAsim3=0;
$sumatoriaECConv3=0;
$sumatoriaECDiv3=0;

$sumatoriaECCom4=0;
$sumatoriaECAsim4=0;
$sumatoriaECConv4=0;
$sumatoriaECDiv4=0;


echo nl2br("\n");


for($i=0;$i<=13;$i++){                       
    if($datas[$i]['EC'] == '1'){
        $sumatoriaECCom1 ++;
    }
}
print_r($sumatoriaECCom1."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['EC'] == '1'){
        $sumatoriaECAsim1 ++;
    }
}
print_r($sumatoriaECAsim1."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['EC'] == '1'){
        $sumatoriaECConv1 ++;
    }
}
print_r($sumatoriaECConv1."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['EC'] == '1'){
        $sumatoriaECDiv1 ++;
    }
}
print_r($sumatoriaECDiv1."  "); 

//----------------------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['EC'] == '2'){
        $sumatoriaECCom2 ++;
    }
}
print_r($sumatoriaECCom2."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['EC'] == '2'){
        $sumatoriaECAsim2 ++;
    }
}
print_r($sumatoriaECAsim2."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['EC'] == '2'){
        $sumatoriaECConv2 ++;
    }
}
print_r($sumatoriaECConv2."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['EC'] == '2'){
        $sumatoriaECDiv2 ++;
    }
}
print_r($sumatoriaECDiv2."  "); 

//--------------------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['EC'] == '3'){
        $sumatoriaECCom3 ++;
    }
}
print_r($sumatoriaECCom3."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['EC'] == '3'){
        $sumatoriaECAsim3 ++;
    }
}
print_r($sumatoriaECAsim3."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['EC'] == '3'){
        $sumatoriaECConv3 ++;
    }
}
print_r($sumatoriaECConv3."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['EC'] == '3'){
        $sumatoriaECDiv3 ++;
    }
}
print_r($sumatoriaECDiv3."  "); 

//-----------------------------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['EC'] == '4'){
        $sumatoriaECCom4 ++;
    }
}
print_r($sumatoriaECCom4."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['EC'] == '4'){
        $sumatoriaECAsim4 ++;
    }
}
print_r($sumatoriaECAsim4."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['EC'] == '4'){
        $sumatoriaECConv4 ++;
    }
}
print_r($sumatoriaECConv4."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['EC'] == '4'){
        $sumatoriaECDiv4 ++;
    }
}
print_r($sumatoriaECDiv4."  "); 


//----------------------------------------------------------------EA--------------------------------------------------------

$sumatoriaEACom1=0;
$sumatoriaEAAsim1=0;
$sumatoriaEAConv1=0;
$sumatoriaEADiv1=0;

$sumatoriaEACom2=0;
$sumatoriaEAAsim2=0;
$sumatoriaEAConv2=0;
$sumatoriaEADiv2=0;

$sumatoriaEACom3=0;
$sumatoriaEAAsim3=0;
$sumatoriaEAConv3=0;
$sumatoriaEADiv3=0;

$sumatoriaEACom4=0;
$sumatoriaEAAsim4=0;
$sumatoriaEAConv4=0;
$sumatoriaEADiv4=0;



echo nl2br("\n");


for($i=0;$i<=13;$i++){                       
    if($datas[$i]['EA'] == '1'){
        $sumatoriaEACom1 ++;
    }
}
print_r($sumatoriaEACom1."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['EA'] == '1'){
        $sumatoriaEAAsim1 ++;
    }
}
print_r($sumatoriaEAAsim1."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['EA'] == '1'){
        $sumatoriaEAConv1 ++;
    }
}
print_r($sumatoriaEAConv1."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['EA'] == '1'){
        $sumatoriaEADiv1 ++;
    }
}
print_r($sumatoriaEADiv1."  "); 

//--------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['EA'] == '2'){
        $sumatoriaEACom2 ++;
    }
}
print_r($sumatoriaEACom2."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['EA'] == '2'){
        $sumatoriaEAAsim2 ++;
    }
}
print_r($sumatoriaEAAsim2."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['EA'] == '2'){
        $sumatoriaEAConv2 ++;
    }
}
print_r($sumatoriaEAConv2."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['EA'] == '2'){
        $sumatoriaEADiv2 ++;
    }
}
print_r($sumatoriaEADiv2."  "); 

//-----------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['EA'] == '3'){
        $sumatoriaEACom3 ++;
    }
}
print_r($sumatoriaEACom3."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['EA'] == '3'){
        $sumatoriaEAAsim3 ++;
    }
}
print_r($sumatoriaEAAsim3."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['EA'] == '3'){
        $sumatoriaEAConv3 ++;
    }
}
print_r($sumatoriaEAConv3."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['EA'] == '3'){
        $sumatoriaEADiv3 ++;
    }
}
print_r($sumatoriaEADiv3."  "); 

///----------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['EA'] == '4'){
        $sumatoriaEACom4 ++;
    }
}
print_r($sumatoriaEACom4."  ");

for($i=14;$i<=34;$i++){                     
    if($datas[$i]['EA'] == '4'){
        $sumatoriaEAAsim4 ++;
    }
}
print_r($sumatoriaEAAsim4."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['EA'] == '4'){
        $sumatoriaEAConv4 ++;
    }
}
print_r($sumatoriaEAConv4."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['EA'] == '4'){
        $sumatoriaEADiv4 ++;
    }
}
print_r($sumatoriaEADiv4."  "); 

//------------------------------------------------------RO-------------------------------------------------------------------

$sumatoriaROCom1=0;
$sumatoriaROAsim1=0;
$sumatoriaROConv1=0;
$sumatoriaRODiv1=0;

$sumatoriaROCom2=0;
$sumatoriaROAsim2=0;
$sumatoriaROConv2=0;
$sumatoriaRODiv2=0;

$sumatoriaROCom3=0;
$sumatoriaROAsim3=0;
$sumatoriaROConv3=0;
$sumatoriaRODiv3=0;

$sumatoriaROCom4=0;
$sumatoriaROAsim4=0;
$sumatoriaROConv4=0;
$sumatoriaRODiv4=0;




echo nl2br("\n");


for($i=0;$i<=13;$i++){                       
    if($datas[$i]['RO'] == '1'){
        $sumatoriaROCom1 ++;
    }
}
print_r($sumatoriaROCom1."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['RO'] == '1'){
        $sumatoriaROAsim1 ++;
    }
}
print_r($sumatoriaROAsim1."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['RO'] == '1'){
        $sumatoriaROConv1 ++;
    }
}
print_r($sumatoriaROConv1."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['RO'] == '1'){
        $sumatoriaRODiv1 ++;
    }
}
print_r($sumatoriaRODiv1."  "); 

//----------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['RO'] == '2'){
        $sumatoriaROCom2 ++;
    }
}
print_r($sumatoriaROCom2."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['RO'] == '2'){
        $sumatoriaROAsim2 ++;
    }
}
print_r($sumatoriaROAsim2."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['RO'] == '2'){
        $sumatoriaROConv2 ++;
    }
}
print_r($sumatoriaROConv2."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['RO'] == '2'){
        $sumatoriaRODiv2 ++;
    }
}
print_r($sumatoriaRODiv2."  "); 

//------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['RO'] == '3'){
        $sumatoriaROCom3 ++;
    }
}
print_r($sumatoriaROCom3."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['RO'] == '3'){
        $sumatoriaROAsim3 ++;
    }
}
print_r($sumatoriaROAsim3."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['RO'] == '3'){
        $sumatoriaROConv3 ++;
    }
}
print_r($sumatoriaROConv3."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['RO'] == '3'){
        $sumatoriaRODiv3 ++;
    }
}
print_r($sumatoriaRODiv3."  "); 

//------------------------------------

for($i=0;$i<=13;$i++){                       
    if($datas[$i]['RO'] == '4'){
        $sumatoriaROCom4 ++;
    }
}
print_r($sumatoriaROCom4."  ");

for($i=14;$i<=34;$i++){                      
    if($datas[$i]['RO'] == '4'){
        $sumatoriaROAsim4 ++;
    }
}
print_r($sumatoriaROAsim4."  ");


for($i=35;$i<=55;$i++){                           
    if($datas[$i]['RO'] == '4'){
        $sumatoriaROConv4 ++;
    }
}
print_r($sumatoriaROConv4."  ");

for($i=56;$i<=76;$i++){                        
    if($datas[$i]['RO'] == '4'){
        $sumatoriaRODiv4 ++;
    }
}
print_r($sumatoriaRODiv4."  "); 


//crearemos la tabla suma_si_estilo2, calculos SUMAR.SI de cada una de las funciones
/*
$creaTabla = "CREATE TABLE suma_si_estilo2(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
     Sexo int (11),
     Recinto int (11),
     Promedio int (11),
     CA int (11),
     EC int (11),
     EA int (11),
     RO int (11)

    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);
*/


/*
 VALUES ($sumatoriaSEXComF, $sumatoriaREComT, $sumatoriaPRComA, $sumatoriaCACom1, $sumatoriaECCom1, $sumatoriaEACom1, $sumatoriaROCom1)";
 VALUES ($sumatoriaSEXAsimF, $sumatoriaREAsimT, $sumatoriaPRAsimA, $sumatoriaCAAsim1, $sumatoriaECAsim1, $sumatoriaEAAsim1, $sumatoriaROAsim1)";
 VALUES ($sumatoriaSEXConvF, $sumatoriaREConvT, $sumatoriaPRConvA, $sumatoriaCAConv1, $sumatoriaECConv1, $sumatoriaEAConv1, $sumatoriaROConv1)";
 VALUES ($sumatoriaSEXDivF, $sumatoriaREDivT, $sumatoriaPRDivA, $sumatoriaCADiv1, $sumatoriaECDiv1, $sumatoriaEADiv1, $sumatoriaRODiv1)";

 VALUES ($sumatoriaSEXComM, $sumatoriaREComP, $sumatoriaPRComB, $sumatoriaCACom2, $sumatoriaECCom2, $sumatoriaEACom2, $sumatoriaROCom2)";
 VALUES ($sumatoriaSEXAsimM, $sumatoriaREAsimP, $sumatoriaPRAsimB, $sumatoriaCAAsim2, $sumatoriaECAsim2, $sumatoriaEAAsim2, $sumatoriaROAsim2)";
 VALUES ($sumatoriaSEXConvM, $sumatoriaREConvP, $sumatoriaPRConvB, $sumatoriaCAConv2, $sumatoriaECConv2, $sumatoriaEAConv2, $sumatoriaROConv2)";
 VALUES ($sumatoriaSEXDivM, $sumatoriaREDivP, $sumatoriaPRDivB, $sumatoriaCADiv2, $sumatoriaECDiv2, $sumatoriaEADiv2, $sumatoriaRODiv2)";

 VALUES (0, 0, $sumatoriaPRComC, $sumatoriaCACom3, $sumatoriaECCom3, $sumatoriaEACom3, $sumatoriaROCom3)";
 VALUES (0, 0, $sumatoriaPRAsimC, $sumatoriaCAAsim3, $sumatoriaECAsim3, $sumatoriaEAAsim3, $sumatoriaROAsim3)";
 VALUES (0, 0, $sumatoriaPRConvC, $sumatoriaCAConv3, $sumatoriaECConv3, $sumatoriaEAConv3, $sumatoriaROConv3)";
 VALUES (0, 0, $sumatoriaPRDivC, $sumatoriaCADiv3, $sumatoriaECDiv3, $sumatoriaEADiv3, $sumatoriaRODiv3)";


 VALUES (0, 0, $sumatoriaPRComD, $sumatoriaCACom4, $sumatoriaECCom4, $sumatoriaEACom4, $sumatoriaROCom4)";
 VALUES (0, 0, $sumatoriaPRAsimD, $sumatoriaCAAsim4, $sumatoriaECAsim4, $sumatoriaEAAsim4, $sumatoriaROAsim4)";
 VALUES (0, 0, $sumatoriaPRConvD, $sumatoriaCAConv4, $sumatoriaECConv4, $sumatoriaEAConv4, $sumatoriaROConv4)";
VALUES (0, 0, $sumatoriaPRDivD, $sumatoriaCADiv4, $sumatoriaECDiv4, $sumatoriaEADiv4, $sumatoriaRODiv4)";


*/

/*
$insertar ="INSERT INTO suma_si_estilo2 (Sexo, Recinto, Promedio, CA, EC, EA, RO) 
VALUES (0, 0, $sumatoriaPRDivD, $sumatoriaCADiv4, $sumatoriaECDiv4, $sumatoriaEADiv4, $sumatoriaRODiv4)";
$con->query($insertar);
*/

//crearemos la tabla estilo2_prob, 
/*
$creaTabla = "CREATE TABLE estilo2_prob(
    id int (11) AUTO_INCREMENT PRIMARY KEY,
     Sexo float (11),
     Recinto float (11),
     Promedio float (11),
     CA float (11),
     EC float (11),
     EA float (11),
     RO float (11)
    )";
if($con->query($creaTabla) === True)
    echo " crear la tabla";
else
    die( "tabla no creada".$con->error);

*/

/*
VALUES (($sumatoriaSEXComF+$m*(1/$calcPRec))/($freqAcom+$m), ($sumatoriaREComT+$m*(1/$calcPRec))/($freqAcom+$m), ($sumatoriaPRComA+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaCACom1+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaECCom1+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaEACom1+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaROCom1+$m*(1/$calcPCA))/($freqAcom+$m))";
VALUES (($sumatoriaSEXAsimF+$m*(1/$calcPRec))/($freqAsim+$m), ($sumatoriaREAsimT+$m*(1/$calcPRec))/($freqAsim+$m), ($sumatoriaPRAsimA+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaCAAsim1+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaECAsim1+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaEAAsim1+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaROAsim1+$m*(1/$calcPCA))/($freqAsim+$m))";
VALUES (($sumatoriaSEXConvF+$m*(1/$calcPRec))/($freqConv+$m), ($sumatoriaREConvT+$m*(1/$calcPRec))/($freqConv+$m), ($sumatoriaPRConvA+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaCAConv1+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaECConv1+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaEAConv1+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaROConv1+$m*(1/$calcPCA))/($freqConv+$m))";
VALUES (($sumatoriaSEXDivF+$m*(1/$calcPRec))/($freqDiv+$m), ($sumatoriaREDivT+$m*(1/$calcPRec))/($freqDiv+$m), ($sumatoriaPRDivA+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaCADiv1+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaECDiv1+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaEADiv1+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaRODiv1+$m*(1/$calcPCA))/($freqDiv+$m))";

VALUES (($sumatoriaSEXComM+$m*(1/$calcPRec))/($freqAcom+$m), ($sumatoriaREComP+$m*(1/$calcPRec))/($freqAcom+$m), ($sumatoriaPRComB+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaCACom2+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaECCom2+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaEACom2+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaROCom2+$m*(1/$calcPCA))/($freqAcom+$m))";
VALUES (($sumatoriaSEXAsimM+$m*(1/$calcPRec))/($freqAsim+$m), ($sumatoriaREAsimP+$m*(1/$calcPRec))/($freqAsim+$m), ($sumatoriaPRAsimB+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaCAAsim2+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaECAsim2+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaEAAsim2+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaROAsim2+$m*(1/$calcPCA))/($freqAsim+$m))";
VALUES (($sumatoriaSEXConvM+$m*(1/$calcPRec))/($freqConv+$m), ($sumatoriaREConvP+$m*(1/$calcPRec))/($freqConv+$m), ($sumatoriaPRConvB+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaCAConv2+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaECConv2+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaEAConv2+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaROConv2+$m*(1/$calcPCA))/($freqConv+$m))";
VALUES (($sumatoriaSEXDivM+$m*(1/$calcPRec))/($freqDiv+$m), ($sumatoriaREDivP+$m*(1/$calcPRec))/($freqDiv+$m), ($sumatoriaPRDivB+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaCADiv2+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaECDiv2+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaEADiv2+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaRODiv2+$m*(1/$calcPCA))/($freqDiv+$m))";

VALUES ((0+$m*(1/$calcPRec))/($freqAcom+$m), (0+$m*(1/$calcPRec))/($freqAcom+$m), ($sumatoriaPRComC+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaCACom3+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaECCom3+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaEACom3+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaROCom3+$m*(1/$calcPCA))/($freqAcom+$m))";
VALUES ((0+$m*(1/$calcPRec))/($freqAsim+$m), (0+$m*(1/$calcPRec))/($freqAsim+$m), ($sumatoriaPRAsimC+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaCAAsim3+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaECAsim3+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaEAAsim3+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaROAsim3+$m*(1/$calcPCA))/($freqAsim+$m))";
VALUES ((0+$m*(1/$calcPRec))/($freqConv+$m), (0+$m*(1/$calcPRec))/($freqConv+$m), ($sumatoriaPRConvC+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaCAConv3+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaECConv3+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaEAConv3+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaROConv3+$m*(1/$calcPCA))/($freqConv+$m))";
VALUES ((0+$m*(1/$calcPRec))/($freqDiv+$m), (0+$m*(1/$calcPRec))/($freqDiv+$m), ($sumatoriaPRDivC+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaCADiv3+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaECDiv3+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaEADiv3+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaRODiv3+$m*(1/$calcPCA))/($freqDiv+$m))";


 VALUES ((0+$m*(1/$calcPRec))/($freqAcom+$m), (0+$m*(1/$calcPRec))/($freqAcom+$m), ($sumatoriaPRComD+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaCACom4+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaECCom4+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaEACom4+$m*(1/$calcPCA))/($freqAcom+$m), ($sumatoriaROCom4+$m*(1/$calcPCA))/($freqAcom+$m))";
 VALUES ((0+$m*(1/$calcPRec))/($freqAsim+$m), (0+$m*(1/$calcPRec))/($freqAsim+$m), ($sumatoriaPRAsimD+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaCAAsim4+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaECAsim4+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaEAAsim4+$m*(1/$calcPCA))/($freqAsim+$m), ($sumatoriaROAsim4+$m*(1/$calcPCA))/($freqAsim+$m))";
 VALUES ((0+$m*(1/$calcPRec))/($freqConv+$m), (0+$m*(1/$calcPRec))/($freqConv+$m), ($sumatoriaPRConvD+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaCAConv4+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaECConv4+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaEAConv4+$m*(1/$calcPCA))/($freqConv+$m), ($sumatoriaROConv4+$m*(1/$calcPCA))/($freqConv+$m))";
VALUES ((0+$m*(1/$calcPRec))/($freqDiv+$m), (0+$m*(1/$calcPRec))/($freqDiv+$m), ($sumatoriaPRDivD+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaCADiv4+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaECDiv4+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaEADiv4+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaRODiv4+$m*(1/$calcPCA))/($freqDiv+$m))";


*/


/*
$insertar ="INSERT INTO estilo2_prob (Sexo, Recinto, Promedio, CA, EC, EA, RO) 
VALUES ((0+$m*(1/$calcPRec))/($freqDiv+$m), (0+$m*(1/$calcPRec))/($freqDiv+$m), ($sumatoriaPRDivD+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaCADiv4+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaECDiv4+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaEADiv4+$m*(1/$calcPCA))/($freqDiv+$m), ($sumatoriaRODiv4+$m*(1/$calcPCA))/($freqDiv+$m))";
if($con->query($insertar) === True)
    echo " inserta fila";
else
    die( "fila no creada".$con->error);
*/

?>