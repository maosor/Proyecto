function add_extra() {
  $('#lstextras ul').append('<li class="listaextras collection-item"><div>'+$('#cantidad_material').val()+'===>>'+$('#material_extra').val()+'<a class="eliminar_extra secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>');
  $('#arrextras').val(
    ($('#arrextras').val()!= ""?
    $('#arrextras').val()+"*;*"+$('#material_extra').val():
    $('#material_extra').val())+
    "*,*"+$('#cantidad_material').val());
    $(this).addClass('active');
}

$('.listaextras').click(function(){
  var item = $('#arrextras').val().split('*;*')[$(this).index()].split('*,*')
  $('#material_extra').val(item[0]);
  $('#cantidad_material').val(item[1]);
  $('.listaextras').removeClass('active');
  $(this).addClass('active');
});
$('.eliminar_extra').click(function (){
var arrtemp = $('#arrextras').val().split('*;*');
arrtemp.splice($(this).parent().parent().index(),1);
$('#'+$(this).parent().parent().attr('id')).remove();
$('#arrextras').val(arrtemp.join('*;*'));

});
