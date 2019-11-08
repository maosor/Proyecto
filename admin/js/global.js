$('.eliminar_papel').click(function () {
	borra_papel(this);
  post_papel();
});
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
  	papel_cotizacion = new PapelCotizacion($('#cotizacion').val(), $(this).attr('id'), '', item[1], item[2], item[3], item[4], item[5], item[6],
		item[7], item[8], item[9], item[10], item[11], item[12], item[13]);
	ult_pap = $(this).index();

});
