function add_tercero() {
  $('#lstterceros ul').append('<li class="listaterceros collection-item"><div>'+$('#servicio_tercero').val()+'===>>'+$('#costo_servicio').val()+'<a class="eliminar_tercero secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>');
  $('#arrterceros').val(
    ($('#arrterceros').val()!= ""?
    $('#arrterceros').val()+"*;*"+$('#servicio_tercero').val():
    $('#servicio_tercero').val())+
    "*,*"+$('#costo_servicio').val());
    $(this).addClass('active');
    post_tinta();
}
function post_tinta() {
  $.post('../cotizacion/ajax_terceros.php',{
    a:$('#arrterceros').val(),
    c:$('#cotizacion').val(),
    beforeSend: function () {
      $('#lstterceros ul').html('Espere un momento por favor');
     }
   }, function (respuesta) {
        $('#lstterceros ul').html(respuesta);
  });
}
$('.listaterceros').click(function(){
  var item = $('#arrterceros').val().split('*;*')[$(this).index()].split('*,*')
  $('#servicio_tercero').val(item[0]);
  $('#costo_servicio').val(item[1]);
  $('.listaterceros').removeClass('active');
  $(this).addClass('active');
});
$('.eliminar_tercero').click(function (){
var arrtemp = $('#arrterceros').val().split('*;*');
arrtemp.splice($(this).parent().parent().index(),1);
$('#'+$(this).parent().parent().attr('id')).remove();
$('#arrterceros').val(arrtemp.join('*;*'));
post_tinta();
});
