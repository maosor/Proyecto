<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$compania = $_SESSION['compania'];
$del = $con->prepare("DELETE FROM inventario WHERE id=? AND id_compania=? ");
$del -> bind_param('ii', $id, $compania);
if ($del -> execute()) {
  header('location:../extend/alerta.php?msj=Articulo eliminado&c=inv&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=El articulo no eliminado&c=inv&p=in&t=error');
}
$con ->close();
$del ->close();
 ?>
