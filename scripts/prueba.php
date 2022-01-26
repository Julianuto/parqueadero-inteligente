<!DOCTYPE html>

<HTML>
<HEAD>
 <TITLE>Tabla</TITLE>
</HEAD>
<BODY>
<?php
include "conectar.php";  // Conexión tiene la información sobre la conexión de la base de datos.

$mysqli = new mysqli("localhost","root","","parqueo"); // Aquí se hace la conexión a la base de datos.

date_default_timezone_set('America/Bogota'); // esta línea es importante cuando el servidor es REMOTO y está ubicado en otros países como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.

$sql2="SELECT ID_HAB FROM ESTADOPUESTO WHERE ID_PUESTO=1 AND ID_ESTADO=(SELECT MAX(ID_ESTADO) FROM estadopuesto)";
$resultado1= $mysqli ->query($sql2);
$row1 = $resultado1->fetch_array(MYSQLI_NUM);
$estado=$row1[0];

echo $estado;

?>
</BODY>
</HTML>
