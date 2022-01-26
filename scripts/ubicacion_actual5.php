<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Posicion </title>
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
  <div id="map"></div>

 <form method="POST" action="accion.php">
    <b>El marcador (imagen del globo rojo) señala su posicion actual, presione el boton para ver que parqueadero esta mas cerca</b><br>
    <input type="text" id="coords" value="coords" name="coordena" />
    <input type="submit" />
 </form>

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

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYfauZqaXuEdb2Kfog5IuKDh-pB5U6BVM&callback=initMap"></script> <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS -->
  
     <?php
      if (isset($_GET["mensaje"]))
      {
        $mensaje = $_GET["mensaje"];
        if ($_GET["mensaje"]!=""){?>
		     <table>
  		     <tr>
             <td> </td>
             <td height="20%" align="left">
                  <table width=60% border=1>
                   <tr>
                    <?php 
                       if ($mensaje == 1)
                         echo "<td bgcolor=#DDFFDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Parqueadero mas cercano es Tulcan.";
                       if ($mensaje == 2)
                         echo "<td bgcolor=#FFDDDD class=_espacio_celdas_p 					
                    style=color: #000000; font-weight: bold >Parqueadero mas cercano es FIET.";

             echo "</td></tr>
                  </table>
              </td>
    		     </tr>
          <table>";
            }
         }   
      ?>      
  </body>
</html>
