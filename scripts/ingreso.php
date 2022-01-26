<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> Ingreso al parqueadero
		  </title>
      <meta http-equiv="refresh" content="15" />
    </head>
    <body>

    <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
    <tr>
    <td valign="center" align=center width=70%  bgcolor="#2E4053">
    <img src="../img/sip.png" border=0 width=150 height=150>
    </td>
    </tr>
    </tr>
    </table>

         <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
 	     <tr>
         <td valign="top" align=center width=80& colspan=2 bgcolor="#FFC300">
         <h1> <font color=white face="Century Gothic">INGRESO</font></h1>
         </td>
         </tr> </table>

         <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
 	     <tr>
         <td width="30%" height="20%" align="center" bgcolor="#2E4053" class="_espacio_celdas" style="color: #FFFFFF; font-weight: bold; font-family:Century Gothic"">
         <font FACE="Century Gothic" SIZE=3 color="#FFFFFF" > <b><h1>Codigo</h1></b></font>
         <form method="POST" action="validar_codigo.php">
         <input type=number value="" name="passwd1" maxlength="3" style="color:black;height:50px; width:60px;font-size:35px" required>
         <br><br>
         <input  type=submit value="Ingresar" name="Enviar" style="color:black;height:50px; width:150px; font-size:30px;font-family: Century Gothic"> <br><br>
         <?php
                if (isset($_GET["mensaje"]))
                 {
                 $mensaje = $_GET["mensaje"];
                    if ($_GET["mensaje"]!=""){
                ?>
  	            <tr>
                  <td width="25%" height="20%" align="center" valign="center"
                    bgcolor="#FF8080" class="_espacio_celdas_p"
                    style="color:blue;
			             font-weight: bold, ; font-size:35px"> <font FACE="Century Gothic" SIZE=6 color="#000000">
                    <?php
                       if ($mensaje == 1)
                         echo "El codigo de reserva no existe";
                       if ($mensaje == 2)
                         echo "Codigo valido, avance";
                       if ($mensaje == 3)
                         echo "El codigo ha sido inactivado por exceder el tiempo de ingreso";
                       if ($mensaje == 4)
                         echo "";
                    ?> </font>
                  </td>
                </tr>
                <?php
                   }
                 }
                ?>


         </tr>
       </table>
     </body>
   </html>
