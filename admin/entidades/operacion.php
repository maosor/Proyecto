<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : Operacion
* Author            : Mauricio
* Date created      : 2018-11-20
* Purpose           : Datos de las Operaciones
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
/**********************************************************************/
class Operacion{
  public $id = 0;
  public $codigo='';
  public $descripcion='';
  public $id_maquina=0;
  public $tipo_operacion=0;
  public $subtipo_operacion=0;
  public $tiempo_parametro=0;
  public $carga_acumulada=0;
  public $costoxcentesima=0;
  public $no_paso_ejecucion=0;
  public $es_resta_automatica	='';
  function __construct($id,$codigo,$descripcion,$id_maquina,$tipo_operacion, $subtipo_operacion, $tiempo_parametro, $carga_acumulada, $costoxcentesima,
    $no_paso_ejecucion, $es_resta_automatica)
  {
    $this->id=$id;
    $this->codigo= $codigo;
    $this->id = $id;
    $this->codigo=$codigo;
    $this->descripcion=$descripcion;
    $this->id_maquina=$id_maquina;
    $this->tipo_operacion=$tipo_operacion;
    $this->subtipo_operacion=$subtipo_operacion;
    $this->tiempo_parametro=$tiempo_parametro;
    $this->carga_acumulada=$carga_acumulada;
    $this->costoxcentesima=$costoxcentesima;
    $this->no_paso_ejecucion=$no_paso_ejecucion;
    $this->es_resta_automatica=$es_resta_automatica;
  }

}

 ?>
