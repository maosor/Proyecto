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
  include '../conexion/conexion.php';
  $compania = $_SESSION ['compania'];
  $sel = $con->prepare("SELECT descripcion FROM maquina_tipo WHERE id = ? AND id_compania = ? ");
  $sel->bind_param('ii', $tipo, $compania);
  $sel->execute();
  $sel->bind_result($descripcion);
  if($sel->fetch()){
    return $descripcion;
  }
  else {
    return '';
  }
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
function maq($id_maquina)
{
  include '../conexion/conexion.php';
  $compania = $_SESSION ['compania'];
  $sel = $con->prepare("SELECT nombre_maquina FROM maquina WHERE id = ? AND id_compania = ? ");
  $sel->bind_param('ii', $id_maquina, $compania);
  $sel->execute();
  $sel->bind_result($nombre_maquina);
  if($sel->fetch()){
    return $nombre_maquina;
  }
  else {
    return '';
  }
}
function nombre_cliente($id_cliente)
{
  include '../conexion/conexion.php';
  $compania = $_SESSION ['compania'];
  $sel = $con->prepare("SELECT nombre FROM clientes WHERE id = ? AND id_compania = ? ");
  $sel->bind_param('ii', $id_cliente, $compania);
  $sel->execute();
  $sel->bind_result($nombre);
  if($sel->fetch()){
    return $nombre;
  }
  else {
    return '';
  }
}
function enum_description($id_enum)
{
  include '../conexion/conexion.php';
  $compania = $_SESSION ['compania'];
  $sel = $con->prepare("SELECT descripcion FROM enumerado WHERE id = ? AND id_compania = ? ");
  $sel->bind_param('ii', $id_enum, $compania);
  $sel->execute();
  $sel->bind_result($nombre);
  if($sel->fetch()){
    return $nombre;
  }
  else {
    return '';
  }
}
function tipo_ope($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_ope = 'PRENSA';
      break;
    case '2':
      $tipo_ope = 'PRE-PRENSAS';
      break;
    case '3':
      $tipo_ope = 'ACABADOS';
      break;
    case '4':
      $tipo_ope = 'OTRAS';
      break;
    case '5':
      $tipo_ope = 'EXTRAS';
      break;
  }
  return $tipo_ope;
}
function subtipo_ope($tipo)
{
  switch ($tipo) {
    case '1':
      $subtipo_ope = 'PRODUCTIVA';
      break;
    case '2':
      $subtipo_ope = 'IMPRODUCTIVA EVITABLE';
      break;
    case '2':
      $subtipo_ope = 'IMPRODUCTIVA NO EVITABLE';
      break;
  }
  return $subtipo_ope;
}
function chequeado($valor)
{
  $chequeado = '';
  if($valor==1)
  {
    $chequeado = 'checked';
  }
  return $chequeado;
}
function valor($chequeado)
{
  $valor = 0;
  if ($chequeado == 'on')
  {
      $valor = 1;
  }
  return $valor;
}
function tipo_enum($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_enum = 'AGENCIA';
      break;
    case '2':
      $tipo_enum = 'TRABAJO';
      break;
  }
  return $tipo_enum;
}
 ?>
