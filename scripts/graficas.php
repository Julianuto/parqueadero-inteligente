<?php
error_reporting(0);
include ("conectar.php");
$mysqli = new mysqli("localhost","root","","parqueo");

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

<!DOCTYPE html>
<html>

                      <?php }?>
<head>
	<title>Reservas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
</head>

<body>

<div class="container">
	<br/>
	<h2 class="text-center"></h2>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center"><H4><FONT FACE="century gothic"><b>GANANCIAS    </b></FONT></H4>        <hr />
                <form action="/scripts/graficas.php">
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
                 
                 $sql3 = "SELECT SUM(PRECIO) FROM reserva WHERE FECHA = '$FI'";
                 $precioi= $conectar ->query($sql3);
                 $row3=$precioi->fetch_array(MYSQLI_NUM);
                 
                 $sql4 = "SELECT SUM(PRECIO) FROM reserva WHERE FECHA = '$FF'";
                 $preciof= $conectar ->query($sql4);
                 $row4=$preciof->fetch_array(MYSQLI_NUM);
                 
                 $sql5 = "SELECT SUM(PRECIO) FROM reserva WHERE FECHA BETWEEN '$FI' and '$FF'";
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
	             
	             $sql8 = "SELECT FECHA FROM `reserva` WHERE FECHA BETWEEN '$FI' AND '$FF' GROUP BY DATE(FECHA)";
                 $fechas= $conectar ->query($sql8);
                 $fechas=$fechas->fetch_array(MYSQLI_NUM);

                 ?>
                 <FONT FACE="century gothic">
                Fecha inicial: &nbsp <input type="date" name="inicio" value='<?php echo $FI?>'> &nbsp
                Fecha final:&nbsp <input type="date" name="fin" value='<?php echo $FF?>'>
                &nbsp &nbsp<input type="submit" value="Generar">    </div><div class="panel-heading">
                <b>Ganancia del primer dia seleccionado: </b>$<?php echo $row3[0];?> <br>
                <b>Ganancia del ultimo dia seleccionado: </b>$<?php echo $row4[0];?> <br>
                <b>Ganancia de todos los dias seleccionados: </b>$<?php echo $row5[0];?>
                </font>
                </form>
                </div>

                <div class="panel-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

$(function () {

    var dia= <?php echo $day;?>;
    var mes= <?php echo $month;?>;
    var anio= <?php echo $year;?>;

    var data_precios = <?php echo $final; ?>;

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
                text: 'PESOS COL ($)'
            }
        },
        series: [{
            name: 'Ganancia',
            data: data_precios,
            pointStart: Date.UTC(anio,mes-1,dia),
            pointInterval: 24 * 3600 * 1000
        }]
    });
});

</script>

</body>
</html>
