<?php
/**
 ***********************************************************
 *AUTOR: Mauricio.
 *Fecha Creación: 2018-08-01
 */
class MaquinaControlador
{
  public $error = '';
  public function getError(){
    return $this->$error;
  }
  public function getLista_Maquina($con, $compania){
    $sel = $con->prepare('SELECT id, codigo, nombre_maquina FROM maquina WHERE id_compania = ? ');
    $sel->bind_param("s", $compania);
    $sel->execute();
    $sel->bind_result($id, $codigo, $nombre_maquina);
    $arrmaquina = array();
    while ($sel->fetch()) {
      $arrmaquina[]= array($id, $codigo, $nombre_maquina);//($arrtintas, $id_tinta,$descripcion_tinta);
    }
    $sel->close();
    return $arrmaquina;
  }
  public function insMaquina_Cotizacion($con, $arrmaquina, $compania, $id){
    try {
      $inserto= false;
      $del =$con ->prepare('DELETE FROM cotizacion_maquina WHERE id_compania =? AND id_cotizacion = ? ');
      $del -> bind_param('si', $compania, $id);
      $del -> execute();
      $del -> close();
      foreach (explode("*;*", $arrmaquina) as $key => $value) {
        $variable= array();
        $variable[] = $compania;
        $variable[] = $id;
        foreach (explode("*,*", $value) as $subkey => $subvalue) {
          $variable[] = $subvalue;
          }

        $ins_cot_maq = $con->prepare("INSERT INTO cotizacion_maquina(id_compania, id_cotizacion, maquina, papeles_numero_hojas, papeles_numero_copias,
            numero_tintas_montajes, numero_tintas_lavados, papeles_numero_moldes, numero_mascaras, numero_planchas,
            numero_quemados, numero_med_cortes, numero_tiros_troquel, cobra_planchas, troquelado, impresion, es_caja)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $ins_cot_maq -> bind_param('iiiiiiiiiiiiiiiii', $variable[0], $variable[1], $variable[2], $variable[3], $variable[4], $variable[5], $variable[6], $variable[7],
      $variable[8], $variable[9], $variable[10], $variable[11], $variable[12], $variable[13], $variable[14], $variable[15], $variable[16]);
        if($ins_cot_maq -> execute())
        {
          $inserto= true;
        }
        if ($ins_cot_maq->error!=''){
          $this->error= $ins_cot_desc->error;
        }
        $ins_cot_maq ->close();
      }
      return $inserto;
    } catch (\Exception $e) {
        throw new \Exception("Error Processing Request".$e, 1);

    }
  }
}

 ?>
