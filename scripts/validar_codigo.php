
<?php

// PROGRAMA DE VALIDACION DE USUARIOS

$login = $_POST["login1"];
$passwd = $_POST["passwd1"];

session_start();

//echo "login es...".$login;
//echo "password es...".$passwd;

include ("conectar.php");

$mysqli = new mysqli("localhost","root","","parqueo");

                $sql110="SELECT fecha FROM reserva where clave='$passwd'";
                $resultado110= $conectar ->query($sql110);
                $row110=$resultado110->fetch_array(MYSQLI_NUM);
                $fecha=$row110[0];
                $hola= date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($fecha)));

$sql111="UPDATE reserva set hora_in= CURRENT_TIMESTAMP where clave='$passwd'";
$result111 = $mysqli->query($sql111);

$sql = "SELECT * from reserva where clave='$passwd'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);

$hora_in=$row1[4];

 if($hora_in>$hola){
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
          header('Location: ingreso.php?mensaje=2');
    }
    else{
          header('Location: ingreso.php?mensaje=3');
    }
  }
else
  {
    header('Location: ingreso.php?mensaje=1');
 }
?>
