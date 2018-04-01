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
$('.cantidad,.datepicker,.tipo').change(function() {
var objid=$(this).attr('id');
var bid = objid.match(/\d/g);
bid = bid.join("");
var inicio = $('#inicio_'+bid).val();
var fin = $('#fin_'+bid).val();
var tip = $('#tipo_'+bid).val();
var cant = $('#cant_'+bid).val();
$.post('ajax_detalle.php',{
  id:bid,
  i:inicio,
  f:fin,
  t:tip,
  n:cant,
  beforeSend: function () {
        $('#res_detalle_'+bid).html('Espere un momento por favor');
         }
 }, function (respuesta) {
      $('#res_detalle_'+bid).html(respuesta);
});
});
