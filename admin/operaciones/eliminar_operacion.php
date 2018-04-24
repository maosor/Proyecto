<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$compania = $_SESSION['compania'];
  $del = $con->prepare("DELETE FROM operacion WHERE id=? AND id_compania=? ");
  $del -> bind_param('ii', $id, $compania);
if(  $del -> execute())
{
  header('location:../extend/alerta.php?msj=Operación eliminada&c=ope&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=La operación no fue eliminada&c=ope&p=in&t=error');
}
$con ->close();
$del ->close();
 ?>
