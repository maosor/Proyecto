<!-- 1.	Hacer un botón para ordena por código o por descripción en el inventario
2.	Dura mucho cargando la lista después de agregar un articulo -->



<?php include '../extend/header.php';
$compania = $_SESSION ['compania'];
if (isset($_GET['tip'])) {
  $tipo = $con->real_escape_string(htmlentities($_GET['tip']));
  $sel = $con->prepare("SELECT  id, codigo, descripcion, tipo, existencia, precio_unitario,
    proveedor FROM inventario WHERE tipo = ? AND id_compania =? order by descripcion");
  $sel->bind_param("si", $tipo,$compania);
}else {
  $sel = $con->prepare("SELECT  id, codigo, descripcion, tipo, existencia, precio_unitario,
    proveedor FROM inventario WHERE id_compania =? order by descripcion");
    $sel->bind_param("s", $compania);
}
?>

<br>
<div class="row">
  <div class="col s12">
    <nav class="brown lighten-3" >
      <div class="nav-wrapper">
        <div class="input-field">
          <input type="search"   id="buscar" autocomplete="off"  >
          <label for="buscar"><i class="material-icons" >search</i></label>
          <i class="material-icons" >close</i>
        </div>
      </div>
    </nav>
  </div>
</div>
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <form action="excel.php" method="post" target="_blank" id="exportar">

            <span class="card-title">Inventario
              </span>

            <input type="hidden" name="datos" id ="datos">

        </form>
        <table class="excel" border="1">
          <thead>
            <tr class="cabecera">
              <th class="borrar">Vista</th>
              <th id="h_codigo" class='ordena'><i class="material-icons blue-text" style="font-size: 15px;">sort_by_alpha</i> Código </th>
              <th id="h_descripcion" class='ordena'> <i class="material-icons blue-text"style="font-size: 15px;">sort_by_alpha</i> Descrición  </th>
              <th>Tipo</th>
              <th>Existencia</th>
              <th>Precio</th>
              <th>Proveedor</th>
              <th colspan="2">Acciones </th>
              <th><a href="alta_inventario.php" class="btn-floating green right"><i
                class="material-icons">add</i></a></th>
            </tr>
          </thead>
          <?php
          $sel->execute();
          $sel->bind_result($id, $codigo, $descripcion, $tipo, $existencia, $precio_unitario, $proveedor);
          while ($sel->fetch()) {?>
            <tr class="grey lighten-3">
              <td class="borrar"><button data-target="modal1" onclick="enviar(this.value)"
                value="<?php echo $id ?>" class="btn modal-trigger btn-floating tooltipped"
                data-position="top" data-tooltip="Vista completa del articulo #<?php echo $id ?>"><i class="material-icons">
              visibility</i></button></td>
              <td><?php echo $codigo ?></td>
              <td><?php echo $descripcion?></td>
              <td><?php
                switch ($tipo) {
                  case 1:
                   echo 'Papeles';
                    break;
                  case 2:
                   echo 'Suministros';
                    break;
                  case 3:
                   echo 'Repuestos';
                    break;
                  case 4:
                   echo 'Otros';
                    break;
                  case 5:
                   echo 'Tintas';
                    break;
               }?></td>
              <td><?php echo $existencia?></td>
              <td><?php echo "¢".number_format($precio_unitario,2); ?></td>
              <td><?php echo $proveedor ?></td>
              <td class="borrar"><a href="alta_inventario.php?id=<?php echo $id?>" class="btn-floating blue tooltipped"
              data-position="top" data-tooltip="Editar el articulo #<?php echo $id ?>"><i
                class="material-icons">edit</i></a></td>
              <td class="borrar"><a href="#" class="btn-floating red tooltipped"
              data-position="top" data-tooltip="Eliminar el articulo #<?php echo $id ?>" onclick="swal({title: '¿Esta seguro que desea eliminar el articulo?',
                type: 'warning',showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, Eliminarlo!'
              }).then((result) => { if (result.value){location.href='eliminar_inventario.php?id=<?php echo $id?>';}})"><i class="material-icons">clear</i></a></td>
              <td class="borrar"><a id="<?php echo $id?>" class="expand btn-floating grey tooltipped"
              data-position="top" data-tooltip="Mostrar detalle del articulo #<?php echo $id ?>"><i
                class="material-icons">expand_more</i></a></td>
                <input  type="hidden" name="id"  value="<?php echo $id?>">
            </tr>
            <tr id="detalle_<?php echo $id?>" class='cl_detalle'style="display:none;">
              <td colspan="14">
                <!--  -->
              </td>
            </tr>
          <?php }
          $sel->close();
          $con->close();
           ?>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Informacion</h4>
    <div class="res_modal">

    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">CERRAR</a>
  </div>
</div>
<?php include '../extend/scripts.php'; ?>
<script>
  $('.modal').modal();
  function enviar(valor) {
      $.get('modal.php', {
        id:valor,
        beforeSend: function () {
          $('.res_modal').html('Espere un momento por favor');
         }
       }, function (respuesta) {
            $('.res_modal').html(respuesta);
      });
    }
</script>
<script>
  $('.botonExcel').click(function () {
  $('.borrar').remove();
  $('#datos').val( $("<div>").append($('.excel').eq(0).clone()).html());
  $('#exportar').submit();
  setInterval(function(){location.reload();},3000);
});

</script>
<script src="../js/detalle.js"></script>
<script src="../js/jquery.sortElements.js"></script>
<script src="../js/ordenar.js"></script>
</body>
</html>
