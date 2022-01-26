<!DOCTYPE html>

<HTML>
<HEAD>
 <TITLE>Actualizar</TITLE>
  <script Language="JavaScript">
if(window.history.forward(1) != null) window.history.forward(1);
</script>
</HEAD>
<BODY>
    <center>

    <?php $ID_Park=$_GET['id_parq']; ?>
            
     <form action="operacion_costop.php?id_parq=<?php echo $ID_Park ?>" method="POST">
         <br>
         <td bgcolor="#F4B120" align=center>Nuevo costo del parqueadero #</td>
         <td valign="top" align=center>
         <?php echo $ID_Park; ?>
         </td>
         <br>
         <br>
         <input type="inputText" name="Costo" />
         <br>
         <br>
         <input type="submit" value=" Aceptar" />
         <input type="button" value="Regresar" onclick=" location.href='http://localhost/scripts/menu_admin.html' " >
      </form>
      </center>


</BODY>
</HTML>
