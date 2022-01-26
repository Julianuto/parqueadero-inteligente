<!DOCTYPE html>

<HTML>
<HEAD>
 <TITLE>Tabla</TITLE>
</HEAD>
<BODY>
             <center>
              <table align="center" border="6" cellpadding=6 bgcolor="#ffffff">
               <thead>
               <tr>
                  <td valign="top" align=center width=80& colspan=6 bgcolor="#FFFFFF">
                  <img src="../img/par.jpg" width="800" height="250" border="0">
                  </td>
               </tr>
               <tr>
                  <th ></th ><th > Listado de parqueaderos </th> <th> <input type="button" value="Nuevo" onclick=" location.href='http://localhost/scripts/formulario_registrar.html'"></th>
                  <th><a href="javascript:history.back(-1);" title="Ir la página anterior">Volver al menu</a>     </th>
               </tr>

               </thead>
               <tbody>
                  <tr>
                     <td bgcolor="#F4B120" align=center>Id</td>
                      <td bgcolor="#F4B120" align=center>Estado Puesto</td>
                       <td bgcolor="#F4B120" align=center>Disponibilidad</td>
                        <td bgcolor="#F4B120" align=center>Puesto</td>
                        <td bgcolor="#F4B120" align=center>Fecha/hora</td>
               </tr>
             <?php
                      include("conectar.php");
                      $sql1="SELECT * FROM estadopuesto";
                      $resultado= $conectar ->query($sql1);
                      while($row1=$resultado->fetch_array(MYSQLI_NUM)){
                       $Id_Estado= $row1[0];
                        if($row1[1]==1){
                        $id_Hab= "Habilitado";
                        }
                        else{
                        $id_Hab= "Deshabilitado";
                        }
                        if($row1[2]==1){
                        $id_Dispo= "Disponible";
                        }
                        elseif($row1[2]==2){
                        $id_Dispo= "No disponible";
                        }
                        else $id_Dispo= "";
                        $ID_PUESTO = $row1[3];
                        $fecha = $row1[4];

                      ?>
                      <tr>
<td valign="top" align=center>
           <?php echo $Id_Estado; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $id_Hab; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $id_Dispo; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $ID_PUESTO; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $fecha; ?>
         </td>

                        </tr>
                        
                <?php
                  }
                  ?>

</BODY>
</HTML>
