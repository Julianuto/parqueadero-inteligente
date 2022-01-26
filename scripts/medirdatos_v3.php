<?php
include "conectar.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli("localhost","root","","parqueo"); // Aquí se hace la conexión a la base de datos.


$disp = $_GET["disponible"]; // el dato que se recibe aquí con GET denominado disponible, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada
$disp1 = substr($disp,0, 1);
$disp2 = substr($disp,4, 4);
$ID_PARK = $_GET["ID_TARJ"];

date_default_timezone_set('America/Bogota'); // esta línea es importante cuando el servidor es REMOTO y está ubicado en otros países como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.

$sql5="SELECT ID_PUESTO FROM PUESTOPARQUEO WHERE ID_PARK='$ID_PARK'";     //ID_TARJ
//$sql5="SELECT ID_PUESTO,ID_PARK='$ID_PARK' FROM PUESTOPARQUEO";
$resultado5= $conectar ->query($sql5);
$row_cnt=mysqli_num_rows($resultado5);
echo $row_cnt;
$row5=array();
$index=0;
   while($row=mysqli_fetch_assoc($resultado5)){
   $row5[$index]=$row;
   $index++;
   }
$id_puesto1=$row5[0]['ID_PUESTO'];
$id_puesto2=$row5[1]['ID_PUESTO'];


$sql7="SELECT ID_HAB FROM ESTADOPUESTO WHERE ID_PUESTO='$id_puesto1'";
$resultado7= $conectar ->query($sql7);
$row7 = $resultado7->fetch_array(MYSQLI_NUM);
$estadohab1=$row7[0];

$sql8="SELECT ID_HAB FROM ESTADOPUESTO WHERE ID_PUESTO='$id_puesto2'";
$resultado8= $conectar ->query($sql8);
$row8 = $resultado8->fetch_array(MYSQLI_NUM);
$estadohab2=$row8[0];

if($estadohab1==1){
    $sql1 = "UPDATE EstadoPuesto SET id_Dispo='$disp1' WHERE ID_PUESTO='$id_puesto1'"; // Aquí se ingresa el valor recibido a la base de datos.
    echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
    $result1 = $mysqli->query($sql1);
    echo "Ingreso exitosos a la base, result..".$result1; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
} else{
    $sql1 = "UPDATE EstadoPuesto SET id_Dispo='2' WHERE ID_PUESTO='$id_puesto1'"; // Aquí se ingresa el valor recibido a la base de datos.
    echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
    $result1 = $mysqli->query($sql1);
    echo "Ingreso exitosos a la base, result..".$result1; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
    }

if($estadohab2==1){
    $sql3 = "UPDATE EstadoPuesto SET id_Dispo='$disp2' WHERE ID_PUESTO='$id_puesto2'"; // Aquí se ingresa el valor recibido a la base de datos.
    echo "sql3...".$sql3; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
    $result2 = $mysqli->query($sql3);
    echo "Ingreso exitosos a la base, result..".$result2; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
} else{
    $sql3 = "UPDATE EstadoPuesto SET id_Dispo='2' WHERE ID_PUESTO='$id_puesto2'"; // Aquí se ingresa el valor recibido a la base de datos.
    echo "sql3...".$sql3; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
    $result2 = $mysqli->query($sql3);
    echo "Ingreso exitosos a la base, result..".$result2; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
    }

?>
