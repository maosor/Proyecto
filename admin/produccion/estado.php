<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$accion = htmlentities($_GET['estado']);
$up = $con->prepare("UPDATE cotizacion_operacion_realizar SET estado=? WHERE id=? ");
$up -> bind_param('is', $estado, $id);
if ($up -> execute()) {
 header('location:../extend/alerta.php?msj=Operacion '.$estado==1?'iniciada':''.'&c=pro&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=Operacion no pudo ser '.$estado==1?'iniciada':''.'&c=pro&p=in&t=error');
}
$up ->close();
$con ->close();
 ?>
