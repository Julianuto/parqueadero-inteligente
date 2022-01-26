<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title> SIP
		  </title>
      <meta http-equiv="refresh" content="15" />
    </head>
    <body>
      <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">

    	 <tr>
         <td valign="center" align=center width=70%  bgcolor="#2E4053">
           <img src="../img/sip.png" border=0 width=150 height=150>
         </td>
         <td valign="top" align=center width=30% bgcolor="#2E4053">
          &nbsp &nbsp
           <h2> <font color=white face="Century Gothic">Ingreso de Usuarios </font></h2>
            <form method="POST" action="validar.php">
              <table width="100%" align=center border=0 bgcolor="#2E4053" valign=center>
  	            <tr>
                  <td width="25%" height="20%" align="right"
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold; font-family:Century Gothic"">
         		       Usuario:
                  </td>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold">
                     <input type=text value="" name="login1" required >
                  </td>
                </tr>  
  	            <tr>
                  <td width="25%" height="20%" align="right"
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold; font-family:Century Gothic" >
                    Password:
                  </td>
                  <td width="25%" height="20%" align="center"
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold">
                     <input type=password value="" name="passwd1" required> 
                  </td>
                </tr>  
  	            <tr>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF; 
			             font-weight: bold">
                    &nbsp;&nbsp;
                  </td>

                  <td width="25%" height="20%" align="center"
                    bgcolor="#2E4053" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold; font-family:Century Gothic"" >
                   <input type=submit value="Entrar" name="Enviar">
                   <a href="registro.php"><input type="button" value="Registrate" >
                   </td>

                </tr>



                <?php
                if (isset($_GET["mensaje"]))
                 {
                 $mensaje = $_GET["mensaje"];
                    if ($_GET["mensaje"]!=""){
                ?>
  	            <tr>
                  <td width="25%" height="20%" align="center" 				
                    bgcolor="#FFCCCC" class="_espacio_celdas_p" 					
                    style="color: #FF0000; 
			             font-weight: bold">
                    Datos Incorrectos:
                  </td>
                  <td width="25%" height="20%" align="left" 				
                    bgcolor="#FFDDDD" class="_espacio_celdas_p" 					
                    style="color: #FF0000; 
			             font-weight: bold">
                    <?php 
                       if ($mensaje == 1)
                         echo "El password del usuario no coincide.";
                       if ($mensaje == 2)
                         echo "No hay usuarios con el login (usuario) ingresado o esta inactivo.";
                       if ($mensaje == 3)
                         echo "No se ha logueado en el Sistema. Por favor ingrese los datos.";
                       if ($mensaje == 4)
                         echo "Su tipo de usuario, no tiene las credenciales suficientes para ingresar a esta opcion.";
                    ?>                         
                  </td>
                </tr>  
                <?php 
                   }
                 }
                ?>
               </table>  
             </form> 
         </td>
 	     </tr>  </table><table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
 	     <tr>
         <td valign="top" align=center width=80& colspan=2 bgcolor="#FFC300">
           <h1> <font color=white face="Century Gothic">SISTEMA INTELIGENTE DE PARQUEO</font></h1>
         </td>
       </tr> </table>       <table width="80%" align=center cellpadding=5 border=0 bgcolor="#FFFFFF">
 	     <tr>
         <td valign="center" align=center width=30 colspan=1 bgcolor="#2E4053">
           <img src="../img/park1.jpg" border=0 width=600 height=350>
         </td>
         <td align=center bgcolor="#2E4053">
            <b> <font color=white face="Century Gothic">Quienes somos?</font>  </b>
            <p align="justify"> <font color=white face="Century Gothic">Somos un sistema inteligente de parqueo que te brinda todas las herramientas necesarias para reservar tu puesto previamente en el parqueadero de tu preferencia, sugiriendote el puesto mas cercano y la disponibilidad de estos. </font></p>
            <b> <font color=white face="Century Gothic">Nuestra mision</font>  </b>
            <p align="justify"><font color=white face="Century Gothic">Ofrecer un servicio de calidad que brinde la comodidad necesaria para satisfacer las necesidades de los clientes con relacion a sus habitos diarios de parqueo.</font></p>
            <b> <font color=white face="Century Gothic">Nuestra vision</font>  </b>
            <p align="justify"><font color=white face="Century Gothic">Implementar el sistema inteligente de parqueo en 50 paises del mundo con el objetivo de brindar el servicio a millones de conductores.</font> </p>
         </td>
 	     </tr>

       </table>
     </body>
   </html>
