
function post_papel() {
	$.post('../cotizacion/ajax_papel.php', {
		a: $('#arrpapel').val(),
		c: $('#cotizacion').val(),
		beforeSend: function () {
			$('#lstpapeles ul').html('Espere un momento por favor');
		}
	}, function (respuesta) {
		$('#lstpapeles ul').html(respuesta);
	});
}
$('.agregar-papel').click(function () {
	 var pap = $(this).parent().parent().text();
	 pap = pap.substr(0, pap.length - 4);

	$('#lstpapeles ul').append('<li class="listapapeles collection-item"><div>' + pap + '<a id="' + $(this).attr('id') + '" class="eliminar_papel secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>');

	$('.eliminar_papel').click(function () {
	borra_papel(this);
	post_papel();
	});
	$('#arrpapel').val(
		($('#arrpapel').val() != "" ?
			$('#arrpapel').val() + "*;*" + $(this).attr('id') :
			$(this).attr('id')) +
		"*,*" + $('#numero_hojas').val() +
		"*,*" + $('#numero_moldes').val() +
		"*,*" + $('#numero_tintas').val() +
		"*,*" + $('#numero_tamanos').val() +
		"*,*" + $('#numero_pliegos').val() +
		"*,*" + $('#numero_grupos').val() +
		"*,*" + $('#numero_cort_grupo').val() +
		"*,*" + $('#' + this.id).attr("data-ancho") +
		"*,*" + $('#' + this.id).attr("data-alto") +
		"*,*" + $('#ancho_tamano_corte').val() +
		"*,*" + $('#alto_tamano_corte').val() +
		"*,*" + $('#ancho_corte_final').val() +
		"*,*" + $('#alto_corte_final').val());
	post_papel();
//	return false;

});
var ult_pap = 0;
/*Borra u determinado papel recibiendo como parametro el botton borrar */
function borra_papel(objeto) {
	var arrpaptemp = $('#arrpapel').val().split('*;*');
	arrpaptemp.splice($(objeto).parent().parent().index() - 1, 1);
	$(objeto).parent().parent().remove();
	$('#arrpapel').val(arrpaptemp.join('*;*'));
}
$('#alto_tamano_pliego, #ancho_tamano_pliego, #alto_tamano_corte, #ancho_tamano_corte').change(function () {
	switch ($(this).attr('id')) {
		case 'ancho_tamano_pliego':
			papel_cotizacion.ancho_tamano_pliego = $(this).val();
			edita_campo($('#arrpapel'), ult_pap, 8, $(this).val());
			break;
		case 'alto_tamano_pliego':
			papel_cotizacion.alto_tamano_pliego = $(this).val();
			edita_campo($('#arrpapel'), ult_pap, 9, $(this).val());
			break;
		case 'ancho_tamano_corte':
			papel_cotizacion.ancho_tamano_corte = $(this).val();
			edita_campo($('#arrpapel'), ult_pap, 10, $(this).val());
			break;
		case 'alto_tamano_corte':
			papel_cotizacion.alto_tamano_corte = $(this).val();
			edita_campo($('#arrpapel'), ult_pap, 11, $(this).val());
			break;
	}
	papel_cotizacion.numero_tamanos = papel_cotizacion.CalcularCantidadTamanosPorPliego();
	$('#numero_tamanos').val(papel_cotizacion.numero_tamanos);
	edita_campo($('#arrpapel'), ult_pap, 4, papel_cotizacion.numero_tamanos);

});

function edita_campo(obj, fila, campo, valor) {
	arrpaptemp = $(obj).val().split('*;*');
	itempaptemp = arrpaptemp[fila].split('*,*');
	itempaptemp[campo] = valor;
	arrpaptemp[fila] = itempaptemp.join('*,*');
	obj.val(arrpaptemp.join('*;*'))
}
$('#libros_articulos, #numero_moldes, #numero_hojas, #numero_tintas, #numero_tamanos').change(function () {
	switch ($(this).attr('id')) {
		case 'numero_moldes':
			papel_cotizacion.numero_moldes = $(this).val();
			edita_campo($('#arrpapel'), ult_pap, 2, $(this).val());
			break;
		case 'numero_hojas':
			papel_cotizacion.numero_hojas = $(this).val();
			edita_campo($('#arrpapel'), ult_pap, 1, $(this).val());
			break;
		case 'numero_tintas':
			papel_cotizacion.numero_tintas = $(this).val();
			edita_campo($('#arrpapel'), ult_pap, 3, $(this).val());
			break;
		case 'numero_tamanos':
			papel_cotizacion.numero_tamanos = $(this).val();
			edita_campo($('#arrpapel'), ult_pap, 4, $(this).val());
			break;
	}
	//papel_cotizacion.numero_pliegos= papel_cotizacion.CalcularPliegos($('#libros_articulos').val(), true,false, 0.30);
	papel_cotizacion.numero_pliegos = papel_cotizacion.CalcularPliegos($('#libros_articulos').val(), false, true, 0.30);
	$('#numero_pliegos').val(papel_cotizacion.numero_pliegos);
	edita_campo($('#arrpapel'), ult_pap, 5, papel_cotizacion.numero_pliegos);

});
