<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : ExtraControlador
* Author            : Mauricio
* Date created      : 2018-09-17
* Purpose           : Manipular los datos de los materiales extras por
                      cotización entre la vista y la DB
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
***********************************************************************/
include '../entidades/extracotizacion.php';
class ExtraControlador {
  public $error = '';
  public $listaextras;
  function __construct(){
    $this->listaextras='';
  }
  public function getError(){
    return $this->$error;
  }
  public function getListaExtras(){
    return $this->listaextras;
  }
  public function insExtra_Cotizacion($con, $arrextras, $compania, $id){
    try {
      $inserto= false;
      $del =$con ->prepare('DELETE FROM cotizacion_extra WHERE id_compania =? AND id_cotizacion = ? ');
      $del -> bind_param('si', $compania, $id);
      $del -> execute();
      $del -> close();
      foreach (explode("*;*", $arrextras) as $key => $value) {
        $variable= array();
        $variable[] = $compania;
        $variable[] = $id;
        foreach (explode("*,*", $value) as $subkey => $subvalue) {
          $variable[] = $subvalue;
          }
            //throw new Exception("\nValor: ".$variable[2], 1);
        $ins_cot_extr = $con->prepare("INSERT INTO cotizacion_extra (id_compania, id_cotizacion, descripcion,cantidad) VALUES (?,?,?,?)");
        $ins_cot_extr -> bind_param('sisi', $variable[0], $variable[1], $variable[2], $variable[3]);
        if($ins_cot_extr -> execute())
        {
          $inserto= true;
        }
        if ($ins_cot_extr->error!=''){
          $this->error= $ins_cot_extr->error;
          throw new Exception("Error Processing Request: ".$ins_cot_extr->error, 1);
        }
        $ins_cot_extr ->close();
      }

      return $inserto;
    } catch (\Exception $e) {
        throw new \Exception("Error Processing Request".$e, 1);

    }
  }
  public function getLista_Extras_Cotizacion($con, $compania, $cotizacion){
    $sel = $con->prepare("SELECT id, id_cotizacion, descripcion, cantidad FROM cotizacion_extra WHERE id_compania =? AND id_cotizacion = ? ");
    $sel->bind_param("si", $compania, $cotizacion);
    $sel->execute();
    $sel->bind_result($id, $id_cotizacion, $descripcion, $cantidad);
    $arrextras_cotizacion = array();
    while ($sel->fetch()) {
      $extracotizacion = new ExtraCotizacion($id, $id_cotizacion, $descripcion, $cantidad);
      $arrextras_cotizacion[]= $extracotizacion;
      $this->listaextras = $this->listaextras==''?$descripcion.'*,*'.$cantidad:
      $this->listaextras.'*;*'.$descripcion.'*,*'.$cantidad;
    }
    $sel->close();
    return $arrextras_cotizacion;
  }
}
?>
