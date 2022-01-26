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
           <title>Tabla de puestos</title>

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
include "menu_admin.php";
?>
        <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Tabla de puestos</h1></b></font>
	       </td>
         <td height="20%" align="right"
             bgcolor="#FFFFFF" class="_espacio_celdas"
             style="color: #FFFFFF;
            font-weight: bold">

		     </td>
	    </tr>
	  </table>
	  
<BODY>
                <center>
      <form>
            <td valign="top" align=center>
            </td>
      </form>
      <?php $ID_PUESTO=$_GET['id_puesto']; ?>
      <?php $nombrepark=$_GET['nombrepark']; ?>
      <?php $CODIGO=$_GET['codigo']; ?>
    
             <center>
              <table align="center" border="0" cellpadding=6 bgcolor="#ffffff">
               <thead>
               <tr>

               </tr>


               </thead>
               <tbody>   <table width=80% border=0 align=center>
                  <tr>
                      <td bgcolor="#F4B120" align=center><font face="Century Gothic" size=2><b>Parqueadero</b></font></td>
                      <td bgcolor="#F4B120" align=center><font face="Century Gothic" size=2><b>Puesto</b></font></td>
                      <td bgcolor="#F4B120" align=center><font face="Century Gothic" size=2><b>Estado</b></font></td>
                      <td bgcolor="#F4B120" align=center></td>
                      <td bgcolor="#F4B120" align=center></td>
               </tr>

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <tr>

         <td valign="top" align=center bgcolor="#EEEEEE"><font face="Century Gothic" size=2><b>
                 <?php echo $nombrepark; ?>    </font></b>
         </td>
         <td valign="top" align=center bgcolor="#EEEEEE"> <font face="Century Gothic" size=2><b>
                  <?php echo $CODIGO; ?>  </font></b>
         </td>
         <td valign="top" align=center bgcolor="#EEEEEE" size=2>

         <form action="operacionact.php?id_puesto=<?php echo $ID_PUESTO ?>&nombrepark=<?php echo $nombrepark ?>" method="POST">
         <select style="width:130px" style="font-size:14pt" name="id_Hab">
         <option value="1">Habilitar</option>
         <option value="2">Deshabilitar</option>
         </select>
         </td>
         <td valign="top" align=center bgcolor="#EEEEEE">
         <input type="submit" value=" Aceptar" />
         <?php
         $query="UPDATE EstadoPuesto SET ID_HAB='id_Hab' where ID_PUESTO='$ID_PUESTO'";
         $resultado= $conectar ->query($query);
         ?>
         </form>
         </td>
         <td valign="top" align=center bgcolor="#EEEEEE">
         <input type="button" value="Regresar" onclick=" location.href='http://localhost/scripts/tabla_parqueaderos_administrador.php' " >
         </form>
         </td>
         </tr>


</BODY>
</HTML>
