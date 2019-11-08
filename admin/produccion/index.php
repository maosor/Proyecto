<?php include '../extend/header.php';
include '../extend/funciones.php';

?>

<br>
<div class="row">
  <div class="col s10">
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
  <div class="col s2">
    <a  href="../login/salir.php" class="waves-effect waves-light btn-large red"><i class="material-icons right">close</i>Salir</a>
  </div>
</div>
<div class="row">
  <form class="col s12">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">assignment</i>
        <input id="id_cotizacion" type="text" class="validate">
        <label for="id_cotizacion"><?php echo  $_SESSION ['nivel'] <=2?'Contización':'Código'?></label>
      </div>
      <div class="input-field col s6">
        <a class="waves-effect waves-light btn" onclick="enviar()"><i class="material-icons right">search</i>buscar</a>
      </div>
    </div>
  </form>
</div>
<div class="res_modal">

</div>
<?php include '../extend/scripts.php'; ?>
<script>
  function enviar() {

      $.post('ajax_operaciones_realizar.php', {
        id:$('#id_cotizacion').val(),
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
