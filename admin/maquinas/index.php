<?php include '../extend/header.php';
$compania = $_SESSION ['compania'];
$sel = $con->prepare("SELECT  id, codigo, nombre_maquina, tipo, operarios, maximo_alto,
    maximo_ancho, minimo_alto, minimo_ancho FROM maquina WHERE id_compania =? ");
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

            <span class="card-title">MAquinas
              </span>

            <input type="hidden" name="datos" id ="datos">

        </form>
        <table class="excel" border="1">
          <thead>
            <tr class="cabecera">
              <th class="borrar">Vista</th>
              <th>Id</th>
              <th>Código</th>
              <th>Nombre Maquina</th>
              <th>Tipo</th>
              <th>Operarios</th>
              <th>Máximo</th>
              <th>Mínimo</th>
              <th colspan="2">Acciones </th>
              <th><a href="alta_inventario.php" class="btn-floating green right"><i
                class="material-icons">add</i></a></th>
            </tr>
          </thead>
          <?php
          $sel->execute();
          $sel->bind_result($id, $codigo, $nombre_maquina, $tipo, $operarios, $maximo_alto, $maximo_ancho, $minimo_alto, $minimo_ancho);
          while ($sel->fetch()) {?>
            <tr class="grey lighten-3">
              <td class="borrar"><button data-target="modal1" onclick="enviar(this.value)"
                value="<?php echo $id ?>" class="btn modal-trigger btn-floating"><i class="material-icons">
              visibility</i></button></td>
              <td><?php echo $id ?></td>
              <td><?php echo $codigo ?></td>
              <td><?php echo $nombre_maquina?></td>
              <td><?php
                switch ($tipo) {
                  case 1:
                   echo 'Litografia';
                    break;
                  case 2:
                   echo 'Tipografia';
                    break;
               }?></td>
              <td><?php echo $operarios?></td>
              <td><?php echo $maximo_alto?>X<?php echo $maximo_ancho?></td>
              <td><?php echo $minimo_alto?>X<?php echo $minimo_ancho?></td>
              <td class="borrar"><a href="alta_inventario.php?id=<?php echo $id?>" class="btn-floating blue"><i
                class="material-icons">loop</i></a></td>
              <td class="borrar"><a href="#" class="btn-floating red" onclick="swal({title: '¿Esta seguro que desea eliminar el articulo?',
                type: 'warning',showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, Eliminarlo!'
              }).then((result) => { if (result.value){location.href='eliminar_inventario.php?id=<?php echo $id?>';}})"><i class="material-icons">clear</i></a></td>
              <td class="borrar"><a id="<?php echo $id?>" class="expand btn-floating grey"><i
                class="material-icons">expand_more</i></a></td>
                <input  type="hidden" name="id"  value="<?php echo $id?>">
            </tr>
            <tr id="detalle_<?php echo $id?>" style="display:none;">
              <td colspan="14">
                <nav class="brown lighten-4" >
                  <input type="hidden" id="id" value="<?php echo $id?>">
                  <div class="nav-wrapper black-text">
                    <div class="row">
                      <div class="col s3">
                        <div class="input-field">
                          <i class="material-icons prefix">date_range</i>
                          <input type="date" id="inicio_<?php echo $id?>" class = "datepicker" autocomplete="off" value="2017-01-01">
                          <label for="inicio">Fecha Inicio</label>
                        </div>
                      </div>
                      <div class="col s3">
                        <div class="input-field">
                          <i class="material-icons prefix">date_range</i>
                          <input type="date" id="fin_<?php echo $id?>" class = "datepicker" autocomplete="off" value="<?php echo date("Y-m-d")?>">
                          <label for="fin">Fecha Final</label>
                        </div>
                      </div>
                      <div class="col s3">
                        <select class = "tipo" id="tipo_<?php echo $id?>" name="tipo" required value = "0">
                          <option value="0" selected>TODOS</option>
                          <option value="1">ENTRADA</option>
                          <option value="2">SALIDA</option>
                        </select>
                      </div>
                      <div class="col s3">
                        <div class="input-field">
                          <i class="material-icons prefix">exposure</i>
                          <input type="number" class ="cantidad" name="cantidad" id="cant_<?php echo $id?>" autocomplete="off" value ="10">
                          <label for="cantidad">Cantidad Items</label>
                        </div>
                      </div>

                    </div>
                  </div>
                </nav>

              <div class="row">
                <div id = "res_detalle_<?php echo $id?>" class="col s12"/>
                </div>
              </div>
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
</body>
</html>
