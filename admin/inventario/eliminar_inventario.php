<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$compania = $_SESSION['compania'];
$con-> begin_transaction();
$del_det = $con->prepare("DELETE FROM inventario_detalle WHERE id_articulo=? AND id_compania=? ");
$del_det -> bind_param('ii', $id, $compania);
if ($del_det -> execute()) {
  $del = $con->prepare("DELETE FROM inventario WHERE id=? AND id_compania=? ");
  $del -> bind_param('ii', $id, $compania);
  $del -> execute();
  $del ->close();
  header('location:../extend/alerta.php?msj=Articulo eliminado&c=inv&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=El articulo no eliminado&c=inv&p=in&t=error');
}
$con->commit();
$con ->close();
$del ->close();
 ?>
