<?php
include "conectar.php";

$sql1= "SELECT ID_HAB FROM ESTADOPUESTO WHERE ID_PUESTO=1";
$resultado = $conectar->query($sql1);
$row1 = $resultado->fetch_array(MYSQLI_NUM);
$estado=$row1[0];

echo $estado;
?>
