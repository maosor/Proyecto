<?php
/**
 ***********************************************************
 *AUTOR: Mauricio.
 *Fecha Creación: 2018-08-01
 */
class MaquinaControlador
{
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
}

 ?>
