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
function cod_cliente($id_cliente)
{
  include '../conexion/conexion.php';
  $compania = $_SESSION ['compania'];
  $sel = $con->prepare("SELECT codigo FROM clientes WHERE id = ? AND id_compania = ? ");
  $sel->bind_param('ii', $id_cliente, $compania);
  $sel->execute();
  $sel->bind_result($codigo);
  if($sel->fetch()){
    return $codigo;
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
    case '3':
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
function estado_cotizacion($estado)
{
  switch ($estado) {
    case '0':
      $estado_cotizacion = 'COTIZADO';
      break;
    case '1':
      $estado_cotizacion = 'APROBADO';
      break;
    case '2':
      $estado_cotizacion = 'LIQUIDADO';
      break;
    case '50':
      $estado_cotizacion = 'ANULADO';
      break;
    default:
      $estado_cotizacion = '';
      break;
  }
  return $estado_cotizacion;
}
  function btn_estado_cotizacion($estado)
  {
    switch ($estado) {
      case '1':
        $btn_estado_cotizacion = 'APROBAR';
        break;
      case '2':
        $btn_estado_cotizacion = 'LIQUIDAR';
        break;
      default:
        $btn_estado_cotizacion = '';
        break;
    }
  return $btn_estado_cotizacion;
}
function orden_trabajo($id)
{
  include '../conexion/conexion.php';
  try {
    $resultado= false;
    $con-> begin_transaction();
    $sel = $con->prepare("SELECT valor FROM compania_parametro WHERE llave = 'proxima_orden'");
    $sel -> execute();
    $sel -> bind_result($valor);
    if($sel->fetch())
    {
      $orden_trabajo = intval($valor);
    }
    $sel ->close();
    $compania = $_SESSION ['compania'];
    $up = $con->prepare('UPDATE cotizacion SET orden_trabajo=? WHERE id=? AND id_compania=? ');
    $up->bind_param("iii",$orden_trabajo, $id, $compania );
    if ($up->execute()) {
        $up->close();
        $up = $con->prepare("UPDATE compania_parametro SET valor=? WHERE llave = 'proxima_orden' ");
        $up -> bind_param('s', strval($orden_trabajo+1));
        $up -> execute();
        $up ->close();
        $resultado = true;
    }
  }catch (Exception $e) {
    $resultado = false;
    $log -> Error($e);
  }
  $con->commit();
  $up->close();
  return $resultado;
}
//Funciones combos
function lados_imprimir($tipo)
{
  switch ($tipo) {
    case '1':
      $lados_imprimir = 'UN LADO';
      break;
    case '2':
      $lados_imprimir = 'FRENTE Y REVERSO';
      break;
    case '3':
      $lados_imprimir = 'TIRO Y RETIRO';
      break;
  }
  return $lados_imprimir;
}
function modo_retiro($tipo)
{
  switch ($tipo) {
    case '1':
      $modo_retiro = 'CABEZA CON CABEZA';
      break;
    case '2':
      $modo_retiro = 'CABEZA CON PIE';
      break;
  }
  return $modo_retiro;
}
function estado($tipo)
{
  switch ($tipo) {
    case '1':
      $estado = 'BUENO';
      break;
    case '2':
      $estado = 'REGULAR';
      break;
    case '3':
      $estado = 'MALO';
      break;
  }
  return $estado;
}
function medio_corte($tipo)
{
  switch ($tipo) {
    case '1':
      $medio_corte = 'FRENTE';
      break;
    case '2':
      $medio_corte = 'REVERSO';
      break;
  }
  return $medio_corte;
}
function tipo_tinta($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_tinta = 'UN LADO';
      break;
    case '2':
      $tipo_tinta = 'FRENTE Y REVERSO';
      break;
    case '3':
      $tipo_tinta = 'TIRO Y RETIRO';
      break;
  }
  return $tipo_tinta;
}
function tipo_negativo($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_negativo = 'NEGATIVO';
      break;
    case '2':
      $tipo_negativo= 'ACETATO LECHOSO';
      break;
    case '3':
      $tipo_negativo= 'ACETATO TRANPARENTE';
      break;
  }
  return $tipo_negativo;
}
function operacion_estado($estado)
{
  switch ($estado) {
    case '0':
      $operacion_estado = '';
      break;
    case '1':
      $operacion_estado= 'INICIADA';
      break;
    case '2':
      $operacion_estado= 'PAUSADA';
      break;
    case '3':
      $operacion_estado= 'FINALIZADA';
      break;
  }
  return $operacion_estado;
}

 ?>
