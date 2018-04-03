<?php
function tipo_desc($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_desc = 'PAPELES';
      break;
    case '2':
      $tipo_desc = 'SUMINISTROS';
      break;
    case '3':
      $tipo_desc = 'REPUESTOS';
      break;
    case '4':
      $tipo_desc = 'OTROS';
      break;
  }
  return $tipo_desc;
}
function tipo_trans($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_trans = 'ENTRADA';
      break;
    case '2':
      $tipo_trans = 'SALIDA';
      break;
  }
  return $tipo_trans;
}
function tipo_maq($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_trans = 'LITOGRAFIA';
      break;
    case '2':
      $tipo_trans = 'TIPOGRAFIA';
      break;
  }
  return $tipo_trans;
}
function get_saldo($cantidad,$tipo, $id_articulo, $compania)
{
  include '../conexion/conexion.php';
  $sel = $con->prepare("SELECT sum(IF(tipo = 1, cantidad, 0)) as entrada, SUM(IF(tipo = 2, cantidad, 0)) as salida
  FROM inventario_detalle WHERE id_articulo = ? AND id_compania = ? ");
  $sel->bind_param('ii', $id_articulo, $compania);
  $sel->execute();
  $sel->bind_result($entrada, $salida);
  if($sel->fetch())
  {
    if($tipo = 1){
      $saldo = ($entrada - $salida)+$cantidad;

    }else {
      $saldo = ($entrada - $salida)-$cantidad;
    }
  }
  $sel->close();
  return $saldo;
}
 ?>
