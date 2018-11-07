let papel_cotizacion;

$('.agregar-papel').click(function(){
  var pap = $(this).parent().parent().text();
  pap = pap.substr(0, pap.length-4);
$('#lstpapeles ul').append('<li class="listapapeles collection-item"><div>'+pap+'<a id="'+$(this).attr('id')+'" class="eliminar_papel secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>');

$('.eliminar_papel').click(function(){
  borra_papel(this);
});
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
  "*,*"+$('#numero_cort_grupo').val()+
  "*,*"+$('#'+this.id).attr("data-ancho")+
  "*,*"+$('#'+this.id).attr("data-alto")+
  "*,*"+$('#ancho_tamano_corte').val()+
  "*,*"+$('#alto_tamano_corte').val()+
  "*,*"+$('#ancho_corte_final').val()+
  "*,*"+$('#alto_corte_final').val());
  return false;
});
var ult_pap = 0;
$('.listapapeles').click(function(){
  var item = $('#arrpapel').val().split('*;*')[$(this).index()].split('*,*');
  $('#numero_hojas').val(item[1]);
  $('#numero_moldes').val(item[2]);
  $('#numero_tintas').val(item[3]);
  $('#numero_tamanos').val(item[4]);
  $('#numero_pliegos').val(item[5]);
  $('#numero_grupos').val(item[6]);
  $('#numero_cort_grupo').val(item[7]);
  $('#ancho_tamano_pliego').val(item[8]);
  $('#alto_tamano_pliego').val(item[9]);
  $('#ancho_tamano_corte').val(item[10]);
  $('#alto_tamano_corte').val(item[11]);
  $('#ancho_corte_final').val(item[12]);
  $('#alto_corte_final').val(item[13]);
  $('.listapapeles').removeClass('active');
  $(this).addClass('active');
  papel_cotizacion =  new PapelCotizacion($('#cotizacion').val(),$(this).attr('id'), '', item[1],item[2],item[3],item[4],item[5],item[6],
  item[7],item[8],item[9],item[10],item[11],item[12],item[13]);
  ult_pap = $(this).index();

});
 $('.eliminar_papel').click(function (){
  borra_papel(this);
 });
function borra_papel(objeto){
  var arrpaptemp = $('#arrpapel').val().split('*;*');
  arrpaptemp.splice($(objeto).parent().parent().index()-1,1);
  $(objeto).parent().parent().remove();
  $('#arrpapel').val(arrpaptemp.join('*;*'));
}
$('#alto_tamano_pliego, #ancho_tamano_pliego, #alto_tamano_corte, #ancho_tamano_corte').change(function(){
  switch($(this).attr('id')) {
    case 'ancho_tamano_pliego':
        papel_cotizacion.ancho_tamano_pliego = $(this).val();
        edita_campo($('#arrpapel'),ult_pap, 8, $(this).val());
        break;
    case 'alto_tamano_pliego':
        papel_cotizacion.alto_tamano_pliego = $(this).val();
        edita_campo($('#arrpapel'),ult_pap, 9, $(this).val());
        break;
    case 'ancho_tamano_corte':
        papel_cotizacion.ancho_tamano_corte = $(this).val();
        edita_campo($('#arrpapel'),ult_pap, 10, $(this).val());
        break;
    case 'alto_tamano_corte':
        papel_cotizacion.alto_tamano_corte = $(this).val();
        edita_campo($('#arrpapel'),ult_pap, 11, $(this).val());
        break;
}
  papel_cotizacion.numero_tamanos = papel_cotizacion.CalcularCantidadTamanosPorPliego();
  $('#numero_tamanos').val(papel_cotizacion.numero_tamanos);
  edita_campo($('#arrpapel'),ult_pap, 4, $(this).val());

});
function edita_campo(obj, fila, campo, valor){
  arrpaptemp = $(obj).val().split('*;*');
  itempaptemp = arrpaptemp[fila].split('*,*');
  itempaptemp[campo]=valor;
  arrpaptemp[fila] = itempaptemp.join('*,*');
  obj.val(arrpaptemp.join('*;*'))
}
$('#libros_articulos, #numero_moldes, #numero_hojas, #numero_tintas, #numero_tamanos').change(function(){
  switch($(this).attr('id')) {
    case 'numero_moldes':
        papel_cotizacion.numero_moldes = $(this).val();
        edita_campo($('#arrpapel'),ult_pap, 2, $(this).val());
        break;
    case 'numero_hojas':
        papel_cotizacion.numero_hojas = $(this).val();
        edita_campo($('#arrpapel'),ult_pap, 1, $(this).val());
        break;
    case 'numero_tintas':
        papel_cotizacion.numero_tintas = $(this).val();
        edita_campo($('#arrpapel'),ult_pap, 3, $(this).val());
        break;
    case 'numero_tamanos':
        papel_cotizacion.numero_tamanos = $(this).val();
        edita_campo($('#arrpapel'),ult_pap, 4, $(this).val());
        break;
      }
      //papel_cotizacion.numero_pliegos= papel_cotizacion.CalcularPliegos($('#libros_articulos').val(), true,false, 0.30);
      papel_cotizacion.numero_pliegos= papel_cotizacion.CalcularPliegos($('#libros_articulos').val(), false,true, 0.30);
      $('#numero_pliegos').val(papel_cotizacion.numero_pliegos);
      edita_campo($('#arrpapel'),ult_pap, 5, $(this).val());

});
class Papel{
  constructor ( alto, ancho ) {
    this.alto = alto;
    this.ancho = ancho;
  }
  area () {
    return this.alto * this.ancho;
  }
}
