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
   $nombre = $_POST["nombre"];
   $nombre = str_replace("ñ","n",$nombre);
   $nombre = str_replace("Ñ","N",$nombre);
   $cobro = $_POST["cobro"];
   $ubicacion = $_POST["direccion"];

   $mysqli = new mysqli("localhost","root","","parqueo");
   $sqlcon = "SELECT * from parqueadero where id_park='$id_park'";
   echo $sqlcon;
   $resultcon = $mysqli->query($sqlcon);
   $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
   $numero_filas = $resultcon->num_rows;

   if ($numero_filas > 0)
     {

         header('Location: tabla_parq.php?mensaje=5');
     }
   else
    {
      $sql = "INSERT INTO parqueadero(nombre, cobro, direccion)
      VALUES ('$nombre','$cobro','$ubicacion')";
      //echo "sql es...".$sql;
      $result1 = $mysqli->query($sql);

      if ($result1 == 1)
        {
          header('Location: tabla_parq.php?mensaje=3');
        }
      else
         header('Location: tabla_parq.php?mensaje=4');

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
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Agregar parqueadero</h1></b></font>
		       </td>

       </tr>

            <tr>
                  <td colspan=2 width="25%" height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">

                   <form method=POST action="tabla_parq_add.php">
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
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Cobro</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=cobro value="" required>
				</td>
			     </tr>
	     <tr>
				<td bgcolor="#2E4053" align=center>
				  <font FACE="Century Gothic" SIZE=2 color="#FFFFFF"> <b>Ubicacion</b></font>
				</td>
				<td bgcolor="#EEEEEE" align=center>
				  <input type="text" name=direccion value="" required>
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
                  <form method=POST action="tabla_parq.php">
                  <input style="background-color: #EEEEEE" type=submit color= blue value="Volver" name="Volver">
                  </form>
             </td>
           </tr>
      </table>

<?php
 }
?>


       </body>
      </html>

