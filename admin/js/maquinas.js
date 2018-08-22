$('.agregar-maquina').click(function(){
  var maq = $(this).parent().parent().text();
  maq = maq.substr(0, maq.length-4);
$('#lstmaquinas ul').append('<li class="listamaquinas collection-item"><div>'+maq+'<a id="'+$(this).attr('id')+'" class="eliminar_maquina secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>');
$('#arrmaquina').val(
  ($('#arrmaquina').val()!= ""?
  $('#arrmaquina').val()+"*;*"+$(this).attr('id'):
  $(this).attr('id'))+
  "*,*"+$('#papeles_numero_hojas').val()+
  "*,*"+$('#papeles_numero_copias').val()+
  "*,*"+$('#numero_tintas_montajes').val()+
  "*,*"+$('#numero_tintas_lavados').val()+
  "*,*"+$('#papeles_numero_moldes').val()+
  "*,*"+$('#numero_mascaras').val()+
  "*,*"+$('#numero_planchas').val()+
  "*,*"+$('#numero_quemados').val()+
  "*,*"+$('#numero_med_cortes').val()+
  "*,*"+$('#numero_tiros_troquel').val()+
  "*,*"+$('#numero_tiros_impresos').val()+
  "*,*"+$("input[name='cobra_planchas']:checked").val()+
  "*,*"+$("input[name='troquelado']:checked").val()+
  "*,*"+$("input[name='impresion']:checked").val()+"*,*"+0);
  return false;
});
var ult_maq = 0;
$('.listamaquinas').click(function(){
  var item = $('#arrmaquina').val().split('*;*')[$(this).index()].split('*,*');
  $('#papeles_numero_hojas').val(item[1]);
  $('#papeles_numero_copias').val(item[2]);
  $('#numero_tintas_montajes').val(item[3]);
  $('#numero_tintas_lavados').val(item[4]);
  $('#papeles_numero_moldes').val(item[5]);
  $('#numero_mascaras').val(item[6]);
  $('#numero_planchas').val(item[7]);
  $('#numero_quemados').val(item[8]);
  $('#numero_med_cortes').val(item[9]);
  $('#numero_tiros_troquel').val(item[10]);
  $('#numero_tiros_impresos').val(item[11]);
  $('input[name=cobra_planchas]').attr('checked',item[12]==0?false:true);
  $('input[name=troquelado]').attr('checked',item[13]==0?false:true);
  $('input[name=impresion]').attr('checked',item[14]==0?false:true);
  $("input[name='escaja']:checked").val();
  $('.listamaquinas').removeClass('active');
  $(this).addClass('active');
  ult_maq = $(this).index();
});
$('.eliminar_maquina').click(function (){
var arrmaqtemp = $('#arrmaquina').val().split('*;*');
arrmaqtemp.splice($(this).parent().parent().index(),1);
$('#'+$(this).parent().parent().attr('id')).remove();
$('#arrmaquina').val(arrmaqtemp.join('*;*'));
});
