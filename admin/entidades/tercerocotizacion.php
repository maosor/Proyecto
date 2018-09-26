<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : TerceroCotizacion
* Author            : Mauricio
* Date created      : 2018-09-14
* Purpose           : Datos de los servicios de terceros por cotización
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
/**********************************************************************/
class TerceroCotizacion{
  public $id=0;
  public $id_cotizacion=0;
  public $descripcion= '';
  public $monto=0;
  function __construct($id,$id_cotizacion,$descripcion,$monto)
  {
    $this->id=$id;
    $this->id_cotizacion=$id_cotizacion;
    $this->descripcion=$descripcion;
    $this->monto=$monto;
  }
}
 ?>
