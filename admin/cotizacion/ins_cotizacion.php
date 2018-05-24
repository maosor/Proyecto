<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}
$id= '';
$compania = $_SESSION['compania'];
$recibido = $_SESSION['id_usuario'];
$ins = $con->prepare("INSERT INTO cotizacion (id_compania, id, cotizacion, fecha_pedido, id_cliente,
 referencia, id_trabajo, recibido, sobre_tecnico, negativo, plancha, recurso,
 libros_articulos, hojas, copias, inicio, final) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$ins->bind_param("iiisiiiiiiiiiiiii", $compania, $id, $cotizacion, $fecha_pedido, $id_cliente,
 $referencia, $id_trabajo, $recibido, $sobre_tecnico, $negativo, $plancha, $recurso,
 $libros_articulos, $hojas, $copias, $inicio, $final);

if ($ins->execute()) {
  header('location:../extend/alerta.php?msj=Guardó cotización&c=cot&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No guardó la cotización'.$ins->error.'&c=cot&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cot&p=in&t=error');
}
 ?>
