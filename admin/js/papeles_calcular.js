
class PapelCotizacion{
  constructor(id_cotizacion,id,papel,numero_hojas,numero_moldes,numero_tintas,numero_tamanos,
  numero_pliegos,numero_grupos,numero_cort_grupo,ancho_tamano_pliego,alto_tamano_pliego,ancho_tamano_corte,
  alto_tamano_corte,ancho_corte_final,alto_corte_final) {
      this.id_cotizacion = id_cotizacion;
      this.id = id;
      this.papel=papel;
      this.numero_hojas = numero_hojas;
      this.numero_moldes = numero_moldes;
      this.numero_tintas = numero_tintas;
      this.numero_tamanos = numero_tamanos;
      this.numero_pliegos = numero_pliegos;
      this.numero_grupos = numero_grupos;
      this.numero_cort_grupo = numero_cort_grupo;
      this.ancho_tamano_pliego = ancho_tamano_pliego;
      this.alto_tamano_pliego = alto_tamano_pliego;
      this.ancho_tamano_corte = ancho_tamano_corte;
      this.alto_tamano_corte = alto_tamano_corte;
      this.ancho_corte_final = ancho_corte_final;
      this.alto_corte_final = alto_corte_final;
  }
  /*
    Hay que llamarlo cuando cambie:
  	papel.AltoPliego
  	papel.AnchoPliego
  	papel.AnchoCorte
  	papel.AltoCorte
*/

  CalcularCantidadTamanosPorPliego()
  {
    var can_tam = 0;
    if (this.ancho_tamano_corte > 0.0 && this.alto_tamano_corte > 0.0)
    {
      var a = Math.trunc(this.alto_tamano_pliego / this.alto_tamano_corte) * Math.trunc(this.ancho_tamano_pliego / this.ancho_tamano_corte);
      var b = Math.trunc(this.alto_tamano_pliego / this.ancho_tamano_corte) * Math.trunc(this.ancho_tamano_pliego / this.alto_tamano_corte);
      if (a > b)
      {
      	can_tam = a;
      }
      else
      {
      	can_tam = b;
      }
    }
    return can_tam;
  }
  /*
  Hay que llamarlo cuando cambie:
	LibrosGlobal,
	papel.Moldes,
	papel.NumHojas,
	papel.Tintas
	papel.CantidadTamanos -> ya sea manual o porque se llama a CalcularCantidadTamanos
  */
  CalcularPliegos(libros, es_carbon,troquel, sobrante_tinta)
  {
  	var pliegos = 0;
  	if (this.numero_tamanos * this.numero_moldes > 0) {
  		if (es_carbon) /* De donde viene*/
  		{
  			pliegos = libros * this.numero_hojas / (this.numero_tamanos * this.numero_moldes);
  		}
  		else
  		{
  			var sobrantes = sobrante_tinta * this.numero_tintas;
  			if (troquel) /* De donde viene*/
  			{
  				sobrantes = sobrante_tinta;
  			}
  			pliegos = ((libros * this.numero_hojas / this.numero_moldes) + sobrantes) / this.numero_tamanos;
  		}
  		pliegos = Math.ceil(pliegos);
  	}
    this.numero_pliegos = pliegos;
  	return pliegos;
  }

}
