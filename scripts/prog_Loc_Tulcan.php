<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli("localhost","root","","parqueo"); // Aquí se hace la conexión a la base de datos.

$coordena = $_POST["coordena"]; // toma los valores de coordenada
// que trae la latitud y longitud en la misma variable

// Y se separan en dos variables, Latitud y longitud, para poder ingresarlas a la tabla ubicaciones de la base de datos.
  $id_park_enc= $_GET["id_park"];
$ubicacion_coma= strpos($coordena,","); // Ubica la posición del caracter coma en la variable.
$ubicacion_coma2 = $ubicacion_coma +1;
$largo_cad = strlen($coordena); // determina el largo de toda la cadena.
$largo_lat = $largo_cad - $ubicacion_coma; 
$latitud = substr($coordena,0,$ubicacion_coma); // asigna la subcadena de coordenada que le corresponde a la latitud.
$longitud = substr($coordena,$ubicacion_coma2,$largo_lat); // asigna la subcadena de coordenada que le corresponde a la longitud.

echo "lat...".$latitud;
echo "long...".$longitud;

$sql1 = "UPDATE parqueadero SET latitud = '$latitud', longitud = '$longitud' WHERE ID_PARK = '$id_park_enc'"; //

$result1 = $mysqli->query($sql1);
if ($id_park_enc=1){

if ($result1 == 1)
  {
             header('Location:tabla_parq_mod.php?mensaje=1&id_park=1');
             
  }
else
  {
             header('tabla_parq_mod.php?mensaje=2&id_park=1');
  }
  }
  if ($id_park_enc=2){
if ($result1 == 1)
  {
             header('Location:tabla_parq_mod.php?mensaje=1&id_park=2');

  }
else
  {
             header('tabla_parq_mod.php?mensaje=2&id_park=2');
  }
  }
?>
