<!DOCTYPE html>

<HTML>
<HEAD>
 <TITLE>Tabla de conductores</TITLE>
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


               </thead>
               <tbody>
                  <tr>
                      <td bgcolor="#F4B120" align=center>Parqueadero</td>
                      <td bgcolor="#F4B120" align=center>Puesto</td>
                      <td bgcolor="#F4B120" align=center>Estado</td>
                      <td bgcolor="#F4B120" align=center>Disponibilidad</td>
                      <td bgcolor="#F4B120" align=center>Ultima actualizacion</td>
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
                        $id_Dispo= "Ocupado";
                        }
                        else $id_Dispo= "";
                        $ID_PUESTO = $row1[3];
                        $fecha = $row1[4];

                      $sql2="SELECT ID_PARK FROM puestoparqueo where ID_PUESTO='$ID_PUESTO'";
                      $resultado2= $conectar ->query($sql2);
                      $row2=$resultado2->fetch_array(MYSQLI_NUM);
                      $idpark=$row2[0];
                      $sql3="SELECT NOMBRE FROM PARQUEADERO where ID_PARK='$idpark'";
                      $resultado3= $conectar ->query($sql3);
                      $row3=$resultado3->fetch_array(MYSQLI_NUM);
                      $nombrepark=$row3[0];
                      $sql9="SELECT CODIGO FROM puestoparqueo where ID_PUESTO='$ID_PUESTO'";
                      $resultado9= $conectar ->query($sql9);
                      $row9=$resultado9->fetch_array(MYSQLI_NUM);
                      $CODIGO=$row9[0];


                      ?>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <tr>
         <td valign="top" align=center>
           <?php echo $nombrepark; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $CODIGO; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $id_Hab; ?>
         </td>
         <td valign="top" align=center>
           <?php echo $id_Dispo; ?>
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
