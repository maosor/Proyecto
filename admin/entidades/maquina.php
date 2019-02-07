<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : Maquina
* Author            : Mauricio
* Date created      : 2018-11-22
* Purpose           : Datos de las Maquinas
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
/**********************************************************************/
class Maquina{
  public $id = 0;
  public $codigo='';
  public $nombre_maquina='';
  public $tipo=0;
  public $operarios=0;
  public $maximo_alto=0;
  public $maximo_ancho=0;
  public $minimo_alto=0;
  public $minimo_ancho=0;
  public $cod_plancha_o_mascara	='';
  function __construct($id, $codigo, $nombre_maquina, $tipo, $operarios, $maximo_alto, $maximo_ancho,
                        $minimo_alto, $minimo_ancho, $cod_plancha_o_mascara)
  {
    $this->id=$id;
    $this->codigo= $codigo;
    $this->nombre_maquina=$nombre_maquina;
    $this->tipo=$tipo;
    $this->operarios=$operarios;
    $this->maximo_alto=$maximo_alto;
    $this->maximo_ancho=$maximo_ancho;
    $this->minimo_alto=$minimo_alto;
    $this->minimo_ancho=$minimo_ancho;
    $this->cod_plancha_o_mascara=$cod_plancha_o_mascara;
  }

}

 ?>
