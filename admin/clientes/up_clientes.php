<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
  $codigo = htmlentities($_POST['codigo']);
  $nombre = htmlentities($_POST['nombre']);
  $direccion = htmlentities($_POST['direccion']);
  $telefono = htmlentities($_POST['telefono']);
  $correo = htmlentities($_POST['correo']);
  $id = htmlentities($_POST['id']);
  $contacto = htmlentities($_POST['contacto']);

  $up = $con->prepare("UPDATE clientes SET  codigo=?, nombre=?, direccion = ?, telefono =?, correo =?, contacto=?  WHERE id=? ");
  $up->bind_param('ssssssi', $codigo, $nombre, $direccion, $telefono, $correo,$contacto, $id);

    if ($up -> execute()) {
    header('location:../extend/alerta.php?msj=Cliente actualizado&c=cli&p=in&t=success');
  }else {
    header('location:../extend/alerta.php?msj=El cliente no pudo se actualizado&c=clie&p=in&t=error');
  }
$ins->close();
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}
 ?>
