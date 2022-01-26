<?php
     error_reporting(0);
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
             <font FACE="Century Gothic" SIZE=2 color="#000000">Parqueadero:
             <select name=id_con>
             <?php
             if (isset($_POST["id_con"]))
              {
                $id_con = $_POST["id_con"];
                 if ($_POST["id_con"]!="")
                  {
                    if ($id_con == "0")
                     {
                      echo "<option value=".$id_con."> Todos los parqueaderos</option>";
                      echo "<option value=1> Tulcan</option>";
                      echo "<option value=2> Fiet</option>";
                     }
                    else if ($id_con == "1")
                     {
                      echo "<option value=".$id_con."> Tulcan</option>";
                      echo "<option value=0> Todos los parqueaderos</option>";
                      echo "<option value=2> Fiet</option>";
                     }
                    else if ($id_con == "2")
                     {
                      echo "<option value=".$id_con."> Fiet</option>";
                      echo "<option value=0> Todos los parqueaderos</option>";
                      echo "<option value=1> Tulcan</option>";
                     }
                  }
               }
              else
               {
                 ?>
                  <option value=0> Todos los parqueaderos</option>
                  <option value=1> Tulcan </option>
                  <option value=2> Fiet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
              <?php
               }
              ?>
              </select> &nbsp&nbsp&nbsp
             <font FACE="Century Gothic" SIZE=2 color="#000000">Usuario: <input type="text" name=usuario_con value=""></font>            &nbsp&nbsp&nbsp

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
                    if ($estado == "0")
                     {
                     echo "<option value=".$estado."> Todas las reservas</option>";
                     echo "<option value=1> Solo reservas activas</option>";
                     echo "<option value=2> Solo reservas inactivas</option>";
                     }
                    else if ($estado == "1")
                     {
                      echo "<option value=".$estado."> Solo reservas activas</option>";
                      echo "<option value=0> Todas las reservas</option>";
                      echo "<option value=2> Solo reservas inactivas</option>";
                     }
                    else if ($estado == "2")
                     {
                      echo "<option value=".$estado."> Solo reservas inactivas</option>";
                      echo "<option value=0> Todas las reservas</option>";
                      echo "<option value=1> Solo reservas activas</option>";
                     }
                  }
               }
              else
               {
                 ?>
                  <option value=0> Todas las reservas</option>
                  <option value=1> Solo reservas activas</option>
                  <option value=2> Solo reservas inactivas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>

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
         

           $usuario_con = $_POST["usuario_con"];
           $estado = $_POST["estado"];
           $id_con = $_POST["id_con"];

           $sql1 = "SELECT * from reserva";
           if (($id_con == "0") and ($usuario_con == ""))
             {
              if ($estado != "0")
                $sql1 = "SELECT * from reserva where id_estado='$estado'";
             }
           if (($id_con != "0") and ($usuario_con == ""))
             {
              if ($estado == "0"){
                 if($id_con=="1"){

                      $sql1 = "SELECT * from reserva where id_puesto=1 or id_puesto=2";
                 }
                 if($id_con=="2"){

                      $sql1 = "SELECT * from reserva where id_puesto=3 or id_puesto=4";
                 }}
              else {
                   if($id_con=="1"){
                          $sql1 = "SELECT * from reserva where id_puesto=1 and id_estado='$estado' or id_puesto=2 and id_estado='$estado'";
                      }
                   if($id_con=="2"){
                          $sql1 = "SELECT * from reserva where id_puesto=3 and id_estado='$estado' or id_puesto=4 and id_estado='$estado'";
                      }
                }
             }
           if (($id_con == "0") and ($usuario_con != ""))
             {
              if ($estado == "0"){
                $sql11 = "SELECT id_usuario from usuario where nombre LIKE '%$usuario_con%'";
                $result11 = $mysqli->query($sql11);
                $row11= $result11->fetch_array(MYSQLI_NUM);
                $id_usua=$row11[0];
                $sql1="Select * from reserva where id_usuario='$id_usua'";
                }
              else {
                $sql11 = "SELECT id_usuario from usuario where nombre LIKE '%$usuario_con%'";
                $result11 = $mysqli->query($sql11);
                $row11= $result11->fetch_array(MYSQLI_NUM);
                $id_usua=$row11[0];
                $sql1="Select * from reserva where id_usuario='$id_usua' and id_estado='$estado'";
                }
              }
           if (($id_con != "0") and ($usuario_con != ""))
             {
              if ($estado == "0"){
                 $sql11 = "SELECT id_usuario from usuario where nombre LIKE '%$usuario_con%'";
                 $result11 = $mysqli->query($sql11);
                 $row11= $result11->fetch_array(MYSQLI_NUM);
                 $id_usua=$row11[0];
                 
                 if($id_con=="1"){
                      $sql1 = "SELECT * from reserva where id_usuario='$id_usua' and id_puesto=1 or id_usuario='$id_usua' and id_puesto=2";
                 }
                 if($id_con=="2"){
                      $sql1 = "SELECT * from reserva where id_usuario='$id_usua' and id_puesto=3 or id_usuario='$id_usua' and id_puesto=4";
                 }
              }
              else{

                 $sql11 = "SELECT id_usuario from usuario where nombre LIKE '%$usuario_con%'";
                 $result11 = $mysqli->query($sql11);
                 $row11= $result11->fetch_array(MYSQLI_NUM);
                 $id_usua=$row11[0];

                 if($id_con=="1"){
                      $sql1 = "SELECT * from reserva where id_usuario='$id_usua' and id_puesto=1 and id_estado='$estado' or id_usuario='$id_usua' and id_puesto=2 and id_estado='$estado'";
                 }
                 if($id_con=="2"){
                      $sql1 = "SELECT * from reserva where id_usuario='$id_usua' and id_puesto=3 and id_estado='$estado' or id_usuario='$id_usua' and id_puesto=4 and id_estado='$estado'";
                 }
               }
             }
          }
         else
             $sql1 = "SELECT * from reserva";

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
                $id_estado=$row1[8];

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
          
          $sql103 = "SELECT nombre from usuario where ID_USUARIO= '$usuario' ";
          $result103 = $mysqli->query($sql103);
          $row103 = $result103->fetch_array(MYSQLI_NUM);
          $nombreusuario = $row103[0];
          
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
