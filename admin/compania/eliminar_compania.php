<?php
include '../extend/header.php';
$id = htmlentities($_GET['id']);
$del = $con->prepare("DELETE FROM compania WHERE id = ?");
$del -> bind_param('i', $id);

if ($del -> execute()) {
  header('location:../extend/alerta.php?msj=Compania eliminada&c=com&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=La compania no pudo ser eliminada&c=com&p=in&t=error');
}
$del ->close();
$con->close();
 ?>
