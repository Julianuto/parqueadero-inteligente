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
           <title>Tabla de reservas</title>
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
include "menu_admin.php";
?>
        <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Tabla de reservas</h1></b></font>


		       </td>

		     </tr>
		    </table>

      <tr>
             <td align=center>
        <form action="tabla_reservacion.php" method="POST" align=center>
          <tr>
           <td align=center >
             <font FACE="Century Gothic" SIZE=2 color="#000000">Parqueadero: <input type="text" name=park_con value=""></font>  &nbsp&nbsp&nbsp
             <font FACE="Century Gothic" SIZE=2 color="#000000">Usuario: <input type="text" name=usuario_con value=""></font>            &nbsp&nbsp&nbsp
             <font FACE="Century Gothic" SIZE=2 color="#000000">Fecha: <input type="date" name=fecha_con value=""></font>            &nbsp&nbsp&nbsp
           </td>
          </tr>



          <tr>
           <td width=50%>
             <font FACE="Century Gothic" SIZE=2 color="#000000">Estado reserva:
             <select name=estado>
             <?php
             if (isset($_POST["estado"]))
              {
                $estado = $_POST["estado"];
                 if ($_POST["estado"]!="")
                  {
                    if ($estado == "2")
                     {
                      echo "<option value=".$estado."> Todos los Usuarios</option>";
                     // echo "<option value=1> Usuarios solo Activos</option>";
                     // echo "<option value=0> Usuarios solo Inactivos</option>";
                     }
                    else if ($estado == "1")
                     {
                      echo "<option value=".$estado."> Usuarios solo Activos</option>";
                     // echo "<option value=2> Todos los Usuarios</option>";
                     // echo "<option value=0> Usuarios solo Inactivos</option>";
                     }
                    else if ($estado == "0")
                     {
                      echo "<option value=".$estado."> Usuarios solo Inactivos</option>";
                     // echo "<option value=2> Todos los Usuarios</option>";
                     // echo "<option value=1> Usuarios solo Activos</option>";
                     }
                  }
               }
              else
               {
                 ?>
                  <option value=2> Todos los Usuarios</option>

              <?php
               }
              ?>
              </select> &nbsp&nbsp&nbsp

           <td align=center width=50%>
             <font FACE="Century Gothic" SIZE=2 color="#000000"><input type="submit" name=Consultar value="Consultar"></font>      <br>
           </td>
          </tr> </td>


            <br>

          <input type="hidden" value="1" name="enviado">
         </form>
        </td>
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

				<td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Numero de reserva</b></font>
				</td>
                <td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Parqueadero</b></font>
				</td>

				<td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Puesto</b></font>
				</td>
				<td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Usuario</b></font>
				</td>
   	    <td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Fecha</b></font>
				</td>
		 <td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Hora in</b></font>
				</td>
		 <td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Hora out</b></font>
				</td>
				
					 <td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Precio ($)</b></font>
				</td>


					 <td bgcolor="#A8DDA8" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#004400"> <b>Estado reserva</b></font>
				</td>

				
				
			</tr>

<?php
         $mysqli = new mysqli("localhost","root","","parqueo");
		     if ((isset($_POST["enviado"])))
         {
         
           $park_con1 = $_POST["park_con"];
           $usuario_con = $_POST["usuario_con"];
           $estado = $_POST["estado"];
           
           $sql2="SELECT ID_PARK FROM parqueadero where NOMBRE='$park_con1'";
           $resultado2= $conectar ->query($sql2);
           $row2=$resultado2->fetch_array(MYSQLI_NUM);
           $id_park_con=$row2[0];
           $sql3="SELECT ID_PUESTO FROM puestoparqueo where ID_PARK='$id_park_con'";
           $resultado3= $conectar ->query($sql3);
           $row3=$resultado3->fetch_array(MYSQLI_NUM);
           $park_con=$row3[0];

           $sql1 = "SELECT * from reserva";
           if (($park_con == "") and ($usuario_con == ""))
             {
              if ($estado != "2")
                $sql1 = "SELECT * from reserva where activo='$estado'";
             }
           if (($park_con != "") and ($usuario_con == ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from reserva where id_puesto='$park_con'";
              else
                $sql1 = "SELECT * from reserva where id_puesto='$park_con' and activo='$estado'";
             }
           if (($park_con == "") and ($usuario_con != ""))
             {
              if ($estado == "2")
                $sql1 = "SELECT * from reserva where id_usuario LIKE '%$usuario_con%'";
              else
                $sql1 = "SELECT * from reserva where id_usuario LIKE '%$usuario_con%' and activo='$estado'";
              }
           if (($park_con != "") and ($usuario_con != ""))
             {
              if ($estado == "2")
                 $sql1 = "SELECT * from reserva where id_usuario LIKE '%$usuario_con%' and id_puesto='$park_con'";
              else
                $sql1 = "SELECT * from reserva where id_usuario LIKE '%$usuario_con%' and id_puesto='$park_con' and activo='$estado'";
             }
          }
         else
             $sql1 = "SELECT * from reserva";

         //echo "sql1 es...".$sql1;

         $result1 = $mysqli->query($sql1);
         while($row1 = $result1->fetch_array(MYSQLI_NUM))
         {
			    $id_reserva  = $row1[0];
			    $id_puesto  = $row1[1];
                $usuario = $row1[2];
                $fecha = $row1[3];

                $hora_in = $row1[4];
                $hora_out = $row1[5];
                $precio = $row1[7];

          $sql100 = "SELECT ID_PARK from puestoparqueo where ID_PUESTO= '$id_puesto' ";
          $result100 = $mysqli->query($sql100);
          $row100 = $result100->fetch_array(MYSQLI_NUM);
          $id_park = $row100[0];

          $sql101 = "SELECT * from parqueadero where ID_PARK= '$id_park' ";
          $result101 = $mysqli->query($sql101);
          $row101 = $result101->fetch_array(MYSQLI_NUM);
          $nombrepark = $row101[2];
          
          $sql102 = "SELECT CODIGO from puestoparqueo where ID_PUESTO= '$id_puesto' ";
          $result102 = $mysqli->query($sql102);
          $row102 = $result102->fetch_array(MYSQLI_NUM);
          $codigopuesto = $row102[0];
          
          $sql103 = "SELECT nom_usuario from usuario where ID_USUARIO= '$usuario' ";
          $result103 = $mysqli->query($sql103);
          $row103 = $result103->fetch_array(MYSQLI_NUM);
          $nombreusuario = $row103[0];

          $sql104 = "SELECT id_estado from estado where id_reserva= '$id_reserva' ";
          $result104 = $mysqli->query($sql104);
          $row104 = $result104->fetch_array(MYSQLI_NUM);
          $id_estado = $row104[0];
          
          $sql105 = "SELECT descripcion from estadoreserva where id_estado= '$id_estado' ";
          $result105 = $mysqli->query($sql105);
          $row105 = $result105->fetch_array(MYSQLI_NUM);
          $descripcion = $row105[0];

?>

		        <tr>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b> <?php echo $id_reserva; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $nombrepark; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $codigopuesto; ?></b></font>
				</td>
                    	<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $nombreusuario; ?></b></font>
				</td>


                <td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $fecha; ?></b></font>
				</td>
						<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $hora_in; ?></b></font>
				</td>
						<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $hora_out; ?></b></font>
				</td>
				
						<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $precio; ?></b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b><?php echo $descripcion; ?></b></font>
				</td>


	     </tr>


<?php
			   }
?>



                   </table>
<br><br><hr>
                  </td>
                </tr>
        </table>

       </body>
      </html>
