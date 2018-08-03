<?php
class TintaCotizacion{
  public $id=0;
  public $id_cotizacion=0;
  public $color= '';
  public $tipo_tinta=1;
  public $numero_tirajes=0;
  public $alto=0;
  public $ancho=0;
  public $lado=1;
  function __construct($id,$id_cotizacion,$color,$tipo_tinta,$numero_tirajes,$alto,$ancho,$lado)
  {
    $this->id=$id;
    $this->id_cotizacion=$id_cotizacion;
    $this->color= $color;
    $this->tipo_tinta=$tipo_tinta;
    $this->numero_tirajes=$numero_tirajes;
    $this->alto=$alto;
    $this->ancho=$ancho;
    $this->lado=$lado;
  }
}
 ?>
