<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$compania = $_SESSION['compania'];
  $del = $con->prepare("DELETE FROM cotizacion WHERE id=? AND id_compania=? ");
  $del -> bind_param('ii', $id, $compania);
if(  $del -> execute())
{
  header('location:../extend/alerta.php?msj=Cotización eliminada&c=cot&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=La cotización no fue eliminada&c=cot&p=in&t=error');
}
$con ->close();
$del ->close();
 ?>
