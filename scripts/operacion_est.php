
<?php
include("conectar.php");

$id_Hab= $_POST['id_Hab'];
$id_Dispo= $_POST['id_Dispo'];
$id_PUESTO= $_POST['id_PUESTO'];
$query="INSERT INTO estadopuesto(id_Hab,id_Dispo,id_PUESTO) VALUES ('$id_Hab','$id_Dispo','$id_PUESTO')";
$resultado= $conectar ->query($query);

if($resultado){
  echo"Inserción exitosa";
  }
  else " Inserción no exitosa";
?>
