<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}

$compania = $_SESSION['compania'];
$ins = $con->prepare("INSERT INTO papel_tamano VALUES(?,?,?,?,?) ");
$ins->bind_param("issdd", $compania, $codigo, $descripcion, $ancho, $alto);

if ($ins->execute()) {
  header('location:../extend/alerta.php?msj=Guardó tamaño&c=tam&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No guardó la tamaño&c=tam&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=tam&p=in&t=error');
}
 ?>
