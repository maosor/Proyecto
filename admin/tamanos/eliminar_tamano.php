<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$compania = $_SESSION['compania'];
  $del = $con->prepare("DELETE FROM papel_tamano WHERE id=? AND id_compania=? ");
  $del -> bind_param('ii', $id, $compania);
if(  $del -> execute())
{
  header('location:../extend/alerta.php?msj=Tamaño eliminado&c=tam&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=El tamaño no fue eliminado&c=tam&p=in&t=error');
}
$con ->close();
$del ->close();
 ?>
