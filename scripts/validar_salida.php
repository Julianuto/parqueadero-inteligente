
<?php

// PROGRAMA DE VALIDACION DE USUARIOS

$login = $_POST["login1"];
$passwd = $_POST["passwd1"];

session_start();

//echo "login es...".$login;
//echo "password es...".$passwd;

include ("conectar.php");

$mysqli = new mysqli("localhost","root","","parqueo");

                $sql110="SELECT hora_out FROM reserva where clave='$passwd'";
                $resultado110= $conectar ->query($sql110);
                $row110=$resultado110->fetch_array(MYSQLI_NUM);
                $fecha=$row110[0];
                $hola= date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($fecha)));

$sql111="UPDATE reserva set hora_out= CURRENT_TIMESTAMP where clave='$passwd'";
$result111 = $mysqli->query($sql111);

$sql = "SELECT * from reserva where clave='$passwd'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);

$hora_out=$row1[5];

 if($hora_out>$hola){
     $sql112="UPDATE reserva set id_estado='2' where clave='$passwd'";
     $result112 = $mysqli->query($sql112);
 }
$sql = "SELECT * from reserva where clave='$passwd'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$numero_filas = $result1->num_rows;

if ($numero_filas > 0)
  {
    $id_estado=$row1[8];
    if($id_estado==1){
     $sql112="UPDATE reserva set id_estado='2' where clave='$passwd'";
     $result112 = $mysqli->query($sql112);
     
     $sql998="SELECT id_puesto FROM reserva where clave='$passwd'";
     $resultado998= $conectar ->query($sql998);
     $row998=$resultado998->fetch_array(MYSQLI_NUM);
     $puesto=$row998[0];
     
     $sql999="UPDATE estadopuesto set id_hab='1' where id_puesto='$puesto'";
     $result999 = $mysqli->query($sql999);
          header('Location: salida.php?mensaje=2');
    }
    else{
          header('Location: salida.php?mensaje=3');
    }
  }
else
  {
    header('Location: salida.php?mensaje=1');
 }
?>
