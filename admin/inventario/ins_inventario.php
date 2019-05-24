<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}
$id= '';
$fecha = date('y-m-d');
$compania = $_SESSION['compania'];
$existencia = 0.00;
$ins = $con->prepare("INSERT INTO inventario VALUES(?,?,?,?,?,?,?,?,?,?,?,?) ");
$ins->bind_param("iissdidddsss", $compania, $id, $codigo, $descripcion, $precio_unitario, $tipo,
$existencia, $minimo, $maximo, $proveedor, $fecha, $fecha);

if ($ins->execute()) {
  header('location:../extend/alerta.php?msj=guardó Artículo&c=inv&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No guardó el Artículo&c=inv&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=inv&p=in&t=error');
}
 ?>
