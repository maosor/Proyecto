<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
  $nombre = htmlentities($_POST['compania']);
  $id = htmlentities($_POST['id']);

  $up = $con->prepare("UPDATE compania SET compania=?  WHERE id=? ");
  $up->bind_param('si', $nombre, $id);

    if ($up -> execute()) {
    header('location:../extend/alerta.php?msj=Compañía actualizada&c=com&p=in&t=success');
  }else {
    header('location:../extend/alerta.php?msj=La compañía no pudo ser actualizada&c=com&p=in&t=error');
  }
$ins->close();
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=com&p=in&t=error');
}
 ?>
