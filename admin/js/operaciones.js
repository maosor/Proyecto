$('.agregar-operacion').click(function(){
  var ope = $(this).parent().parent().text();
  ope = ope.substr(0, ope.length-4);
  costoxcentesima = $(this).parent().parent().attr('data-costoxcentesima')
$('#lstoperaciones ul').append('<li class="listaoperaciones collection-item" data-costoxcentesima="'+costoxcentesima+'"><div>'+ope+'<a id="'+$(this).attr('id')+'" class="eliminar_operacion secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>');
$('#arroperacion').val(
  ($('#arroperacion').val()!= ""?
  $('#arroperacion').val()+"*;*"+$(this).attr('id'):
  $(this).attr('id'))+
  "*,*"+ope+
  "*,*"+costoxcentesima);
  return false;
});
var ult_maq = 0;
// $('.listaoperaciones').click(function(){
//   var item = $('#arroperacion').val().split('*;*')[$(this).index()].split('*,*');
//   $('#codigo').val(item[1]);
//   $('#descripcion').val(item[2]);
//   $('#costoxcentesima').val(item[3]);
//   $('.listaoperaciones').removeClass('active');
//   $(this).addClass('active');
//   ult_maq = $(this).index();
// });
$('.eliminar_operacion').click(function (){
var arropetemp = $('#arroperacion').val().split('*;*');
arropetemp.splice($(this).parent().parent().index(),1);
$('#'+$(this).parent().parent().attr('id')).remove();
$('#arroperacion').val(arropetemp.join('*;*'));
});
