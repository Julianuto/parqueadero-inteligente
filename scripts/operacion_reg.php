
<?php
include("conectar.php");

$id_Hab= $_POST['id_Hab'];
$ID_PUESTO=$_GET['id_puesto'];

$query="UPDATE EstadoPuesto SET ID_HAB='$id_Hab' where ID_PUESTO='$ID_PUESTO'";

$resultado= $conectar ->query($query);

if($resultado){
  echo "Inserción exitosa";
   ?>
        <HTML>
        <BODY>
        <br><br>
        <input type="button" value="Volver al menu" onclick=" location.href='http://localhost/scripts/tabla_parqueaderos_administrador.php' " >

        </BODY>
        </HTML>

<?php
  }
  else " Inserción no exitosa";
?>
