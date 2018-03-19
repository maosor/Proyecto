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
