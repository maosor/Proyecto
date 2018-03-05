<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
$compania = htmlentities($_POST['compania']);
$id='';

$ins = $con->prepare("INSERT INTO compania VALUES (?,?) ");
$ins -> bind_param('is', $id, $compania);
if ($ins -> execute()) {

  header('location:../extend/alerta.php?msj=Compania registrada&c=com&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=La compania no pudo se registrada&c=com&p=in&t=error');
}
$ins ->close();
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=com&p=in&t=error');
}
 ?>
