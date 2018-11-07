<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : PapelCotizacion
* Author            : Mauricio
* Date created      : 2018-08-22
* Purpose           : Datos de los papeles por cotización
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
/**********************************************************************/
class PapelCotizacion{
  public $id_cotizacion = 0;
  public $id = 0;
  public $papel='';
  public $numero_hojas = 0;
  public $numero_moldes = 0;
  public $numero_tintas = 0;
  public $numero_tamanos = 0;
  public $numero_pliegos = 0;
  public $numero_grupos = 0;
  public $numero_cort_grupo = 0;
  public $ancho_tamano_pliego = 0;
  public $alto_tamano_pliego = 0;
  public $ancho_tamano_corte = 0;
  public $alto_tamano_corte = 0;
  public $ancho_corte_final = 0;
  public $alto_corte_final = 0;
  function __construct($id_cotizacion,$id,$papel,$numero_hojas,$numero_moldes,$numero_tintas,$numero_tamanos,
  $numero_pliegos,$numero_grupos,$numero_cort_grupo,$ancho_tamano_pliego,$alto_tamano_pliego,$ancho_tamano_corte,
  $alto_tamano_corte,$ancho_corte_final,$alto_corte_final)
  {
    $this->id_cotizacion=$id_cotizacion;
    $this->id=$id;
    $this->papel= $papel;
    $this->numero_hojas=$numero_hojas;
    $this->numero_moldes=$numero_moldes;
    $this->numero_tintas=$numero_tintas;
    $this->numero_tamanos=$numero_tamanos;
    $this->numero_pliegos=$numero_pliegos;
    $this->numero_grupos=$numero_grupos;
    $this->numero_cort_grupo=$numero_cort_grupo;
    $this->ancho_tamano_pliego=$ancho_tamano_pliego;
    $this->alto_tamano_pliego=$alto_tamano_pliego;
    $this->ancho_tamano_corte=$ancho_tamano_corte;
    $this->alto_tamano_corte=$alto_tamano_corte;
    $this->ancho_corte_final=$ancho_corte_final;
    $this->alto_corte_final=$alto_corte_final;
  }
}

 ?>
