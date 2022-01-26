
<?php
include("conectar.php");

$ID_Park=$_GET['id_parq'];
$Costo=$_POST['Costo'];

$query="UPDATE Parqueadero SET Cobro='$Costo' where ID_Park='$ID_Park'";

$resultado= $conectar ->query($query);

if($resultado){
  echo "Inserción exitosa";
   ?>
        <HTML>
        <BODY>
        <br><br>
        <input type="button" value="Volver al menu" onclick=" location.href='http://localhost/scripts/menu_admin.html' " >

        </BODY>
        </HTML>

<?php
  }
  else " Inserción no exitosa";
?>
