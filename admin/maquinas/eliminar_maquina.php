<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$compania = $_SESSION['compania'];
  $del = $con->prepare("DELETE FROM maquina WHERE id=? AND id_compania=? ");
  $del -> bind_param('ii', $id, $compania);
if(  $del -> execute())
{
  header('location:../extend/alerta.php?msj=Máquina eliminada&c=maq&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=La máquina no fue eliminada&c=maq&p=in&t=error');
}
$con ->close();
$del ->close();
 ?>
