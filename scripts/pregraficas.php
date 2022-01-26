<?php

include ("conectar.php");
$mysqli = new mysqli("localhost","root","","parqueo");

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
                <div class="panel-heading"><b>  </b>
                <form action="/scripts/pregraficas.php">
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

                 $sql7 = "SELECT SUM(PRECIO) as count FROM reserva WHERE FECHA BETWEEN '$FI' AND '$FF' GROUP BY DATE(FECHA) ORDER BY FECHA";
	             $final = mysqli_query($mysqli,$sql7);
                 $final = mysqli_fetch_all($final,MYSQLI_ASSOC);
	             $final = json_encode(array_column($final, 'count'),JSON_NUMERIC_CHECK);


                 ?>

                Inicial <input type="date" name="inicio" value='<?php echo $FI?>'> &nbsp   <br>
                Final <input type="date" name="fin" value='<?php echo $FF?>'>  <br> <br>
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
                text: ''
            }
        },
        series: [{
            name: '',
            data: data_precios,
            pointStart: Date.UTC(anio,mes-1,dia),
            pointInterval: 24 * 3600 * 1000
        }]
    });
});

</script>

</body>
</html>
