
<?php
include("conectar.php");

$codigo= $_POST['codigo'];
$descripcion= $_POST['descripcion'];

$query="INSERT INTO Habilitacion(codigo,descripcion) VALUES ('$codigo','$descripcion')";
$resultado= $conectar ->query($query);

if($resultado){
  echo"Inserci�n exitosa";
  }
  else " Inserci�n no exitosa";
?>
