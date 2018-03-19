<?php
include '../conexion/conexion.php';
$id = htmlentities($_POST['id']);
$compania = $_SESSION ['compania'];
$sel_detalle = $con->prepare("SELECT id, fecha, documento, descripcion, tipo, cantidad, saldo FROM inventario_detalle
WHERE id_articulo = ? AND id_compania = ? ");
$sel_detalle -> bind_param("ii", $id,$compania);
$sel_detalle->execute();
$sel_detalle -> store_result();
if ($sel_detalle->num_rows > 0) {
  $sel_detalle->bind_result($det, $fecha_detalle, $documento, $descripcion_detalle, $tipo_detalle, $cantidad, $saldo);

?>
       <table border="1">
         <tr class="grey lighten-2">
          <th>Fecha</th>
           <th>Documento</th>
           <th>Descrición</th>
           <th>tipo</th>
           <th>Cantidad</th>
           <th>Saldo</th>
           <th></th>
           <th ><a href="alta_inventario_detalle.php?id=<?php echo $id?>" class="small green-text material-icons "><i
             class="small material-icons">add</i></a></th>
         </tr>
         <?php
         while ($sel_detalle->fetch()) {
          ?>
          <tr>
            <td><?php echo $fecha_detalle?></td>
            <td><?php echo $documento?></td>
            <td><?php echo $descripcion_detalle?></td>
            <td><?php echo $tipo_detalle?></td>
            <td><?php echo $cantidad?></td>
            <td><?php echo $saldo?></td>
            <td><a href="alta_inventario_detalle.php?id=<?php echo $id?>&det=<?php echo $det?>" class="small blue-text material-icons " border = "1"><i
              class="small material-icons">loop</i></a></td>
            <td><a href="alta_inventario_detalle.php?id=<?php echo $id?>" class="small red-text material-icons "><i
              class="small material-icons">clear</i></a></td>
          </tr>
        <?php }
           ?>

       </table>
     </div>
   </div>


   </td>
 </tr>
 <?php }
 else {

   echo "<tr><th colspan='7'>No hay detalles para mostrar, click en + para insertar nuevo detalle </th><th><a href='alta_inventario_detalle.php?id= $id'
    class='small green-text material-icons right'><i class='small material-icons'>add</i></a></th> </tr>";
 }
  $sel_detalle->close();
  $con -> close();
 ?>
 <script>

 </script>
