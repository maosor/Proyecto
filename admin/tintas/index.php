<?php include '../extend/header.php';
include '../extend/funciones.php';
$compania = $_SESSION ['compania'];
$sel = $con->prepare("SELECT id, descripcion, gramos_pulgada_tiraje, costo_gramo
  FROM tinta_tipo  WHERE id_compania =? ");
  $sel->bind_param("i", $compania);
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

            <span class="card-title">Tipos Tinta
              </span>

            <input type="hidden" name="datos" id ="datos">

        </form>
        <table class="excel" border="1">
          <thead>
            <tr class="cabecera">
              <th class="borrar">Vista</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Gramos</th>
              <th>Costo</th>
              <th colspan="1">Acciones </th>
              <th><a href="alta_tinta.php" class="btn-floating green right"><i
                class="material-icons">add</i></a></th>
            </tr>
          </thead>
          <?php
          $sel->execute();
          $sel->bind_result($id, $descripcion, $gramos_pulgada_tiraje, $costo_gramo);
          while ($sel->fetch()) {?>
            <tr class="">
              <td class="borrar"><button data-target="modal1" onclick="enviar(this.value)"
                value="<?php echo $id ?>" class="btn modal-trigger btn-floating"><i class="material-icons">
              visibility</i></button></td>
              <td><?php echo $id ?></td>
              <td><?php echo $descripcion?></td>
              <td><?php echo $gramos_pulgada_tiraje?></td>
              <td><?php echo $costo_gramo?></td>
              <td class="borrar"><a href="alta_tinta.php?id=<?php echo $id?>" class="btn-floating blue"><i
                class="material-icons">edit</i></a></td>
              <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({title: '¿Esta seguro que desea eliminar la tinta?',
                type: 'warning',showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, Eliminarla!'
              }).then((result) => { if (result.value){location.href='eliminar_tinta.php?id=<?php echo $id?>';}})"><i class="material-icons">clear</i></a></td>
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
</body>
</html>
