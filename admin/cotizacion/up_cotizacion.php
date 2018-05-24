<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $up = $con->prepare(" UPDATE cotizacion SET orden_trabajo=?,cotizacion=?,orden_compra=?,fecha_pedido=?,fecha_aprobado=?,
 fecha_ofrecido=?,fecha_facturado=?,fecha_liquidado=?,estado=?,id_cliente=?,referencia=?,id_trabajo=?,
 recibido=?,sobre_tecnico=?,negativo=?,plancha=?,recurso=?,libros_articulos=?,hojas=?,copias=?,inicio=?,final=?
   WHERE id=? AND id_compania=? ");
  $up->bind_param("iiisssssdiiiiiiiiiiiiiii", $orden_trabajo, $cotizacion, $orden_compra, $fecha_pedido, $fecha_aprobado, $fecha_ofrecido,
  $fecha_facturado, $fecha_liquidado, $estado, $id_cliente, $referencia, $id_trabajo, $recibido, $sobre_tecnico,
  $negativo, $plancha, $recurso, $libros_articulos, $hojas, $copias, $inicio, $final, $id, $compania );
  if ($up->execute()) {
    header('location:../extend/alerta.php?msj=Editó cotización&c=cot&p=in&t=success');
  }else{
    header('location:../extend/alerta.php?msj=No editó la cotización'.$up->error.'&c=cot&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cot&p=in&t=error');
}

 ?>
