<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : OperacionCotizacion
* Author            : Mauricio
* Date created      : 2018-09-24
* Purpose           : Datos de las Operaciones extras por cotización
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
/**********************************************************************/
class OperacionCotizacion{
  public $id_cotizacion = 0;
  public $id = 0;
  public $codigo='';
  public $descripcion='';
  public $costoxcentesima  = 0;
  function __construct($id_cotizacion,$id,$codigo,$descripcion,$costoxcentesima)
  {
    $this->id_cotizacion=$id_cotizacion;
    $this->id=$id;
    $this->codigo= $codigo;
    $this->descripcion=$descripcion;
    $this->costoxcentesima=$costoxcentesima;
  }
}

 ?>
