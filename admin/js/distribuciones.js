function add_distribucion() {
  $('#lstdistribuciones ul').append('<li class="listadistribuciones collection-item"><div>'+$('#distribucion').val()+'<a id="'+$('#distribucion').val()+'" class="eliminar_distribucion secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>');
  $('#arrdistribucion').val(
    ($('#arrdistribucion').val()!= ""?
    $('#arrdistribucion').val()+"*;*"+$('#distribucion').val():
    $('#distribucion').val())+
    "*,*"+$('#perforas_c').val()+
    "*,*"+$('#perforas_p').val()+
    "*,*"+$('#perforas_i').val()+
    "*,*"+$('#perforas_d').val()+
    "*,*"+$('#huecos_c').val()+
    "*,*"+$('#huecos_p').val()+
    "*,*"+$('#huecos_i').val()+
    "*,*"+$('#huecos_d').val());
    $(".listadistribuciones").off('click');
    $(".listadistribuciones").on('click', function(){
      CargaInputs(this);
    });
    $('.eliminar_distribucion').click(function (){
      borra_distribucion(this);
    });
}
function CargaInputs(objeto){
  var item = $('#arrdistribucion').val().split('*;*')[$(objeto).index()].split('*,*')
  $('#distribucion').val(item[0]);
  $('#perforas_c').val(item[1]);
  $('#perforas_p').val(item[2]);
  $('#perforas_i').val(item[3]);
  $('#perforas_d').val(item[4]);
  $('#huecos_c').val(item[5]);
  $('#huecos_p').val(item[6]);
  $('#huecos_i').val(item[7]);
  $('#huecos_d').val(item[8]);
  $('.listadistribuciones').removeClass('active');
  $(objeto).addClass('active');
}
function borra_distribucion(objeto){
  var arrtemp = $('#arrdistribucion').val().split('*;*');
  arrtemp.splice($(objeto).parent().parent().index(),1);
  $(objeto).parent().parent().remove();
  $('#arrdistribucion').val(arrtemp.join('*;*'));
}
$('.listadistribuciones').click(function(){
  CargaInputs(this);
});
$('.eliminar_distribucion').click(function (){
  borra_distribucion(this);
});
