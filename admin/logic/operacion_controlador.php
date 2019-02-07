<?php
/**********************************************************************
* Project           : SAIL
* Class Name        : OperacionControlador
* Author            : Mauricio
* Date created      : 2018-09-14
* Purpose           : Manipular los datos de las operaciones por
                      cotización entre la vista y la DB
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
***********************************************************************/
include '../entidades/operacioncotizacion.php';
include '../entidades/operacion.php';
class OperacionControlador {
  public $error = '';
  public $listaoperaciones;
  function __construct(){
    $this->listaoperaciones='';
  }
  public function getError(){
    return $this->$error;
  }
  public function getListaOperaciones(){
    return $this->listaoperaciones;
  }
  public function insOperacion_Cotizacion($con, $arroperaciones, $compania, $id){
    try {
      $inserto= false;
      $del =$con ->prepare('DELETE FROM cotizacion_operacion WHERE id_compania =? AND id_cotizacion = ? ');
      $del -> bind_param('si', $compania, $id);
      $del -> execute();
      $del -> close();
      foreach (explode("*;*", $arroperaciones) as $key => $value) {
        $variable= array();
        $variable[] = $compania;
        $variable[] = $id;
        foreach (explode("*,*", $value) as $subkey => $subvalue) {
          $variable[] = $subvalue;
          }
            //throw new Exception("\nValor: ".$variable[2], 1);
        $ins_cot_ope = $con->prepare("INSERT INTO cotizacion_operacion (id_compania, id_cotizacion, codigo, descripcion,costoxcentesima) VALUES (?,?,?,?,?)");
        $ins_cot_ope -> bind_param('sissi', $variable[0], $variable[1], $variable[2], $variable[3], $variable[4]);
        if($ins_cot_ope -> execute())
        {
          $inserto= true;
        }
        if ($ins_cot_ope->error!=''){
          $this->error= $ins_cot_ope->error;
          throw new Exception("Error Processing Request: ".$ins_cot_ope->error, 1);
        }
        $ins_cot_ope ->close();
      }

      return $inserto;
    } catch (\Exception $e) {
        throw new \Exception("Error Processing Request".$e, 1);

    }
  }
  public function getLista_Operaciones_Cotizacion($con, $compania, $cotizacion){
    $sel = $con->prepare("SELECT id, id_cotizacion, codigo, descripcion,costoxcentesima,id_maquina FROM cotizacion_operacion WHERE id_compania =? AND id_cotizacion = ? ");
    $sel->bind_param("si", $compania, $cotizacion);
    $sel->execute();
    $sel->bind_result($id, $id_cotizacion, $codigo, $descripcion,$costoxcentesima,$id_maquina);
    $arroperaciones_cotizacion = array();
    while ($sel->fetch()) {
      $operacioncotizacion = new OperacionCotizacion($id, $id_cotizacion, $codigo, $descripcion,$costoxcentesima,$id_maquina);
      $arroperaciones_cotizacion[]= $operacioncotizacion;
      $this->listaoperaciones = $this->listaoperaciones==''?$codigo.'*,*'.$descripcion.'*,*'.$costoxcentesima.'*,*'.$id_maquina:
      $this->listaoperaciones.'*;*'.$codigo.'*,*'.$descripcion.'*,*'.$costoxcentesima.'*,*'.$id_maquina;
    }
    $sel->close();
    return $arroperaciones_cotizacion;
  }
  public function getLista_Operaciones($con, $compania, $tipo){
    $sel = $con->prepare('SELECT id, codigo, descripcion, costoxcentesima FROM operacion WHERE id_compania = ? AND tipo_operacion = ? ');
    $sel->bind_param("si", $compania,$tipo);
    $sel->execute();
    $sel->bind_result($id, $codigo, $descripcion,$costoxcentesima);
    $arroperaciones = array();
    while ($sel->fetch()) {
      $arroperaciones[]= array($id, $codigo, $descripcion, $costoxcentesima);//($arrtintas, $id_tinta,$descripcion_tinta);
    }
    $sel->close();
    return $arroperaciones;
  }
  public function Buscar_Operacion($con, $cod_ope, $id_maq) {
    $sel = $con->prepare('SELECT id, codigo, descripcion, id_maquina, tipo_operacion, subtipo_operacion, tiempo_parametro, carga_acumulada,
      costoxcentesima, no_paso_ejecucion, es_resta_automatica FROM operacion WHERE codigo =? AND id_maquina =?');
    $sel->bind_param("si", $cod_ope,$id_maq);
    $sel->execute();
    $resultado = $sel->store_result();
    $sel->bind_result($id, $codigo, $descripcion, $id_maquina, $tipo_operacion, $subtipo_operacion, $tiempo_parametro, $carga_acumulada,
      $costoxcentesima, $no_paso_ejecucion, $es_resta_automatica);
    $arroperaciones = array();
    if ($sel->fetch()) {
      return new Operacion($id, $codigo, $descripcion, $id_maquina, $tipo_operacion, $subtipo_operacion, $tiempo_parametro, $carga_acumulada,
        $costoxcentesima, $no_paso_ejecucion, $es_resta_automatica) ;
    }
    $sel->close();
    return $sel;
  }
  public function delOperacion_Realizar($con, $compania, $id)
  {
    $del =$con ->prepare('DELETE FROM cotizacion_operacion_realizar WHERE id_compania =? AND id_cotizacion = ? ');
    $del -> bind_param('si', $compania, $id);
    $del -> execute();
    $del -> close();
    return $del;
  }

  public function insOperacion_Realizar($con, $ope_rea, $compania, $id){
    try {
      $inserto= false;
      // $del =$con ->prepare('DELETE FROM cotizacion_operacion_realizar WHERE id_compania =? AND id_cotizacion = ? AND codigo_operacion = ?');
      // $del -> bind_param('sis', $compania, $id,$ope_rea->codigo_operacion);
      // $del -> execute();
      // $del -> close();
       $ins_ope_rea = $con->prepare("INSERT INTO cotizacion_operacion_realizar(id_compania, id_cotizacion, codigo_operacion,
       codigo_maquina, cantidad_operaciones, tiempo, costo) VALUES (?,?,?,?,?,?,?)");
        $ins_ope_rea -> bind_param('sissiii', $compania,$id, $ope_rea->codigo_operacion, $ope_rea->codigo_maquina, $ope_rea->cantidad_operaciones,
       $ope_rea->tiempo,$ope_rea->costo);
        if($ins_ope_rea -> execute())
        {
          $inserto= true;
        }
        if ($ins_ope_rea->error!=''){
          $this->error= $ins_ope_rea->error;
          throw new Exception("Error Processing Request: ".$ins_ope_rea->error, 1);
        }
        $ins_ope_rea ->close();
        return $inserto;
      } catch (\Exception $e) {
          throw new \Exception("Error Processing Request".$e, 1);

      }
  }

}
?>
