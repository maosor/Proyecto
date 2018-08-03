<?php
class InventarioControlador
{
  public function getLista_Inventario($con, $compania, $tipo){
    $sel = $con->prepare('SELECT id, codigo, descripcion FROM inventario WHERE id_compania = ? AND tipo = ? ');
    $sel->bind_param("si", $compania,$tipo);
    $sel->execute();
    $sel->bind_result($id, $codigo, $descripcion);
    $arrinventario = array();
    while ($sel->fetch()) {
      $arrinventario[]= array($id, $codigo, $descripcion);//($arrtintas, $id_tinta,$descripcion_tinta);
    }
    $sel->close();
    return $arrinventario;
  }
}
 ?>
