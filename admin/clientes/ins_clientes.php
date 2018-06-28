<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
$compania = htmlentities($_POST['compania']);
$codigo = htmlentities($_POST['codigo']);
$nombre = htmlentities($_POST['nombre']);
$direccion = htmlentities($_POST['direccion']);
$telefono = htmlentities($_POST['telefono']);
$correo = htmlentities($_POST['correo']);
$contacto = htmlentities($_POST['contacto']);
$id='';

$ins = $con->prepare("INSERT INTO clientes VALUES (?,?,?,?,?,?,?,?) ");
$ins -> bind_param('iissssss', $compania, $id, $codigo, $nombre, $direccion, $telefono, $correo, $contacto);
if ($ins -> execute()) {
  header('location:../extend/alerta.php?msj=Cliente registrado&c=cli&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=El cliente no pudo se registrado&c=clie&p=in&t=error');
}
$ins ->close();
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=in&t=error');
}
 ?>
