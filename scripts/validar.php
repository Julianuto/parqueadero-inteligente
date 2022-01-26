                                                       
<?php

// PROGRAMA DE VALIDACION DE USUARIOS
                   
                                                       
$login = $_POST["login1"];
$passwd = $_POST["passwd1"];

$passwd_comp = md5($passwd);
session_start();

//echo "login es...".$login;
//echo "password es...".$passwd;

include ("conectar.php");

$mysqli = new mysqli("localhost","root","","parqueo");
       
$sql = "SELECT * from usuario where NOM_USUARIO = '$login' and activo='1'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$numero_filas = $result1->num_rows;
if ($numero_filas > 0)
  {
    $passwdc = $row1[6];

    if ($passwdc == $passwd_comp)
      {
        $_SESSION["autenticado"]= "SIx3";
        $tipo_usuario = $row1[1];
        $nombre_usuario = $row1[2];
        $sql2 = "SELECT * from tipousuario where idtipousuario='$tipo_usuario'";
        echo $sql2;
        $result2 = $mysqli->query($sql2);
        $row2 = $result2->fetch_array(MYSQLI_NUM);
        $desc_tipo_usu = $row2[2];
        $_SESSION["tipousuario"]= $desc_tipo_usu;
        $_SESSION["nombre"]= $nombre_usuario;
        $_SESSION["id_usuario"]= $row1[0];;  
        
        if ($tipo_usuario == 1)
            header("Location: gestion_usuarios.php");
         else
            header("Location: tabla_parq_usuario.php");
      }
    else 
     {
      header('Location: index.php?mensaje=1');
     }
  }
else
  {
    header('Location: index.php?mensaje=2');
 }  
?>
