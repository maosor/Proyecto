<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$estado = htmlentities($_GET['estado']);
$up = $con->prepare("UPDATE cotizacion_operacion_realizar SET estado=? WHERE id=? ");
$up -> bind_param('ii', $estado, $id);
if ($up -> execute()) {
  header('location:../extend/alerta.php?msj=Operacion iniciada &c=pro&p=in&t=success');
}else {
  $log->error('Error - SQLSTATE: '.$up->error);
  header('location:../extend/alerta.php?msj=Operacion no pudo ser iniciada&c=pro&p=in&t=error');
}
$up ->close();
$con ->close();
 ?>
