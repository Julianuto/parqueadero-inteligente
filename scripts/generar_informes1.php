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
           <title>Informe de reservas</title>

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
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Informe de reservas</h1></b></font>
	       </td>

	    </tr>
	  </table>

<?php

	$sql = "SELECT SUM(PRECIO) as count FROM reserva
			GROUP BY DATE(FECHA) ORDER BY FECHA";
	$precios = mysqli_query($mysqli,$sql);
    $precios = mysqli_fetch_all($precios,MYSQLI_ASSOC);
	$precios = json_encode(array_column($precios, 'count'),JSON_NUMERIC_CHECK);

    $sql1="SELECT * FROM reserva order by fecha";
    $resultado= $conectar ->query($sql1);
    $row1=$resultado->fetch_array(MYSQLI_NUM) ;
    while($row1=$resultado->fetch_array(MYSQLI_NUM)){
    $fecha    = $row1[3];
    $fecham   = strtotime($fecha);
    $day      = date("d", $fecham);
    $month    = date("m", $fecham);
    $year     = date("Y", $fecham);
    $precio   = $row1[7];

?>

 <?php }?>


                <div align="center">
                <form action="/scripts/generar_informes1.php">
                 <?php

                 $FI=$_GET['inicio'];
                 $FF=$_GET['fin'];
                 $FISep = strtotime($_GET['inicio']);
                 $day = date("d", $FISep);
                 $month = date("m", $FISep);
                 $year = date("Y", $FISep);
                 $FFSep = strtotime($_GET['fin']);
                 $day1 = date("d", $FFSep);
                 $month1 = date("m", $FFSep);
                 $year1 = date("Y", $FFSep);

                 $sql3 = "SELECT count(*) FROM reserva WHERE FECHA = '$FI'";
                 $precioi= $conectar ->query($sql3);
                 $row3=$precioi->fetch_array(MYSQLI_NUM);

                 $sql4 = "SELECT count(*) FROM reserva WHERE FECHA = '$FF'";
                 $preciof= $conectar ->query($sql4);
                 $row4=$preciof->fetch_array(MYSQLI_NUM);

                 $sql5 = "SELECT count(*) FROM reserva WHERE FECHA BETWEEN '$FI' and '$FF'";
                 $preciot= $conectar ->query($sql5);
                 $row5=$preciot->fetch_array(MYSQLI_NUM);

                 $sql6 = "SELECT SUM(PRECIO) FROM reserva WHERE FECHA BETWEEN '$FI' AND '$FF' GROUP BY DATE(FECHA)";
                 $preciot1= $conectar ->query($sql6);
                 $row6=$preciot1->fetch_array(MYSQLI_NUM);
                 $row6 = json_encode(array_column($row6, 'count'),JSON_NUMERIC_CHECK);

                 $sql7 = "SELECT SUM(PRECIO) as count FROM reserva WHERE FECHA BETWEEN '$FI' AND '$FF' GROUP BY DATE(FECHA) ORDER BY FECHA";
	             $final = mysqli_query($mysqli,$sql7);
                 $final = mysqli_fetch_all($final,MYSQLI_ASSOC);
	             $final = json_encode(array_column($final, 'count'),JSON_NUMERIC_CHECK);

	             $sql27 = "SELECT count(*) as count FROM reserva WHERE FECHA BETWEEN '$FI' AND '$FF' GROUP BY DATE(FECHA) ORDER BY FECHA";
	             $final27 = mysqli_query($mysqli,$sql27);
                 $final27 = mysqli_fetch_all($final27,MYSQLI_ASSOC);
	             $final27 = json_encode(array_column($final27, 'count'),JSON_NUMERIC_CHECK);

	             $sql8 = "SELECT FECHA FROM `reserva` WHERE FECHA BETWEEN '$FI' AND '$FF' GROUP BY DATE(FECHA)";
                 $fechas= $conectar ->query($sql8);
                 $fechas=$fechas->fetch_array(MYSQLI_NUM);

                 ?>
                <FONT FACE="century gothic">
                Fecha inicial: &nbsp <input type="date" name="inicio" value='<?php echo $FI?>'> &nbsp
                Fecha final:&nbsp <input type="date" name="fin" value='<?php echo $FF?>'>
                &nbsp &nbsp<input type="submit" value="Generar">     </div><div class="panel-heading">
                <b>Cantidad de reservas del primer dia seleccionado: </b><?php echo $row3[0];?> <br>
                <b>Cantidad de reservas del ultimo dia seleccionado: </b><?php echo $row4[0];?> <br>
                <b>Cantidad de reservas de todos los dias seleccionados: </b><?php echo $row5[0];?>
                </font>
                </form>
                </div>

                <div class="panel-body">
                    <div id="container"></div>
                </div>


<script type="text/javascript">

$(function () {

    var dia= <?php echo $day;?>;
    var mes= <?php echo $month;?>;
    var anio= <?php echo $year;?>;

    var data_precios = <?php echo $final27; ?>;

    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: ''
        },
         xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: {
            day: '%e of %b'
        }
        },
        yAxis: {
            title: {
                text: 'Cantidad de reservas'
            }
        },
        series: [{
            name: 'Cantidad de reservas',
            data: data_precios,
            pointStart: Date.UTC(anio,mes-1,dia),
            pointInterval: 24 * 3600 * 1000
        }]
    });
});

</script>

<br><br><hr>

 </body>
</html>



