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
<body onkeydown="return (event.keyCode != 116)">



     <?php $id_park=$_GET['id_park'];
     $sql100="SELECT * FROM parqueadero where id_park='$id_park'";
     $resultado100= $conectar ->query($sql100);
     $row100=$resultado100->fetch_array(MYSQLI_NUM);
     $nombrepark=$row100[2];
     $cobropark=$row100[3];
     $direccionpark=$row100[4];

     $nombreusu= $_SESSION["nombre"];
     $sql99="SELECT id_usuario FROM usuario where nombre='$nombreusu'";
     $resultado99= $conectar ->query($sql99);
     $row99=$resultado99->fetch_array(MYSQLI_NUM);
     $id_usu=$row99[0];

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
<table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_usuario.php";


if ((isset($_POST["enviado"])))
  {
   //echo "grabar cambios modificación";
   $mysqli = new mysqli("localhost","root","","parqueo");
   $sqlcon = "SELECT * from estadopuesto where id_puesto='1'";
   $resultcon = $mysqli->query($sqlcon);
   $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
   $numero_filas = $resultcon->num_rows;
   
   $codigoingreso =rand(100, 999);
   
      $sql = "INSERT INTO reserva(id_puesto, id_usuario, clave, id_estado, precio)
      VALUES ($idepuesto,$id_usu,$codigoingreso,1,0)";
      //echo "sql es...".$sql;
      $result1 = $mysqli->query($sql);

?>
               <td height="20%" align="center" bgcolor="#FFFFFF" class="_espacio_celdas" style="color: #FFFFFF; font-weight: bold">
               <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Resumen de reserva</h1></b></font>
               <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h2>Su codigo para el ingreso es: <u><?php echo $codigoingreso ?></u></h2></b></font>
               </td>
               
               <table width=50% border=0 align=center>

				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Usuario</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=usuario value="<?php  echo "".$_SESSION["nombre"];?>" disabled>
				</td>
                </tr>
                <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Parqueadero</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=parqueadero value="<?php echo $nombrepark ?>" disabled>
				</td>
			     </tr>
			     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Direccion</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=direccion value="<?php echo $direccionpark ?>" disabled>
				</td>
			     </tr>
                <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Cobro ($/min)</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=cobro value="<?php echo $cobropark ?>" disabled>
				</td>
                </tr>
                <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Puesto</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=cobro value="<?php echo $puesto ?>" disabled>
				</td>
                </tr>
                </table>
                
                <br>
                
                <?php
                $sql110="SELECT fecha FROM reserva where clave='$codigoingreso'";
                $resultado110= $conectar ->query($sql110);
                $row110=$resultado110->fetch_array(MYSQLI_NUM);
                $fecha=$row110[0];
                
                $start = '2014-06-01 14:00:00';
                $hola= date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($fecha)));
                ?>
                
                <table width=50% border=0 align=center>
			     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=3 color="#FFFFFF">Recuerde que tiene un maximo de 30 mins para llegar al sitio de parqueo. De lo contrario, su reserva sera descartada.</font>
				</td>
			     </tr>
                </table>
                
                <table width=50% border=0 align=center>
			     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Hora de reserva</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=direccion value="<?php echo $fecha;?>" disabled>
				</td>
			     </tr>
                <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Hora maxima para llegada</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=cobro value="<?php echo $hola;?>" disabled>
				</td>
                </tr>
                </table>
                
                
               <table align=center border=0>
               <td align=center>
               <br><img src="../img/chulito.png" border=0 width=50 height=50><br><br>
               <form method=POST action="tabla_parq_usuario.php">
               <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">
               </form>
               </td>
               </table>
<?php

                $sql111="UPDATE estadopuesto SET id_hab = '2' where id_puesto='$idepuesto'";
                $resultado111= $conectar ->query($sql111);

}

else

{

   ?>

    <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Reserva en <?php echo $nombrepark ?> </h1></b></font>


		       </td>

       </tr>

            <tr>
                  <td colspan=2 width="25%" height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">

                   <form method=POST action="reserva.php?id_park=<?php echo $id_park?>">
                   <table width=50% border=0 align=center>

				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Usuario</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=usuario value="<?php  echo "".$_SESSION["nombre"];?>" disabled>
				</td>
       </tr>
         <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Parqueadero</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=parqueadero value="<?php echo $nombrepark ?>" disabled>
				</td>
			     </tr>
			     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Direccion</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=direccion value="<?php echo $direccionpark ?>" disabled>
				</td>
			     </tr>
                <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Cobro ($/min)</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=cobro value="<?php echo $cobropark ?>" disabled>
				</td>
                </tr>
                <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Puesto</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=cobro value="<?php echo $puesto ?>" disabled>
				</td>
                </tr>

	          <input type="hidden" value="S" name="enviado">
              <table width=50% align=center border=0>
              <tr>
              <td width=50%></td>
              <td align=center><input style="background-color: #FFFFFF" type=submit color= blue value="Reservar" name="Modificar">
              </form>
              </td>
              <td align=left>
              <form method=POST action="tabla_parq_usuario.php">
              <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">
              </form>
              </td>
              </tr>
              </table>

<?php
 } ?>

</body>
</body>
</html>




