<?php
include "conectar.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
          <link rel="stylesheet" href="css/estilos_virtual.css" 			type="text/css">
           <title> Registro usuarios</title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#2E4053">
         <tr>
           <td valign="top" align=left width=100% >
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=10% >
                     <img src="../img/sip.png" border=0 width=90 height=90>

             	    </td>
                  <td valign="bottom" align=center width=100%>
                     <h1><font color=#FFFFFF face="Century Gothic">SISTEMA INTELIGENTE DE PARQUEO</font></h1>
             	    </td>
           	    </tr>
         	    </table>
           </td>

	     </tr>
<?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>

             <td height="100%" align="center">
                  <table width=100% border=0>
                   <tr>
                    <?php
                       if ($mensaje == 1)
                         echo " <td bgcolor=#DDFFDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold font-family=century gothic >Usuario actualizado correctamente.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Usuario no fue actualizado correctamente.";
                       if ($mensaje == 3)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Usuario creado correctamente.";
                       if ($mensaje == 4)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Usuario no fue creado. Se presentó un inconveniente";
                       if ($mensaje == 5)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p
                    style=color: #000000; font-weight: bold >Usuario no fue creado. Ya existe usuario con la misma cédula.";

             echo "</td></tr>
                  </table>
              </td>
    		     </tr>";

            }
           }
            ?>

<?php

if ((isset($_POST["enviado"])))
  {
   //echo "grabar cambios modificación";
   $nombre_usuario = $_POST["nombre"];
   $nombre_usuario = str_replace("ñ","n",$nombre_usuario);
   $nombre_usuario = str_replace("Ñ","N",$nombre_usuario);
   $apellido_usuario = $_POST["apellido"];
   $apellido_usuario = str_replace("ñ","n",$apellido_usuario);
   $apellido_usuario = str_replace("Ñ","N",$apellido_usuario);
   $num_id = $_POST["num_id"];
   $login = $_POST["login"];
   $activo = $_POST["activo"];
   $password = $_POST["password"];
   $password_enc = md5($password);
   $mysqli = new mysqli("localhost","root","","parqueo");
   $sqlcon = "SELECT * from usuario where numero_id='$num_id'";
   echo $sqlcon;
   $resultcon = $mysqli->query($sqlcon);
   $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
   $numero_filas = $resultcon->num_rows;


   if ($numero_filas > 0)
     {

         header('Location: registro.php?mensaje=5');
     }
   else
    {
      $sql = "INSERT INTO usuario(idtipousuario, nombre, apellido, numero_id, nom_usuario, clave,activo)
      VALUES (2,'$nombre_usuario','$apellido_usuario','$num_id','$login','$password_enc','$activo')";
      //echo "sql es...".$sql;
      $result1 = $mysqli->query($sql);

      if ($result1 == 1)
        {
          header('Location: registro.php?mensaje=3');
        }
      else
         header('Location: registro.php?mensaje=4');

    }
}

else

{

   ?>

    <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Registrar usuario</h1></b></font>


		       </td>

       </tr>

            <tr>
                  <td colspan=2 width="25%" height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">

                   <form method=POST action="registro.php">
                   <table width=50% border=0 align=center>

				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Nombre</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=nombre value="" required>
				</td>
       </tr>
         <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Apellido</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=apellido value="" required>
				</td>
			     </tr>
	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Numero ID</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="number" name=num_id value="" required>
				</td>
			     </tr>

	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Usuario</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=login value="" required>
				</td>
	     </tr>

	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Clave</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="password" name=password value="" required>
				</td>
	     </tr>

	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Activo (S/N)</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
          <select name=activo required>
            <option value="1"> S (Activo)</option>
            <option value="0"> N (Inactivo)</option>
          </select>
				</td>
	     </tr>
	          <input type="hidden" value="S" name="enviado">
         <table width=50% align=center border=0>
           <tr>
             <td width=50%></td>
             <td align=center><input style="background-color: #FFFFFF" type=submit color= blue value="Grabar" name="Modificar">
                  </form>
             </td>
             <td align=left>
                  <form method=POST action="index.php">
                  <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">
                  </form>
             </td>
           </tr>
      </table>

<?php
 }
?>


       </body>
      </html>L>
