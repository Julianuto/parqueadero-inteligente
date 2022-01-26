<?php

// PROGRAMA DE MENU ADMINISTRADORES
include "conectar.php";


session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {
        $mysqli = new mysqli("localhost","root","","parqueo");
  	    $sqlusu = "SELECT * from tipousuario where idtipousuario='1'"; //CONSULTA EL TIPO DE USUARIO CON ID=1, ADMINISTRADOR
        $resultusu = $mysqli->query($sqlusu);
        $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
  	    $desc_tipo_usuario = $rowusu[2];
        if ($_SESSION["tipousuario"] != $desc_tipo_usuario)
          header('Location: index.php?mensaje=4');
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
          <link rel="stylesheet" href="css/estilos_virtual.css" 			type="text/css">
           <title> Gestion parqueaderos</title>
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
include "menu_admin.php";

if ((isset($_POST["enviado"])))
  {
   //echo "grabar cambios modificación";
   $id_park_enc = $_POST["id_park"];
   $nombre= $_POST["nombre"];
   $nombre = str_replace("ñ","n",$nombre);
   $nombre = str_replace("Ñ","N",$nombre);
   $cobro = $_POST["cobro"];
   $ubicacion = $_POST["direccion"];


   $mysqli = new mysqli("localhost","root","","parqueo");
	 $sqlu1 = "UPDATE parqueadero set nombre='$nombre' where id_park='$id_park_enc'";
   $resultsqlu1 = $mysqli->query($sqlu1);

	 $sqlu5 = "UPDATE parqueadero set cobro='$cobro' where id_park='$id_park_enc'";
   $resultsqlu5 = $mysqli->query($sqlu5);

	 $sqlu2 = "UPDATE parqueadero set direccion='$ubicacion' where id_park='$id_park_enc'";
   $resultsqlu2 = $mysqli->query($sqlu2);



   if (($resultsqlu1 == 1) && ($resultsqlu2 == 1) &&
       ($resultsqlu5 == 1))
         header('Location: tabla_parq.php?mensaje=1');
   else
         header('Location: tabla_parq.php?mensaje=2');

}

else

{

// Consulta el nombre y demás datos del usuario a modificar
   $id_park_enc = $_GET["id_park"];
   $mysqli = new mysqli("localhost","root","","parqueo");
   $sqlenc = "SELECT * from parqueadero";
   $resultenc = $mysqli->query($sqlenc);
   while($rowenc = $resultenc->fetch_array(MYSQLI_NUM))
    {
      $id_park  = $rowenc[0];
      if (md5($id_park) == $id_park_enc)
        $id_park_enc = $id_park;
    }
   $sql1 = "SELECT * from parqueadero where id_park='$id_park_enc'";
   $result1 = $mysqli->query($sql1);
   $row1 = $result1->fetch_array(MYSQLI_NUM);
   $nombre  = $row1[2];
   $cobro = $row1[3];
   $ubicacion  = $row1[4];




   ?>

     <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Modificacion parqueadero</h1></b></font>


		       </td>

       </tr>
   	     <tr>
                  <td colspan=2 width="25%" height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">

                   <form method=POST action="tabla_parq_mod.php">
                   <table width=50% border=0 align=center>
			    <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Nombre</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=nombre value="<?php echo $nombre; ?>" required>
				</td>
	     </tr>
          <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Ubicacion</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=direccion value="<?php echo $ubicacion; ?>" required>
				</td>
	     </tr>

	     <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000044"> <b>Cobro</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=cobro value="<?php echo $cobro; ?>" required>
				</td>
	     </tr>
	     <tr>
				<td bgcolor="#D1E8FF" align=center>
				  <font FACE="arial" SIZE=2 color="#000044"> <b>Latitud y longitud</b></font>
				</td>
            	<td bgcolor="#EEEEEE" align=center>
            	  <font FACE="Century Gothic" SIZE=2 color="#000000"> <a href="prog_Tulcan.php?id_park=<?php echo $id_park_enc; ?>"> <img src="../img/ayuda.png" border=0 width=20 height=20></a></font>

                  <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>
		     <table>
  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=1>
                   <tr>
                    <?php
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Ubicacion creada correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Inconveniente al crear la ubicacion.";

             echo "</td></tr>
                  </table>
              </td>
    		     </tr>
          <table>";
            }
         }
      ?>
				</td>
			     </tr>



      </table>

         <input type="hidden" value="S" name="enviado">
         <input type="hidden" value="<?php echo $id_park_enc; ?>" name="id_park">
         <table width=50% align=center border=0>
           <tr>
             <td width=50%></td>
             <td align=center><input style="background-color: #DBA926" type=submit color= blue value="Modificar" name="Modificar">
                  </form>
             </td>
             <td align=left>
                  <form method=POST action="tabla_parq.php">
                  <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">
                  </form>
             </td>
           </tr>
                   </table>
                  </form>
<br><br><hr>
                  </td>
                </tr>

<?php
 }
?>

        </table>

       </body>
      </html>
