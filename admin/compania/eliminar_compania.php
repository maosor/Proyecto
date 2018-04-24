<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$con-> begin_transaction();
$del = $con->prepare("DELETE FROM usuario_compania WHERE id_compania = ?");
$del -> bind_param('i', $id);
if ($del -> execute()) {
  $del = $con->prepare("DELETE FROM compania WHERE id = ?");
  $del -> bind_param('i', $id);
  if ($del -> execute())
  {
    header('location:../extend/alerta.php?msj=Compañía eliminada&c=com&p=in&t=success');
  }
  else {
    header('location:../extend/alerta.php?msj=La compañía no pudo ser eliminada&c=com&p=in&t=error');
  }
}
$con -> commit();
$del ->close();
$con->close();
 ?>
