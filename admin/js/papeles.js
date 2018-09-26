$('.agregar-papel').click(function(){
  var pap = $(this).parent().parent().text();
  pap = pap.substr(0, pap.length-4);
$('#lstpapeles ul').append('<li class="listapapeles collection-item"><div>'+pap+'<a id="'+$(this).attr('id')+'" class="eliminar_maquina secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>');
$('#arrpapel').val(
  ($('#arrpapel').val()!= ""?
  $('#arrpapel').val()+"*;*"+$(this).attr('id'):
  $(this).attr('id'))+
  "*,*"+$('#numero_hojas').val()+
  "*,*"+$('#numero_moldes').val()+
  "*,*"+$('#numero_tintas').val()+
  "*,*"+$('#numero_tamanos').val()+
  "*,*"+$('#numero_pliegos').val()+
  "*,*"+$('#numero_grupos').val()+
  "*,*"+$('#numero_cort_grupo').val());
  return false;
});
var ult_maq = 0;
$('.listapapeles').click(function(){
  var item = $('#arrpapel').val().split('*;*')[$(this).index()].split('*,*');
  $('#numero_hojas').val(item[1]);
  $('#numero_moldes').val(item[2]);
  $('#numero_tintas').val(item[3]);
  $('#numero_tamanos').val(item[4]);
  $('#numero_pliegos').val(item[5]);
  $('#numero_grupos').val(item[6]);
  $('.listapapeles').removeClass('active');
  $(this).addClass('active');
  ult_maq = $(this).index();
});
$('.eliminar_papel').click(function (){
var arrpaptemp = $('#arrpapel').val().split('*;*');
arrpaptemp.splice($(this).parent().parent().index(),1);
$('#'+$(this).parent().parent().attr('id')).remove();
$('#arrpapel').val(arrpaptemp.join('*;*'));
});
