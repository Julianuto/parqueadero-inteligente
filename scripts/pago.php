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



     <?php $id_reserva=$_GET['id_reserva'];
     $sql110="UPDATE reserva set id_estado='1'  where  id_reserva='$id_reserva'";
     $result110=$mysqli->query($sql110);
     $sql111="UPDATE reserva set hora_out= CURRENT_TIMESTAMP where id_reserva='$id_reserva'";

     $result111=$mysqli->query($sql111);
     $sql100="SELECT * FROM reserva where id_reserva='$id_reserva'";
     $resultado100= $conectar ->query($sql100);
     $row100=$resultado100->fetch_array(MYSQLI_NUM);
     $id_puesto=$row100[1];
     $date2=new DateTime($row100[5]);
      $date1=new DateTime($row100[4]);
      $sql102="SELECT * FROM puestoparqueo where id_puesto='$id_puesto'";
     $resultado102= $conectar ->query($sql102);
     $row102=$resultado102->fetch_array(MYSQLI_NUM);
     $id_park=$row102[1];
     $sql103="SELECT * FROM parqueadero where id_park='$id_park'";
     $resultado103= $conectar ->query($sql103);
     $row103=$resultado103->fetch_array(MYSQLI_NUM);
     $nombrepark=$row103[2];
     $cobro= $row103[3];
          $direccion_park=$row103[4];

$diff = $date1->diff($date2);
// 38 minutes to go [number is variable]
$dift = ( ($diff->days * 24 ) * 60 ) + ( $diff->i )*$cobro;

$cobro_park = $dift;
$sql114="UPDATE reserva set precio='$cobro_park' where id_reserva='$id_reserva'";
     $result114=$mysqli->query($sql114);

// passed means if its negative and to go means if its positive



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
           <title>Pago</title>
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
   ?>

   </u></h2></b></font>
               <td height="20%" align="center" bgcolor="#FFFFFF" class="_espacio_celdas" style="color: #FFFFFF; font-weight: bold">
               <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Pagos</h1></b></font>

               </td>



                <br>


                <table width=50% border=0 align=center>
			     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Hora de entrada</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=direccion value="<?php echo $fecha;?>" disabled>
				</td>
			     </tr>
                <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Hora de salida</b></font>
				</td>
                </tr>
                </table>

                <br>
                <table width=50% border=0 align=center>
			     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF">Recuerde que tiene un maximo de 10 mins para salir del sitio de parqueo. De lo contrario, su reserva sera descartada.</font>
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

}

else

{

   ?>

    <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Pago en <?php echo $nombrepark ?> </h1></b></font>


		       </td>

       </tr>

            <tr>
                  <td colspan=2 width="25%" height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">

                   <form method=POST action="resumen_pago.php?id_reserva=<?php echo $id_reserva?>">
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
				  <input type="text" name=direccion value="<?php echo $direccion_park ?>" disabled>
				</td>
			     </tr>
                <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Valor a pagar</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=cobro value="<?php echo $cobro_park ?>" disabled>
				</td>
                </tr>
                <tr>

                </tr>

              <table width=50% align=center border=0>
              <tr>
              <td width=50%></td>
              <td align=center><input style="background-color: #FFFFFF" type=submit color= blue value="Pagar" name="pagar">
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




