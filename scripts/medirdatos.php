<?php
include "conectar.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$disp = $_GET["disponible"]; // el dato que se recibe aquí con GET denominado disponible, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada


$mysqli = new mysqli("localhost","root","","parqueo"); // Aquí se hace la conexión a la base de datos.

date_default_timezone_set('America/Bogota'); // esta línea es importante cuando el servidor es REMOTO y está ubicado en otros países como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.

$sql2="SELECT ID_HAB FROM ESTADOPUESTO WHERE ID_PUESTO=1";
$resultado1= $conectar ->query($sql2);
$row1 = $resultado1->fetch_array(MYSQLI_NUM);
$estado=$row1[0];
if($estado==1){
$sql1 = "UPDATE EstadoPuesto SET id_Dispo='$disp' WHERE ID_PUESTO=1"; // Aquí se ingresa el valor recibido a la base de datos.
echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
$result1 = $mysqli->query($sql1);
echo "result es...".$result1; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
} else{
$sql1 = "UPDATE EstadoPuesto SET id_Dispo='2' WHERE ID_PUESTO=1"; // Aquí se ingresa el valor recibido a la base de datos.
echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
$result1 = $mysqli->query($sql1);
echo "result es...".$result1; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
}


?>
