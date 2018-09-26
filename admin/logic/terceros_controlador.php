<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : TercerosControlador
* Author            : Mauricio
* Date created      : 2018-09-14
* Purpose           : Manipular los datos de los servicios de terceros por
                      cotización entre la vista y la DB
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
***********************************************************************/
include '../entidades/tercerocotizacion.php';
class TercerosControlador {
  public $error = '';
  public $listaterceros;
  function __construct(){
    $this->listaterceros='';
  }
  public function getError(){
    return $this->$error;
  }
  public function getListaterceros(){
    return $this->listaterceros;
  }
  public function insTercero_Cotizacion($con, $arrterceros, $compania, $id){
    try {
      $inserto= false;
      $del =$con ->prepare('DELETE FROM cotizacion_tercero WHERE id_compania =? AND id_cotizacion = ? ');
      $del -> bind_param('si', $compania, $id);
      $del -> execute();
      $del -> close();
      foreach (explode("*;*", $arrterceros) as $key => $value) {
        $variable= array();
        $variable[] = $compania;
        $variable[] = $id;
        foreach (explode("*,*", $value) as $subkey => $subvalue) {
          $variable[] = $subvalue;
          }
            //throw new Exception("\nValor: ".$variable[2], 1);
        $ins_cot_terc = $con->prepare("INSERT INTO cotizacion_tercero (id_compania, id_cotizacion, descripcion,monto) VALUES (?,?,?,?)");
        $ins_cot_terc -> bind_param('sisi', $variable[0], $variable[1], $variable[2], $variable[3]);
        if($ins_cot_terc -> execute())
        {
          $inserto= true;
        }
        if ($ins_cot_terc->error!=''){
          $this->error= $ins_cot_terc->error;
          throw new Exception("Error Processing Request: ".$ins_cot_terc->error, 1);
        }
        $ins_cot_terc ->close();
      }

      return $inserto;
    } catch (\Exception $e) {
        throw new \Exception("Error Processing Request".$e, 1);

    }
  }
  public function getLista_terceros_Cotizacion($con, $compania, $cotizacion){
    $sel = $con->prepare("SELECT id, id_cotizacion, descripcion, monto FROM cotizacion_tercero WHERE id_compania =? AND id_cotizacion = ? ");
    $sel->bind_param("si", $compania, $cotizacion);
    $sel->execute();
    $sel->bind_result($id, $id_cotizacion, $descripcion, $monto);
    $arrterceros_cotizacion = array();
    while ($sel->fetch()) {
      $tercerocotizacion = new TerceroCotizacion($id, $id_cotizacion, $descripcion, $monto);
      $arrterceros_cotizacion[]= $tercerocotizacion;
      $this->listaterceros = $this->listaterceros==''?$descripcion.'*,*'.$monto:
      $this->listaterceros.'*;*'.$descripcion.'*,*'.$monto;
    }
    $sel->close();
    return $arrterceros_cotizacion;
  }
}
?>
