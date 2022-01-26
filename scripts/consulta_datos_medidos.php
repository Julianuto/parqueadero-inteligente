<?php

// PROGRAMA DE MENU CONSULTA
include "conectar.php";
                                                 
session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {      
        $mysqli = new mysqli("localhost","root","","parqueo");
  	    $sqlusu = "SELECT * from tipousuario where idtipousuario='2'"; //CONSULTA EL TIPO DE USUARIO CON ID=2, CONSULTA
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
           <title> Sistema parqueadero
           </title>
        </head>
       <body>
        <table width="100%" align=center cellpadding=5 border=0 bgcolor="#2E4053">
    	   <tr>
           <td valign="top" align=left width=70%>
              <table width="100%" align=center border=0>
            	   <tr>
                  <td valign="top" align=center width=30%>
                     <img src="../img/par.jpg" border=0 width=350 height=80>
             	    </td>
                  <td valign="top" align=center width=60%>
                     <h1><font color=#FFFFFF>Sistema de Parqueaderos Inteligentes </font></h1>
             	    </td>
           	    </tr>
         	    </table>
         	    
           </td>
           <td valign="top" align=right>
              <font FACE="arial" SIZE=2 color="#FFFFFF"> <b><u><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre"];?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#FFFFFF"> <b><u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </b></font><br>
              <font FACE="arial" SIZE=2 color="#E32B23"> <b><u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></b></font>

           </td>
	     </tr>
     </table>
    <table width="100%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
<?php
include "menu_usuario.php";
?>
         <tr valign="top">
             <td height="20%" align="left"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="arial" SIZE=2 color="#000044"> <b><h1>Menu de Usuario </h1></b></font>


		       </td>
	          <td height="20%" align="right" 				
                    bgcolor="#FFFFFF" class="_espacio_celdas" 					
                    style="color: #FFFFFF; 
			             font-weight: bold">
			  <img src="../img/gestion_usuarios.jpg" border=0 width=115 height=115>
		       </td>
		     </tr>
		    </table>


    <table width="70%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
       <tr>
         <td valign="top" align=center width=80& colspan=6 bgcolor="2E4053"">
           <h2> <font color=white>Ultimos datos medidos del parqueadero inteligente asignado al Usuario</font></h2>
         </td>
 	     </tr>
    	 <tr>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>#</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Id de la Tarjeta</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Fecha</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b>Hora</b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b></b>
         </td>
         <td valign="top" align=center bgcolor="#E1E1E1">
            <b></b>
         </td>
 	     </tr>
<?php

$mysqli = new mysqli("localhost","root","","parqueo");
$id_usuario1 = $_SESSION["id_usuario"];
$sqlusu1 = "SELECT * from usuario where id_usuario='$id_usuario1'"; //CONSULTA EL ID TARJETA DEL USUARIO LOGUEADO
//echo "sqlusu1 ...".$sqlusu1;
$resultusu1 = $mysqli->query($sqlusu1);
$rowusu1 = $resultusu1->fetch_array(MYSQLI_NUM);
$id_tarjeta= $rowusu1[4];

?>
    	 <tr>
         <td valign="top" align=center>

         </td>
         <td valign="top" align=center>

         </td>
         <td valign="top" align=center>

         </td>
         <td valign="top" align=center>

         </td>
         <td valign="top" align=center>

         </td>
         <td valign="top" align=center>

         </td>
 	     </tr>
<?php
//}
?>
       </table>
       <hr>
       <br><br>
     </body>
   </html>
