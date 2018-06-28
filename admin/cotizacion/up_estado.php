<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';
try {
  if (isset($_GET['id']) && isset($_GET['est'])) {
    $compania = $_SESSION ['compania'];
    $id = htmlentities($_GET['id']);
    $estado = htmlentities($_GET['est']);
    if ($estado == 1)
    {
      orden_trabajo($id,$estado);
    }
    $log->info(estado_cotizacion($estado));
    $up = $con->prepare('UPDATE cotizacion SET estado=?, fecha_'.strtolower(estado_cotizacion($estado)).'=sysdate(3) WHERE id=? AND id_compania=? ');
    $up->bind_param("iii", $estado, $id, $compania );
    if ($up->execute()) {
      $log->info('Actualizó cotización #'.$id);
      header('location:../extend/alerta.php?msj=Estado actualizado&c=cot&p=in&t=success');
    }else{
      $log->error('Error actualizado estado: '.$up->error);
      header('location:../extend/alerta.php?msj=No se actualizó estado&c=cot&p=in&t=error');
    }
    $up->close();
    $con->close();
  }else {
      $log->error('Error intentando ingresar sin formulario desde: '.gethostbyname(trim(`hostname`)));
      header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cot&p=in&t=error');
  }
} catch (Exception $e) {
  $log->error('Error: '.$e);
}


 ?>
