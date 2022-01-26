<?php

include ("conectar.php");
$mysqli = new mysqli("localhost","root","","parqueo");

	$sql = "SELECT SUM(PRECIO) as count FROM reserva
			GROUP BY DATE(FECHA) ORDER BY FECHA";
	$precios = mysqli_query($mysqli,$sql);
    $precios = mysqli_fetch_all($precios,MYSQLI_ASSOC);
	$precios = json_encode(array_column($precios, 'count'),JSON_NUMERIC_CHECK);
	
 $sql1 = "SELECT FECHA as count FROM reserva GROUP BY DATE(FECHA) ORDER BY FECHA";
	$fechas = mysqli_query($mysqli,$sql1);
    $fechas = mysqli_fetch_all($fechas,MYSQLI_ASSOC);
	$fechas = json_encode(array_column($fechas, 'count'),JSON_NUMERIC_CHECK);
	
?>

<!DOCTYPE html>
<html>
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
                <div class="panel-heading"><b>INFORME DE GANANCIAS</b>  <br> <br>
                <form action="/scripts/grafica_reservas.php">
                
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
                 ?>
                 
                Fecha inicial: &nbsp <input type="date" name="inicio" value='<?php echo $FI?>'> &nbsp
                Fecha final:&nbsp <input type="date" name="fin" value='<?php echo $FF?>'>
                &nbsp &nbsp<input type="submit" value="Generar">
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
    
    var data_precios = <?php echo $precios; ?>;

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
