<?php
include '../entidades/distribucioncotizacion.php';
class DistribucionControlador {
  public $error = '';
  public $listadistribuciones;
  function __construct(){
    $this->listadistribuciones='';
  }
  public function getError(){
    return $this->$error;
  }
  public function getListaDistribuciones(){
    return $this->listadistribuciones;
  }
  public function insDistribucion_Cotizacion($con, $arrdistribuciones, $compania, $id){
    try {
      $inserto= false;
      $del =$con ->prepare('DELETE FROM cotizacion_distribucion WHERE id_compania =? AND id_cotizacion = ? ');
      $del -> bind_param('si', $compania, $id);
      $del -> execute();
      $del -> close();
      foreach (explode("*;*", $arrdistribuciones) as $key => $value) {
        $variable= array();
        $variable[] = $compania;
        $variable[] = $id;
        foreach (explode("*,*", $value) as $subkey => $subvalue) {
          $variable[] = $subvalue;
          }
            //throw new Exception("\nValor: ".$variable[2], 1);
        $ins_cot_dist = $con->prepare("INSERT INTO cotizacion_distribucion (id_compania, id_cotizacion, distribucion, perforas_c, perforas_p, perforas_i, perforas_d, huecos_c, huecos_p, huecos_i, huecos_d) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $ins_cot_dist -> bind_param('sisiiiiiiii', $variable[0], $variable[1], $variable[2], $variable[3], $variable[4], $variable[5], $variable[6], $variable[7], $variable[8], $variable[9], $variable[10]);
        if($ins_cot_dist -> execute())
        {
          $inserto= true;
        }
        if ($ins_cot_dist->error!=''){
          $this->error= $ins_cot_dist->error;
          throw new Exception("Error Processing Request: ".$ins_cot_dist->error, 1);
        }
        $ins_cot_dist ->close();
      }

      return $inserto;
    } catch (\Exception $e) {
        throw new \Exception("Error Processing Request".$e, 1);

    }
  }
  public function getLista_Distribuciones_Cotizacion($con, $compania, $cotizacion){
    $sel = $con->prepare("SELECT id, id_cotizacion, distribucion,
       perforas_c, perforas_p, perforas_i, perforas_d, huecos_c, huecos_p, huecos_i, huecos_d FROM cotizacion_distribucion WHERE id_compania =? AND id_cotizacion = ? ");
    $sel->bind_param("si", $compania, $cotizacion);
    $sel->execute();
    $sel->bind_result($id, $id_cotizacion, $distribucion,
       $perforas_c, $perforas_p, $perforas_i, $perforas_d, $huecos_c, $huecos_p, $huecos_i, $huecos_d);
    $arrdistribuciones_cotizacion = array();
    while ($sel->fetch()) {
      $distribucioncotizacion = new DistribucionCotizacion($id, $id_cotizacion, $distribucion,
         $perforas_c, $perforas_p, $perforas_i, $perforas_d, $huecos_c, $huecos_p, $huecos_i, $huecos_d);
      $arrdistribuciones_cotizacion[]= $distribucioncotizacion;
      $this->listadistribuciones = $this->listadistribuciones==''?$distribucion.'*,*'.$perforas_c.'*,*'.$perforas_p.'*,*'.$perforas_i.'*,*'.$perforas_d.'*,*'.$huecos_c.'*,*'.$huecos_p.'*,*'.$huecos_i.'*,*'.$huecos_d:
      $this->listadistribuciones.'*;*'.$distribucion.'*,*'.$perforas_c.'*,*'.$perforas_p.'*,*'.$perforas_i.'*,*'.$perforas_d.'*,*'.$huecos_c.'*,*'.$huecos_p.'*,*'.$huecos_i.'*,*'.$huecos_d;
    }
    $sel->close();
    return $arrdistribuciones_cotizacion;
  }
}
?>
