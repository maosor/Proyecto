<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : CotizacionCalculos
* Author            : Mauricio
* Date created      : 2018-11-14
* Purpose           : Funciones para realizar los calculos
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
***********************************************************************/
include '../Logic/operacion_controlador.php';
include '../Logic/maquina_controlador.php';
include '../entidades/operacionrealizar.php';
class CotizacionCalculos
{
  const OPERACION_TIRAJE = 'TIR';  //usa máquina
  const OPERACION_LAVADO = 'LAV';  //usa máquina
  const OPERACION_PREPARACION_MAQUINA = 'PMA'; //usa máquina
  const OPERACION_MONTAJE_TROQUEL = 'MTR'; //usa máquina
  const OPERACION_TROQUELADO = 'TRO'; //usa máquina
  const OPERACION_LIMPIEZA_TROQUEL = ""; //usa máquina
  function __construct()
  {

  }
  public function CalcularCostoManoObra($con, $compania, $cotizacion, $nlibros, $nhojas,
   $ncopias)
  {
    $ctroperaciones = new OperacionControlador();
    $ctrmaquinas = new MaquinaControlador();
    $cant_estim_quem_x_metal = 0.0;
    $cant_estim_quem_x_carton = 0.0;
    $costo_tiempo_op_extra = 0.0;
    $costo = 0.0;
    $cLimpieza_troquel =0;
    $cant_estim_quempmetal = 0;
    $lst_operaciones_realizar = array();
    $lst_maquinas = array();
    $ctroperaciones->delOperacion_Realizar($con, $compania, $cotizacion);
    $lst_operaciones_realizar= $ctroperaciones->getLista_Operaciones_Cotizacion($con, $compania, $cotizacion);
    $lst_maquinas= $ctrmaquinas->ListaMaquinasXCotizacion($con, $compania, $cotizacion);
    //return $lst_operaciones_realizar;
    //Calcular operaciones_extras
    foreach ($lst_operaciones_realizar as $op => $operacion) {
      $op = $ctroperaciones->Buscar_Operacion($con,$operacion->codigo,$operacion->id_maquina);
       $costo_tiempo_op_extra+= $op->costoxcentesima * $op->tiempo_parametro;
       $ctroperaciones->insOperacion_Realizar($con, new OperacionRealizar($op->codigo, $operacion->id_maquina, 1,
       $op->tiempo_parametro, $op->costoxcentesima * $op->tiempo_parametro), $compania, $cotizacion);
     }
    // return $lst_maquinas;
    foreach ($lst_maquinas as $maq_cot => $maquina_cotizacion) {
       $maq = $ctrmaquinas->Buscar_Maquina($con,$maquina_cotizacion->maquina);
       $hojasMaquina = $maquina_cotizacion->papeles_numero_hojas;
       $copiasMaquina = $maquina_cotizacion->papeles_numero_copias;
      // return $maquina_cotizacion;
       if ($maquina_cotizacion->impresion) {
         //Costo de Tiraje
         if ($maquina_cotizacion->numero_tiros_impresos > 0) {
           $op = $ctroperaciones->Buscar_Operacion($con,self::OPERACION_TIRAJE,$maquina_cotizacion->maquina);
           if ($op->tiempo_parametro > 0) {
             $tiempo = $maquina_cotizacion->numero_tiros_impresos * $op->tiempo_parametro * $maq->operarios;
             $costo += ($op->costoxcentesima * $tiempo);
             $ctroperaciones->insOperacion_Realizar($con, new OperacionRealizar(self::OPERACION_TIRAJE, $maquina_cotizacion->maquina, $maquina_cotizacion->numero_tiros_impresos,
             $tiempo, $op->costoxcentesima * $tiempo), $compania, $cotizacion);
           }
         }
         //costo lavado
         if ($maquina_cotizacion->numero_tintas_lavados > 0) {
           $op = $ctroperaciones->Buscar_Operacion($con,self::OPERACION_LAVADO,$maquina_cotizacion->maquina);
           if ($op->tiempo_parametro > 0) {
             //return $ctrmaquinas->getCotizacionCheck($con, $compania, $cotizacion, 'prueba_impresora');
             if ($ctrmaquinas->getCotizacionCheck($con, $compania, $cotizacion, 'prueba_impresora')){
               $cant_estim = $maquina_cotizacion->numero_tintas_lavados * 2;
             }else {
               $cant_estim = $maquina_cotizacion->numero_tintas_lavados;
             }
             $tiempo = $cant_estim * $op->tiempo_parametro * $maq->operarios;
             $costo += ($op->costoxcentesima * $tiempo);
             $ctroperaciones->insOperacion_Realizar($con, new OperacionRealizar(self::OPERACION_LAVADO, $maquina_cotizacion->maquina, $maquina_cotizacion->numero_tiros_impresos,
             $tiempo, $op->costoxcentesima * $tiempo), $compania, $cotizacion);
           }
         }
         //Costo de Preparación de Máquina
         if ($maquina_cotizacion->numero_tintas_lavados > 0) {
           $op = $ctroperaciones->Buscar_Operacion($con,self::OPERACION_PREPARACION_MAQUINA,$maquina_cotizacion->maquina);
           if ($op->tiempo_parametro > 0) {
             //return $ctrmaquinas->getCotizacionCheck($con, $compania, $cotizacion, 'prueba_impresora');
             if ($ctrmaquinas->getCotizacionCheck($con, $compania, $cotizacion, 'prueba_impresora')){
               $cant_estim = $maquina_cotizacion->numero_tintas_montajes * 2;
             }else {
               $cant_estim = $maquina_cotizacion->numero_tintas_montajes;
             }
             $tiempo = $cant_estim * $op->tiempo_parametro * $maq->operarios;
             $costo += ($op->costoxcentesima * $tiempo);
             $ctroperaciones->insOperacion_Realizar($con, new OperacionRealizar(self::OPERACION_PREPARACION_MAQUINA, $maquina_cotizacion->maquina, $maquina_cotizacion->numero_tiros_impresos,
             $tiempo, $op->costoxcentesima * $tiempo), $compania, $cotizacion);
           }
           $cant_estim_quempmetal = $cant_estim_quempmetal + $maquina_cotizacion->numero_quemados;
           if ($maquina_cotizacion->cobra_planchas){
             $cant_estim_quempmetal = $numero_planchas;
             }
           }
      }
      if ($maquina_cotizacion->troquelado) {
        //Costo de Montaje de Troquel
        $op = $ctroperaciones->Buscar_Operacion($con,self::OPERACION_MONTAJE_TROQUEL,$maquina_cotizacion->maquina);
        if ($op->tiempo_parametro > 0) {
          $cant_estim = 1;
          $tiempo = $cant_estim * $op->tiempo_parametro * $maq->operarios;
          $costo += ($op->costoxcentesima * $tiempo);
          $ctroperaciones->insOperacion_Realizar($con, new OperacionRealizar(self::OPERACION_MONTAJE_TROQUEL, $maquina_cotizacion->maquina, $maquina_cotizacion->numero_tiros_impresos,
          $cant_estim, $op->costoxcentesima * $tiempo), $compania, $cotizacion);
        }
        if ($op->tiempo_parametro > 0) {
          $tiempo = $maquina_cotizacion->numero_tiros_troquel * $op->tiempo_parametro * $maq->operarios;
          $costo += ($op->costoxcentesima * $tiempo);
          $ctroperaciones->insOperacion_Realizar($con, new OperacionRealizar(self::OPERACION_TROQUELADO, $maquina_cotizacion->maquina, $maquina_cotizacion->numero_tiros_troquel,
          $tiempo, $op->costoxcentesima * $tiempo), $compania, $cotizacion);
        }
        $cLimpieza_troquel += $nlibros;
      }
    }
     return $costo_tiempo_op_extra;

     /*
   Calcular costo de Operaciones extras
   FOR EACH operExtra in OrdenProduccionActual.ListaOperacionesExtras
   BEGIN
     cTiempoOperExtra += operExtra.Tiempo_Estimado;
	 operacion = buscarOperacion(operExtra.Codigo, operExtra.Codigo_Maquina);
	 Costo += operExtra.Tiempo_Estimado * operacion.CostoUnitario;
	 ListaOperacionesARealizar.Insertar(operExtra.Codigo, operExtra.Codigo_Maquina, 1, operExtra.Tiempo_Estimado, operExtra.Tiempo_Estimado * CostoUnit)
   END


   menorCantidadMoldes := 100;*/
  }
}


 ?>
