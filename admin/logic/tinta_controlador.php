<?php
include '../entidades/tintacotizacion.php';
class TintaControlador {
  public $error = '';
  public $listacolores;
  function __construct(){
    $this->listacolores='';
  }
  public function getError(){
    return $this->$error;
  }
  public function getListaColores(){
    return $this->listacolores;
  }
  public function getLista_Tintas($con, $compania){
    $sel = $con->prepare("SELECT id, descripcion
      FROM tinta_tipo WHERE id_compania =? ");
    $sel->bind_param("s", $compania);
    $sel->execute();
    $sel->bind_result($id_tinta, $descripcion_tinta);
    $arrtintas = array();
    while ($sel->fetch()) {
      $arrtintas[]= array($id_tinta, $descripcion_tinta);//($arrtintas, $id_tinta,$descripcion_tinta);
    }
    $sel->close();
    return $arrtintas;
  }
  public function getTipo_Tinta($con, $id){
    $compania = $_SESSION ['compania'];
    $sel = $con->prepare("SELECT descripcion FROM tinta_tipo WHERE id = ? ");
    $sel->bind_param('i', $id);
    $sel->execute();
    $sel->bind_result($descripcion);
    if($sel->fetch()){
      return $descripcion;
    }
    else {
      return '';
    }
  }
  public function insTinta_Cotizacion($con, $arrcolores, $compania, $id){
    try {
      $inserto= false;
      $del =$con ->prepare('DELETE FROM cotizacion_tinta WHERE id_compania =? AND id_cotizacion = ? ');
      $del -> bind_param('si', $compania, $id);
      $del -> execute();
      $del -> close();
      foreach (explode("*;*", $arrcolores) as $key => $value) {
        $variable= array();
        $variable[] = $compania;
        $variable[] = $id;
        foreach (explode("*,*", $value) as $subkey => $subvalue) {
          $variable[] = $subvalue;
          }

        $ins_cot_desc = $con->prepare("INSERT INTO cotizacion_tinta(id_compania, id_cotizacion, color, lado, tipo_tinta, alto, ancho, num_tirajes) VALUES (?,?,?,?,?,?,?,?)");
        $ins_cot_desc -> bind_param('sisiiddi', $variable[0], $variable[1], $variable[2], $variable[3], $variable[4], $variable[5], $variable[6], $variable[7]);
        if($ins_cot_desc -> execute())
        {
          $inserto= true;
        }
        $ins_cot_desc ->close();
      }
      return $inserto;
    } catch (\Exception $e) {
        throw new \Exception("Error Processing Request".$e, 1);

    }
  }
  public function getLista_Tintas_Cotizacion($con, $compania, $cotizacion){
    //$tintacotizacion = new TintaCotizacion();
    $sel = $con->prepare("SELECT id, id_cotizacion, color, tipo_tinta,
       num_tirajes, alto, ancho, lado FROM cotizacion_tinta WHERE id_compania =? AND id_cotizacion = ? ");
    $sel->bind_param("si", $compania, $cotizacion);
    $sel->execute();
    $sel->bind_result($id, $id_cotizacion, $color, $tipo_tinta,
       $num_tirajes, $alto, $ancho, $lado);
    $arrtintas_cotizacion = array();
    while ($sel->fetch()) {
      $tintacotizacion = new TintaCotizacion($id, $id_cotizacion, $color, $tipo_tinta,
         $num_tirajes, $alto, $ancho, $lado);
      $arrtintas_cotizacion[]= $tintacotizacion;//($arrtintas, $id_tinta,$descripcion_tinta);
      $this->listacolores = $this->listacolores==''?$color.'*,*'.$lado.'*,*'.$tipo_tinta.'*,*'.$alto.'*,*'.$ancho.'*,*'.$lado:
      $this->listacolores.'*;*'.$color.'*,*'.$lado.'*,*'.$tipo_tinta.'*,*'.$alto.'*,*'.$ancho.'*,*'.$lado;
    }
    $sel->close();
    return $arrtintas_cotizacion;
  }
}
?>
