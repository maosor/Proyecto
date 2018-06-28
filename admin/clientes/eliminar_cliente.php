<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$del = $con->prepare("DELETE FROM clientes WHERE id = ?");
$del -> bind_param('i', $id);

if ($del -> execute()) {
  $log->info('Eliminó cliente #'.$id);
  header('location:../extend/alerta.php?msj=Cliente eliminado&c=cli&p=in&t=success');
}else {
  $log->error($del->errno.' Error eliminando cliente: '.$del->error);
  if ($del->errno == 1451)
  {
    header('location:../extend/alerta.php?msj=El cliente no pudo ser eliminado. Hay cotizaciones asociadas&c=cli&p=in&t=error');
  }
  else {
    header('location:../extend/alerta.php?msj=El cliente no pudo ser eliminado&c=cli&p=in&t=error');
  }
}
$del ->close();
$con->close();
 ?>
