<?php
class MaquinaCotizacion{
	  public $id=0;
	  public $id_cotizacion=0;
	  public $papeles_numero_hojas= 0;
	  public $papeles_numero_copias	=0;
	  public $numero_tintas_montajes=0
	  public $numero_tintas_lavados=0;
	  public $papeles_numero_moldes=0;
	  public $numero_mascaras=0;
	  public $numero_planchas=0;
	  public $numero_quemados=0;
	  public $numero_med_cortes=0;
	  public $numero_tiros_troquel=0;		
	  public $cobra_planchas=false;  
	  public $troquelado=false;  
	  public $impresion=false;  
	  public $escaja=false;  
  function __construct($id,$id_cotizacion,$papeles_numero_hojas, $papeles_numero_copias,$numero_tintas_montajes,$numero_tintas_lavados,$papeles_numero_moldes,$numero_mascaras,
	$numero_planchas,$numero_quemados,$numero_med_cortes,$numero_tiros_troquel,$cobra_planchas,$troquelado,$impresion,$escaja )
  {	
	$this->id=$id;
	$this->id_cotizacion=$id_cotizacion;
	$this->papeles_numero_hojas= $papeles_numero_hojas;
	$this->papeles_numero_copias=$papeles_numero_copias;
	$this->numero_tintas_montajes=$numero_tintas_montajes;
	$this->numero_tintas_lavados=$numero_tintas_lavados;
	$this->papeles_numero_moldes=$papeles_numero_moldes;
	$this->numero_mascaras=$numero_mascaras;
	$this->numero_planchas=$numero_planchas;
	$this->numero_quemados=$numero_quemados;
	$this->numero_med_cortes=$numero_med_cortes;
	$this->numero_tiros_troquel=$numero_tiros_troquel;		
	$this->cobra_planchas=$cobra_planchas;  
	$this->troquelado=$troquelado;  
	$this->impresion=$impresion;  
	$this->escaja=$escaja;  
  }
}
 ?>