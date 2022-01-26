
<?php
include("conectar.php");

$idTipoUsuario= 2;
$Nombre=$_POST['Nombre'];
$Apellido=$_POST['Apellido'];
$numero_Id=$_POST['Numero_Identificacion'];
$Nom_usuario=$_POST['User_name'];
$clave=$_POST['clave'];

$query="INSERT INTO usuario (idTipoUsuario, Nombre, Apellido, numero_Id, Nom_usuario, clave) VALUES (2,'$Nombre'
,'$Apellido','$numero_Id','$Nom_usuario','$clave')";
$resultado= $conectar ->query($query);

if($resultado){
  echo "Registro completado exitosamente";
?>
<HTML>
<BODY>
<br><br>
<input type="button" value="Volver a la vista principal" onclick=" location.href='http://localhost/scripts/menu.html' " >

</BODY>
</HTML>
<?php
  }
  else " Inserción no exitosa";
?>
