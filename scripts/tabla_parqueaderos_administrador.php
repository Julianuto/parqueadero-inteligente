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

	    </tr>
	  </table>


<BODY>
             <center>
              <table align="center" border=0 cellpadding=6 bgcolor="#ffffff">

               <tbody>    <table width=80% border=0 align=center>
                  <tr>
                      <td bgcolor="#F4B120" align=center><font FACE="Century Gothic" SIZE=2 color="#000000"><b>Parqueadero</b></font></td>
                      <td bgcolor="#F4B120" align=center><font FACE="Century Gothic" SIZE=2 color="#000000"><b>Puesto</b></font</td>
                      <td bgcolor="#F4B120" align=center><font FACE="Century Gothic" SIZE=2 color="#000000"><b>Estado</b></font</td>
                      <td bgcolor="#F4B120" align=center></td>
                      <td bgcolor="#F4B120" align=center><font FACE="Century Gothic" SIZE=2 color="#000000"><b>Disponibilidad</b></font</td>
                      <td bgcolor="#F4B120" align=center><font FACE="Century Gothic" SIZE=2 color="#000000"><b>Ultima actualizacion</b></font</td>
               </tr>
             <?php

                      $sql1="SELECT * FROM estadopuesto";
                      $resultado= $conectar ->query($sql1);
         
                      while($row1=$resultado->fetch_array(MYSQLI_NUM)){
                       $Id_Estado= $row1[0];
                        if($row1[1]==1){
                        $id_Hab= "Habilitado";
                        }
                        else{
                        $id_Hab= "Deshabilitado";
                        }
                        if($row1[2]==1){
                        $id_Dispo= "Disponible";
                        }
                        elseif($row1[2]==2){
                        $id_Dispo= "Ocupado";
                        }
                        else $id_Dispo= "";
                        $ID_PUESTO = $row1[3];
                        $fecha = $row1[4];

                      $sql2="SELECT ID_PARK FROM puestoparqueo where ID_PUESTO='$ID_PUESTO'";
                      $resultado2= $conectar ->query($sql2);
                      $row2=$resultado2->fetch_array(MYSQLI_NUM);
                      $idpark=$row2[0];
                      $sql3="SELECT NOMBRE FROM PARQUEADERO where ID_PARK='$idpark'";
                      $resultado3= $conectar ->query($sql3);
                      $row3=$resultado3->fetch_array(MYSQLI_NUM);
                      $nombrepark=$row3[0];
                      $sql9="SELECT CODIGO FROM puestoparqueo where ID_PUESTO='$ID_PUESTO'";
                      $resultado9= $conectar ->query($sql9);
                      $row9=$resultado9->fetch_array(MYSQLI_NUM);
                      $CODIGO=$row9[0];


                      ?>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

         <tr>
         <td bgcolor="#EEEEEE" valign="top" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>
           <?php echo $nombrepark; ?>      </b></font>
         </td>
         <td bgcolor="#EEEEEE" valign="top" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000">   <b>
           <?php echo $CODIGO; ?>        </b></font>
         </td>
         <td  bgcolor="#EEEEEE" valign="top" align=center>  <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>
           <?php echo $id_Hab; ?>        </b></font>
         </td>
         <td bgcolor="#EEEEEE" valign="top" align=center>   <font FACE="Century Gothic" SIZE=2 color="#000000">  <b>
           <button class="btn" onclick=" location.href='http://localhost/scripts/formularioact.php?id_puesto=<?php echo $ID_PUESTO ?>&nombrepark=<?php echo $nombrepark ?>&codigo=<?php echo $CODIGO ?> '"><i class="fa fa-edit"></i></button>
                </b></font>
         </td>
         <td bgcolor="#EEEEEE" valign="top" align=center> <font FACE="Century Gothic" SIZE=2 color="#000000"> <b>
           <?php echo $id_Dispo; ?>         </b></font>
         </td>
         <td bgcolor="#EEEEEE" valign="top" align=center>    <font FACE="Century Gothic" SIZE=2 color="#000000">  <b>
           <?php echo $fecha; ?>      </b></font>
         </td>
         </tr>

                <?php
                  }
                  ?>

</BODY>
</HTML>
