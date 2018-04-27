<?php
include '../conexion/conexion.php';
$id = htmlentities($_POST['id']);
$compania = $_SESSION ['compania'];
if (isset($_POST['i'])&&isset($_POST['f']))
{
  $finicio = htmlentities($_POST['i']);
  $ffin = htmlentities($_POST['f']);
}
else {
  $finicio = '2017-01-01';
  $ffin = Date("y-m-d");
}
if (isset($_POST['n']))
{
  $num_registros = htmlentities($_POST['n']);
}
else {
  $num_registros = 5;
}
if (!isset($_POST['t'])|| htmlentities($_POST['t'])==0)
{
  $sel_detalle = $con->prepare("SELECT id, fecha, documento, descripcion, tipo, cantidad, saldo FROM inventario_detalle
  WHERE id_articulo = ? AND id_compania = ? AND (fecha BETWEEN ? AND ?)
  ORDER BY fecha DESC LIMIT ? ");
  $sel_detalle -> bind_param("iissi", $id,$compania, $finicio, $ffin, $num_registros);
}
else {
  $tipo = htmlentities($_POST['t']);
  $sel_detalle = $con->prepare("SELECT id, fecha, documento, descripcion, tipo, cantidad, saldo FROM inventario_detalle
  WHERE id_articulo = ? AND id_compania = ? AND (fecha BETWEEN ? AND ?) AND tipo = ?
  ORDER BY fecha DESC LIMIT ? ");
  $sel_detalle -> bind_param("iissii", $id,$compania, $finicio, $ffin, $tipo, $num_registros);
}
$sel_detalle->execute();
$sel_detalle -> store_result();
if ($sel_detalle->num_rows > 0) {
  $sel_detalle->bind_result($det, $fecha_detalle, $documento, $descripcion_detalle, $tipo_detalle, $cantidad, $saldo);

?>
       <table id= "tbdetalle_<?php echo $id?>" border="1">
         <tr class="grey lighten-2">
           <th></th>
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
            <td><a href="" data-target="modal2" onclick="enviar_detalle(<?php echo $det ?>)"
               class="small teal-text text-lighten-1 material-icons modal-trigger" ><i class="small material-icons">visibility</i></a></td>
            <td class="clfecha"><?php echo $fecha_detalle?></td>
            <td><?php echo $documento?></td>
            <td><?php echo $descripcion_detalle?></td>
            <td><?php echo $tipo_detalle?></td>
            <td><?php echo $cantidad?></td>
            <td><?php echo $saldo?></td>
            <td><a href="alta_inventario_detalle.php?det=<?php echo $det?>" class="small blue-text material-icons " border = "1"><i
              class="small material-icons">edit</i></a></td>
            <td class="borrar"><a href="#" class="small material-icons" onclick="swal({title: '¿Esta seguro que desea eliminar el articulo?',
                type: 'warning',showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, Eliminarlo!'
              }).then((result) => { if (result.value){location.href='eliminar_inventario_detalle.php?id=<?php echo $det?>';}})"><i class="small red-text material-icons">clear</i></a></td>

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
 <div id="modal2" class="modal">
   <div class="modal-content">
     <h4>Informacion</h4>
     <div class="res_modal_detalle">

     </div>
   </div>
   <div class="modal-footer">
     <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">CERRAR</a>
   </div>
 </div>
 <?php //include '../extend/scripts.php'; ?>
 <script>
   $('.modal').modal();
   function enviar_detalle(valor) {
       $.get('modal_detalle.php', {
         id:valor,
         beforeSend: function () {
           $('.res_modal_detalle').html('Espere un momento por favor');
          }
        }, function (respuesta) {
             $('.res_modal_detalle').html(respuesta);
       });
     }

  </script>
