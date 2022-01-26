
<?php
$coordena = $_POST["coordena"];
$ubicacion_coma= strpos($coordena,","); // Ubica la posición del caracter coma en la variable.
$ubicacion_coma2 = $ubicacion_coma +1;
$largo_cad = strlen($coordena); // determina el largo de toda la cadena.
$largo_lat = $largo_cad - $ubicacion_coma;
$latitudus = substr($coordena,0,$ubicacion_coma); // asigna la subcadena de coordenada que le corresponde a la latitud.
$longitudus = substr($coordena,$ubicacion_coma2,$largo_lat); // asigna la subcadena de coordenada que le corresponde a la longitud.
include "conectar.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli("localhost","root","","parqueo"); // Aquí se hace la conexión a la base de datos.
$sqlubi = "SELECT * from parqueadero where ID_PARK=1"; //CONSULTA LA ULTIMA UBICACION AGREGADA A LA TABLA UBICACIONES
$resultubi = $mysqli->query($sqlubi);
$rowubi = $resultubi->fetch_array(MYSQLI_NUM);
$latitud = $rowubi[5];
$longitud = $rowubi[6];
// lat y long fiet
$mysqli1 = new mysqli("localhost","root","","parqueo");
$sqlubi1 = "SELECT * from parqueadero where ID_PARK=2";
$resultubi1 = $mysqli1->query($sqlubi1);
$rowubi1 = $resultubi1->fetch_array(MYSQLI_NUM);
$latitud1 = $rowubi1[5];
$longitud1 = $rowubi1[6];
function Distance($lat1, $lon1, $lat2, $lon2) {
  $radius = 6378.137; // earth mean radius defined by WGS84
  $dlon = $lon1 - $lon2;
  $distance = acos( sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($dlon))) * $radius;
 return ($distance);
}
 $distanciaT = Distance ($latitudus,$longitudus,$latitud,$longitud);
$distanciaF = Distance ($latitudus,$longitudus,$latitud1,$longitud1);
if ($distanciaT < $distanciaF)
  {
             header('Location: ubicacion_actual1.php?mensaje=1');
  }
else
  {
             header('Location: ubicacion_actual1.php?mensaje=2');
  }
?>

