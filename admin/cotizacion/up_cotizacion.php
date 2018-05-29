<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $up = $con->prepare(" UPDATE cotizacion SET orden_trabajo=?,orden_compra=?,fecha_pedido=?,id_cliente=?,referencia=?,id_trabajo=?,
 recibido=?,sobre_tecnico=?,negativo=?,plancha=?,recurso=?,libros_articulos=?,hojas=?,copias=?,inicio=?,final=?
   WHERE id=? AND id_compania=? ");
  $up->bind_param("iisiiiiiiiiiiiiiii", $orden_trabajo, $orden_compra, $fecha_pedido, $id_cliente, $referencia, $id_trabajo, $recibido, $sobre_tecnico,
  $negativo, $plancha, $recurso, $libros_articulos, $hojas, $copias, $inicio, $final, $id, $compania );
  if ($up->execute()) {
    $log->info('Actualizó cotización #'.$cotizacion);
    header('location:../extend/alerta.php?msj=Editó cotización&c=cot&p=in&t=success');
  }else{
    $log->error('Error guardando cotización: '.$up->error);
    header('location:../extend/alerta.php?msj=No editó la cotización&c=cot&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    $log->error('Error intentando ingresar sin formulario desde: '.gethostbyname(trim(`hostname`)));
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cot&p=in&t=error');
}

 ?>
