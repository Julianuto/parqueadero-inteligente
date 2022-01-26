<?php

// PROGRAMA DE MENU USUARIO
include "conectar.php";

session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {
        $mysqli = new mysqli("localhost","root","","parqueo");
  	    $sqlusu = "SELECT * from tipousuario where idtipousuario='2'"; //CONSULTA EL TIPO DE USUARIO CON ID=2, USUARIO
        $resultusu = $mysqli->query($sqlusu);
        $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
  	    $desc_tipo_usuario = $rowusu[2];
        if ($_SESSION["tipousuario"] != $desc_tipo_usuario)
          header('Location: index.php?mensaje=4');
    }
?>


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
     <?php $id_park=$_GET['id_park'];
     $sql100="SELECT * FROM parqueadero where id_park='$id_park'";
     $resultado100= $conectar ->query($sql100);
     $row100=$resultado100->fetch_array(MYSQLI_NUM);
     $nombrepark=$row100[2];
     $cobropark=$row100[3];
     $direccionpark=$row100[4];

     $sql101="SELECT * FROM puestoparqueo where id_park='$id_park' ORDER BY id_puesto DESC";
     $resultado101= $conectar ->query($sql101);
     while($row101=$resultado101->fetch_array(MYSQLI_NUM))
         {
     $id_puesto=$row101[0];
     $codigo_puesto=$row101[2];

     $sql102="SELECT * FROM estadopuesto where id_puesto='$id_puesto'";
     $resultado102= $conectar ->query($sql102);
     $row102=$resultado102->fetch_array(MYSQLI_NUM);
     $hab=$row102[1];
     $dispo=$row102[2];

     if(($hab == 1) and ($dispo == 1)){
     $puesto=$codigo_puesto;
     $idepuesto=$id_puesto;
     }

     }

     ?>

       <head>
          <link rel="stylesheet" href="css/estilos_virtual.css" 			type="text/css">
           <title>Reserva</title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#2E4053">
         <tr>
           <td valign="top" align=left width=70% >
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30% >
                     <img src="../img/sip.png" border=0 width=90 height=90>

             	    </td>
                  <td valign="bottom" align=center width=60%>
                     <h1><font color=#FFFFFF face="Century Gothic">SISTEMA INTELIGENTE DE PARQUEO</font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>
           <td valign="top" align=right >
              <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre"];?> </b></font><br>
              <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>
              <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b><a href="cerrar_sesion.php"> Cerrar Sesion </a></b></font>

           </td>
	     </tr>



</body>
</html>




