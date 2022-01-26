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
       $sqlusu = "SELECT * from tipousuario where idtipousuario='2'"; //CONSULTA EL TIPO DE USUARIO CON ID=1, ADMINISTRADOR
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
    <meta charset="utf-8">
    <title>  Parqueaderos </title>

    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        width: 100%;
        height: 80%;
      }
      #coords{width: 500px;}
    </style>
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
include "menu_usuario.php";
?>
         <tr valign="top">
             <td height="20%" align="center"
                    bgcolor="#FFFFFF" class="_espacio_celdas"
                    style="color: #FFFFFF;
			             font-weight: bold">
			    <font FACE="Century Gothic" SIZE=2 color="#000044" > <b><h1>Encuentra tu parqueadero mas cercano</h1></b></font>
	       </td>

	    </tr>
                </table>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYfauZqaXuEdb2Kfog5IuKDh-pB5U6BVM&callback=initMap"></script>


<form method="POST" action="accion.php" align=center>
    <table width=50% border=0 align=center>
	<td bgcolor="#2E4053" align=center>
    <input type="text" id="coords" value="coords" name="coordena" disabled hidden/>
    <font FACE="Century Gothic" SIZE=2 color="#000000"><input type="submit" value="Consultar"></font>
    </td>
    </table>
</form>

<font FACE="Century Gothic" SIZE=2 color="#FFFFFF">
     <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>
                  <table width=100% border=0><font FACE="Century Gothic" SIZE=1 color="#FFFFFF"><td align=center>
                    <?php
                       if ($mensaje == 1)
                         echo "<td bgcolor=#61D13E class=_espacio_celdas_p align=center
                    style=color: #FFFFFF; font-weight: bold >Tu parqueadero mas cercano es Tulcan.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#61D13E class=_espacio_celdas_p  align=center
                    style=color: #FFFFFF; font-weight: bold >Tu parqueadero mas cercano es FIET.";
            }
         }
      ?>     </td>
               </td>
			    </tr>
                </table>


<div id="map"></div>
<script>

var marker;          //variable del marcador
var coords = {};    //coordenadas obtenidas con la geolocalización

//Funcion principal
initMap = function () 
{

    //usamos la API para geolocalizar el usuario

// Cuando no funcione geolocalización, se comentan las siguientes lineas y se asigna coordenadas fijas
// Si funciona la geolocalización, se pueden descomentar las líneas y utilizarla, sin asignar coordenadas fijas
        navigator.geolocation.getCurrentPosition(
          function (position){
            coords =  {
              lng: position.coords.longitude,
              lat: position.coords.latitude
            };
            setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
            
//          coords= {lat: 2.4400000, lng: -76.6100000};
          setMapa(coords); 
        },function(error){console.log(error);});
    
}


function setMapa (coords)
{   
      //Se crea una nueva instancia del objeto mapa
      var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 15,
        center:new google.maps.LatLng(coords.lat,coords.lng),

      });

      //Creamos el marcador en el mapa con sus propiedades
      //para nuestro obetivo tenemos que poner el atributo draggable en true
      //position pondremos las mismas coordenas que obtuvimos en la geolocalización
      marker = new google.maps.Marker({
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(coords.lat,coords.lng),
      });
      // La siguiente linea envia a la variable coords, la latitud y longitud del marcador obtenido con GEOLOCALIZACIÓN...
      document.getElementById("coords").value = marker.getPosition().lat()+","+ marker.getPosition().lng();
}

//callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

// Carga de la libreria de google maps 

    </script>



  </body>
</html>
