function add_item() {
  $('#lstcolores ul').append('<li class="listacolores collection-item"><div>'+$('#color').val()+'<a id="'+$('#color').val()+'" class="eliminar_color secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>');
  $('#arrcolores').val(
    ($('#arrcolores').val()!= ""?
    $('#arrcolores').val()+"*;*"+$('#color').val():
    $('#color').val())+"*,*"+$("input[name='donde_imprimir']:checked").val()+
    "*,*"+$('#tipo_tinta').val()+
    "*,*"+$('#tinta_alto').val()+
    "*,*"+$('#tinta_ancho').val()+
    "*,*"+$('#num_tirajes').val());
    //$(document).scrollTop($('#lstcolores').top); // no funciona revisar luego
}
$('.listacolores').click(function(){
  //var items = $('#arrcolores').val().split('*;*')[$(this).index()].split('*,*')[1];
  var item = $('#arrcolores').val().split('*;*')[$(this).index()].split('*,*')
  $('#color').val(item[0]);
  $('input[name=donde_imprimir][value='+item[1]+']').attr('checked',true);
  //$('#donde_imprimir').material_select();
  $('#tipo_tinta').val(item[2]);
  $('#tipo_tinta').material_select();
  // Select the option with a value of '1'
  //$('#tipo_tinta').trigger('change');
  //$('#tipo_tinta option[value="4"]').attr('selected', 'selected');
  $('#tinta_alto').val(item[3]);
  $('#tinta_ancho').val(item[4]);
  $('#num_tirajes').val(item[5]);
  $('.listacolores').removeClass('active');
  $(this).addClass('active');
});
$('.eliminar_color').click(function (){
var arrtemp = $('#arrcolores').val().split('*;*');
arrtemp.splice($(this).parent().parent().index(),1);
$('#'+$(this).parent().parent().attr('id')).remove();
$('#arrcolores').val(arrtemp.join('*;*'));

});
