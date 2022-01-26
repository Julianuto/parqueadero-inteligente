<?php
include("conectar.php");

$Nom_usuario=$_POST['User_name'];
$clave=$_POST['clave'];

$bandera1=0;
$bandera2=0;

$query="SELECT * FROM usuario";
$resultado= $conectar ->query($query);
while($row1=$resultado->fetch_array(MYSQLI_NUM)){
if($Nom_usuario==$row1[5]){
  $bandera1=1;
  if($clave==$row1[6]){
    $bandera2=1;
    if($row1[1]==1){
      echo "Bienvenido al sistema (Admin)";
        ?>
        <HTML>
        <BODY>
        <br><br>
        <input type="button" value="Continuar..." onclick=" location.href='http://localhost/scripts/menu_admin.html' " >

        </BODY>
        </HTML>

<?php
     }
     else{
          echo "Sesion iniciada correctamente";
          ?>
        <HTML>
        <BODY>
        <br><br>
        <input type="button" value="Continuar..." onclick=" location.href='http://localhost/scripts/menu.html' " >

        </BODY>
        </HTML>

<?php
     }
  }
  }
  }
  if($bandera1==0){
      echo "Nombre de usuario no registrado";
      $bandera2=1;
   ?>
        <HTML>
        <BODY>
        <br><br>
        <input type="button" value="Volver a intentarlo..." onclick=" location.href='http://localhost/scripts/formulario_sesion.html' " >
        <br><br>
        <input type="button" value="Volver al menu principal..." onclick=" location.href='http://localhost/scripts/menu.html' " >
        </BODY>
        </HTML>

<?php
     }
   if($bandera2==0){
     echo "Clave incorrecta";
     ?>
        <HTML>
        <BODY>
        <br><br>
        <input type="button" value="Volver a intentarlo..." onclick=" location.href='http://localhost/scripts/formulario_sesion.html' " >
        <br><br>
        <input type="button" value="Volver al menu principal..." onclick=" location.href='http://localhost/scripts/menu.html' " >
        </BODY>
        </HTML>

        <?php
   }

?>
