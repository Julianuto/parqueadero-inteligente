<?php

// PROGRAMA DE MENU ADMINISTRADOR
include "conectar.php";

session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {
        $mysqli = new mysqli("localhost","root","","parqueo");
       $sqlusu = "SELECT * from tipousuario where idtipousuario='2'"; //CONSULTA EL TIPO DE USUARIO CON ID=1, ADMINISTRADOR
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
           <title>  Parqueaderos </title>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	       <script src="https://code.highcharts.com/highcharts.js"></script>
        </head>
       <body>
        <table width="100%"  align=center cellpadding=5 border=0 bgcolor="#2E4053">
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
     </table>

    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_usuario.php";
?>
         <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Tabla de parqueaderos</h1></b></font>
	       </td>

	    </tr>
	  </table>
	  
    <table width="100%" align=center cellpadding=0 border=0 bgcolor="#FFFFFF">
      <tr>
       <td align=left width=50%>
        <form action="gestion_usuarios.php" method="POST">

      </tr>
     <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>

  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=1>
                   <tr>
                    <?php
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Parqueadero actualizado correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Parqueadero no fue actualizado correctamente.";
                       if ($mensaje == 3)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Parqueadero creado correctamente.";
                       if ($mensaje == 4)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Parqueadero no fue creado. Se presentó un inconveniente";
                       if ($mensaje == 5)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Parqueadero no fue creado. Ya existe parqueadero con la misma id.";

             echo "</td></tr>
                  </table>
              </td>
    		     </tr>";

            }
           }
            ?>

         <tr>
                  <td colspan=2 height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">

                    <table width=80% border=0 align=center>
			 <tr>

				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Nombre</b></font>
				</td>


				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Costo ($/min)</b></font>
				</td>
				<td bgcolor="#F4B120" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>Ubicacion</b></font>
				</td>
				  <td bgcolor="#F4B120         " align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				 Localizar</b></font>
				</td>
				 <td bgcolor="#F4B120         " align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  </b></font>
				</td>
   	<td bgcolor="#F4B120         " align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
				  </b></font>
				</td>


			</tr>

<?php
         $mysqli = new mysqli("localhost","root","","parqueo");
		     if ((isset($_POST["enviado"])))
         {
           $id_con = $_POST["id_con"];
           $nombre_con = $_POST["nombre_con"];
           $estado = $_POST["estado"];
           $sql1 = "SELECT * from parqueadero order by nombre";
           if (($id_con == "") and ($nombre_con == ""))
             {
              if ($estado != "2")
                $sql1 = "SELECT * from parqueadero where activo='$estado' order by nombre";
             }
           if (($id_con != "") and ($nombre_con == ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from parqueadero where numero_id='$id_con'";
              else
                $sql1 = "SELECT * from parqueadero where numero_id='$id_con' and activo='$estado'";
             }
           if (($id_con == "") and ($nombre_con != ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from parqueadero where nombre LIKE '%$nombre_con%' order by nombre";
              else
                $sql1 = "SELECT * from parqueadero where nombre LIKE '%$nombre_con%' and activo='$estado' order by nombre";
              }
           if (($id_con != "") and ($nombre_con != ""))
             {
              if ($estado == "2")
                 $sql1 = "SELECT * from parquedaero where nombre LIKE '%$nombre_con%' and numero_id='$id_con'";
              else
                $sql1 = "SELECT * from parqueadero where nombre LIKE '%$nombre_con%' and numero_id='$id_con' and activo='$estado'";
             }
          }
         else
             $sql1 = "SELECT * from parqueadero order by nombre";

         //echo "sql1 es...".$sql1;

         $result1 = $mysqli->query($sql1);
         while($row1 = $result1->fetch_array(MYSQLI_NUM))
         {
			    $id_park  = $row1[0];
			    $id_park_enc = md5($id_park);
			    $nombre  = $row1[2];
                $cobro  = $row1[3];
	     	    $ubicacion = $row1[4];
     	        $latitud  = $row1[5];
	     	    $longitud = $row1[6];

     	    $sql3 = "SELECT * from tipousuario";
            $result3 = $mysqli->query($sql3);
            $row3 = $result3->fetch_array(MYSQLI_NUM);
            $desc_tipo_usuario = $row3[2];

            $disponibilidad=0;
            
            $sql4 = "SELECT ID_PUESTO from puestoparqueo where ID_PARK='$id_park'";
            $result4 = $mysqli->query($sql4);
            while($row4 = $result4->fetch_array(MYSQLI_NUM))     {
            $id_puesto = $row4[0];
            
            $sql5 = "SELECT * from estadopuesto where ID_PUESTO='$id_puesto'";
            $result5 = $mysqli->query($sql5);
            $row5 = $result5->fetch_array(MYSQLI_NUM);
            $id_hab = $row5[1];
            $id_dispo = $row5[2];

            if ($id_hab == "1"){
                if ($id_dispo == "1"){

                $disponibilidad +=1;
                }
                else{

                }
            }
            else{

            }

            }

?>

		        <tr>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b> <?php echo $nombre; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $cobro; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $ubicacion; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
                <font FACE="Century Gothic" SIZE=2 color="#000000"> <a href="prog_Tulcanusuario.php?id_park=<?php echo $id_park; ?>"> <img src="../img/ver.png" border=0 width=20 height=20></a></font>
                     	</td>
                <td bgcolor="#EEEEEE" align=center>
                <font FACE="Century Gothic" SIZE=2 color="#000000"><b><?php echo $disponibilidad; ?> puesto(s) disponible(s)</b>  </font>
                     	</td>
                <td bgcolor="#EEEEEE" align=center>
                <font FACE="Century Gothic" SIZE=2 color="#000000"><b>
                <?php if($disponibilidad !=0){ ?>
                <a href="reserva.php?id_park=<?php echo $id_park?>"><input type="button" value="Reservar"> <?php }
                else{?>
                <a href="reserva.php?id_park=<?php echo $id_park?>"><input type="button" value="Reservar" disabled><?php } ?>
                </b>
                </font>
                     	</td>


	     </tr>


<?php
			   }
?>


                   </table>
<br><br>


<br><br><hr>
                  </td>
                </tr>
        </table>

       </body>
      </html>

