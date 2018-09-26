<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : ExtraCotizacion
* Author            : Mauricio
* Date created      : 2018-09-17
* Purpose           : Datos de materiales extras por cotización
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
/**********************************************************************/
class ExtraCotizacion{
  public $id=0;
  public $id_cotizacion=0;
  public $descripcion= '';
  public $cantidad=0;
  function __construct($id,$id_cotizacion,$descripcion,$cantidad)
  {
    $this->id=$id;
    $this->id_cotizacion=$id_cotizacion;
    $this->descripcion=$descripcion;
    $this->cantidad=$cantidad;
  }
}
 ?>
