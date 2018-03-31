$('.expand').click(function() {
  var bid =  $(this).attr('id');
  if ($('#detalle_'+bid).css("display") == "none")
  {
    $('#detalle_'+bid).show();
    $("#"+bid).html('<i class="material-icons">expand_less</i>');
  }else {
    $('#detalle_'+bid).hide();
    $("#"+bid).html('<i class="material-icons">expand_more</i>');
  }
  $.post('ajax_detalle.php',{
    id:bid,
    beforeSend: function () {
      $('#res_detalle_'+bid).html('Espere un momento por favor');
           }
   }, function (respuesta) {
        $('#res_detalle_'+bid).html(respuesta);
  });
});

$('.cantidad').change(function() {
var bid =  $(this).attr('id').replace("cant_", ""); ;;
var cant = $(this).val();
$.post('ajax_detalle.php',{
  id:bid,
  n:cant,
  beforeSend: function () {
    $('#res_detalle_'+bid).html('Espere un momento por favor');
         }
 }, function (respuesta) {
      $('#res_detalle_'+bid).html(respuesta);
});
});

$('.tipo').change(function() {
var bid =  $(this).attr('id').replace("tipo_", "");
var tip = $(this).val();
$.post('ajax_detalle.php',{
  id:bid,
  t:tip,
  beforeSend: function () {
    $('#res_detalle_'+bid).html('Espere un momento por favor');
         }
 }, function (respuesta) {
      $('#res_detalle_'+bid).html(respuesta);
});
});
$('.datepicker').change(function() {
var bid =  $(this).attr('id').replace("inicio_", "").replace("fin_", "");
var inicio = $('#inicio_'+bid).val();
var fin = $('#fin_'+bid).val();
$.post('ajax_detalle.php',{
  id:bid,
  i:inicio,
  f:fin,
  beforeSend: function () {
    $('#res_detalle_'+bid).html('Espere un momento por favor');
         }
 }, function (respuesta) {
      $('#res_detalle_'+bid).html(respuesta);
});

});
