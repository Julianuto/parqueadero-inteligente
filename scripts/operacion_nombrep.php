
<?php
include("conectar.php");

$ID_Park=$_GET['id_parq'];
$Nombre=$_POST['Nombre'];

$query="UPDATE Parqueadero SET Nombre='$Nombre' where ID_Park='$ID_Park'";

$resultado= $conectar ->query($query);

if($resultado){
  echo "Inserci�n exitosa";
   ?>
        <HTML>
        <BODY>
        <br><br>
        <input type="button" value="Volver al menu" onclick=" location.href='http://localhost/scripts/menu_admin.html' " >

        </BODY>
        </HTML>

<?php
  }
  else " Inserci�n no exitosa";
?>
