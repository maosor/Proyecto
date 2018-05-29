<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}
$id= '';
$compania = $_SESSION['compania'];
$recibido = $_SESSION['id_usuario'];
$con-> begin_transaction();
$sel = $con->prepare("SELECT valor FROM compania_parametro WHERE llave = 'proxima_cotizacion'");
$sel -> execute();
$sel -> bind_result($valor);
if($sel->fetch())
{
  $cotizacion = intval($valor);
}

$sel ->close();
$ins = $con->prepare("INSERT INTO cotizacion (id_compania, id, cotizacion, fecha_pedido, id_cliente,
 referencia, id_trabajo, recibido, sobre_tecnico, negativo, plancha, recurso,
 libros_articulos, hojas, copias, inicio, final) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$ins->bind_param("iiisiiiiiiiiiiiii", $compania, $id, $cotizacion, $fecha_pedido, $id_cliente,
 $referencia, $id_trabajo, $recibido, $sobre_tecnico, $negativo, $plancha, $recurso,
 $libros_articulos, $hojas, $copias, $inicio, $final);
if ($ins->execute()) {
  $up = $con->prepare("UPDATE compania_parametro SET valor=? WHERE llave = 'proxima_cotizacion' ");
  $up -> bind_param('s', strval($cotizacion+1));
  $up -> execute();
  $up ->close();
  $log->info('Guardó cotización #'.$cotizacion);
  header('location:../extend/alerta.php?msj=Guardó cotización&c=cot&p=in&t=success');
}else {
  $log->error('Error guardando cotización: '.$ins->error);
  header('location:../extend/alerta.php?msj=No guardó la cotización&c=cot&p=in&t=error');
}
$con->commit();
$ins ->close();
$con ->close();
}else {
  $log->error('Error intentando ingresar sin formulario desde: '.gethostbyname(trim(`hostname`)));
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cot&p=in&t=error');
}
 ?>
