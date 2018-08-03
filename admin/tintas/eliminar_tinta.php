<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$compania = $_SESSION['compania'];
  $del = $con->prepare("DELETE FROM tinta_tipo WHERE id=? AND id_compania=? ");
  $del -> bind_param('ii', $id, $compania);
if(  $del -> execute())
{
  header('location:../extend/alerta.php?msj=Tinta eliminada&c=tin&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=La tinta no fue eliminada&c=tin&p=in&t=error');
}
$con ->close();
$del ->close();
 ?>
