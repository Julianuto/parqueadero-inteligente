<HTML>
<HEAD>
 <TITLE>Estado de puesto</TITLE>
  <script Language="JavaScript">
if(window.history.forward(1) != null) window.history.forward(1);
</script>
</HEAD>
<BODY>
    <center>
    <form>  <?php include("conectar.php");  ?>
            <td valign="top" align=center>
            </td>
    </form>
    <?php $ID_PUESTO=$_GET['id_puesto']; ?>
    <?php $nombrepark=$_GET['nombrepark']; ?>
    
     <form action="operacion_reg.php?id_puesto=<?php echo $ID_PUESTO ?>" method="POST">
         <br>
         <td bgcolor="#F4B120" align=center>Estado del puesto #</td>
         <td valign="top" align=center>
           <?php echo $ID_PUESTO; ?>
         </td>
         <br>
         <br>
         <select style="width:130px" style="font-size:14pt" name="id_Hab">
         <option value="1">Habilitar</option>
         <option value="2">Deshabilitar</option>
         </select>
         <br>
         <br>
         <input type="submit" value=" Aceptar" />
         <input type="button" value="Regresar" onclick=" location.href='http://localhost/scripts/menu_admin.html' " >
      </form>
      </center>


</BODY>
</HTML>
