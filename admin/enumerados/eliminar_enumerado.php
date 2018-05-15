<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';
$id = htmlentities($_GET['id']);
$tipo=htmlentities($_GET['tipo']);
$compania = $_SESSION['compania'];
  $del = $con->prepare("DELETE FROM enumerado WHERE id=? AND id_compania=? ");
  $del -> bind_param('ii', $id, $compania);
if(  $del -> execute())
{
  header('location:../extend/alerta.php?msj='.strtolower(tipo_enum($tipo)).' eliminada&c=enu&p=in&t=success'.'&e='.$tipo);
}else {
  header('location:../extend/alerta.php?msj='.strtolower(tipo_enum($tipo)).' no fue eliminada&c=enu&p=in&t=error'.'&e='.$tipo);
}
$con ->close();
$del ->close();
 ?>
