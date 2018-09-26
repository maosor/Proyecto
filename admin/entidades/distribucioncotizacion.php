<?php
class distribucionCotizacion{
  public $id=0;
  public $id_cotizacion=0;
  public $distribucion= '';
  public $perforas_c=1;
  public $perforas_p=1;
  public $perforas_i=1;
  public $perforas_d=1;
  public $huecos_c=1;
  public $huecos_p=1;
  public $huecos_i=1;
  public $huecos_d=1;
  function __construct($id,$id_cotizacion,$distribucion,$perforas_c,$perforas_p,$perforas_i,$perforas_d,
  $huecos_c,$huecos_p,$huecos_i,$huecos_d)
  {
    $this->id=$id;
    $this->id_cotizacion=$id_cotizacion;
    $this->distribucion= $distribucion;
    $this->perforas_c=$perforas_c;
    $this->perforas_p=$perforas_p;
    $this->perforas_i=$perforas_i;
    $this->perforas_d=$perforas_d;
    $this->huecos_c=$huecos_c;
    $this->huecos_p=$huecos_p;
    $this->huecos_i=$huecos_i;
    $this->huecos_d=$huecos_d;
  }
}
 ?>
