<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : OperacionRealizar
* Author            : Mauricio
* Date created      : 2018-11-22
* Purpose           : Datos de las Operaciones a realizar por cotización
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
/**********************************************************************/
class OperacionRealizar{
  public $codigo_operacion = '';
  public $codigo_maquina = '';
  public $cantidad_operaciones=0;
  public $tiempo=0;
  public $costo  = 0;
  function __construct($codigo_operacion, $codigo_maquina, $cantidad_operaciones, $tiempo, $costo)
  {
    $this->codigo_operacion=$codigo_operacion;
    $this->codigo_maquina=$codigo_maquina;
    $this->cantidad_operaciones=$cantidad_operaciones;
    $this->tiempo=$tiempo;
    $this->costo=$costo;
  }
}

 ?>
