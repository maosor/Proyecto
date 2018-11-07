<?php
class InventarioControlador
{
  public function getLista_Inventario($con, $compania, $tipo){
    if ($tipo == 1) {
      $sel = $con->prepare('SELECT i.id, codigo, i.descripcion, ancho, alto FROM inventario i INNER jOIN papel_tamano pt on (SUBSTRING(codigo, 7, 5)= pt.id) WHERE i.id_compania = ? AND tipo = ? ');
      $sel->bind_param("si", $compania,$tipo);
      $sel->execute();
      $sel->bind_result($id, $codigo, $descripcion, $alto, $ancho);
      $arrinventario = array();
      while ($sel->fetch()) {
        $arrinventario[]= array($id, $codigo, $descripcion, $alto, $ancho);//($arrtintas, $id_tinta,$descripcion_tinta);
      }
    }else {
      $sel = $con->prepare('SELECT id, codigo, descripcion FROM inventario WHERE id_compania = ? AND tipo = ? ');
      $sel->bind_param("si", $compania,$tipo);
      $sel->execute();
      $sel->bind_result($id, $codigo, $descripcion);
      $arrinventario = array();
      while ($sel->fetch()) {
        $arrinventario[]= array($id, $codigo, $descripcion);//($arrtintas, $id_tinta,$descripcion_tinta);
      }
    }
    $sel->close();
    return $arrinventario;
  }
}
 ?>
