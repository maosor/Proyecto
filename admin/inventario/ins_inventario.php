<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}
$id= '';
$compania = $_SESSION['compania'];
$ins = $con->prepare("INSERT INTO inventario VALUES(?,?,?,?,?,?,?,?,?,?,?,?) ");
$ins->bind_param("sissdidddsss", $compania, $id, $codigo, $descripcion, $precio_unitario, $tipo,
 $existencia, $minimo, $maximo, $proveedor, $ultima_entrada, $ultima_salida );

if ($ins->execute()) {
  header('location:../extend/alerta.php?msj=Guardo Artículo&c=inv&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No guardo el Artículo&c=inv&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cli&p=in&t=error');
}
 ?>
