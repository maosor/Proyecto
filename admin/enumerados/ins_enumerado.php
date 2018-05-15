<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}
$id= '';
$es_resta_automatica = valor($es_resta_automatica);
$compania = $_SESSION['compania'];
$ins = $con->prepare("INSERT INTO enumerado(id_compania, id, descripcion, tipo) VALUES (?,?,?,?) ");
$ins->bind_param("iisi", $compania, $id, $descripcion, $tipo);

if ($ins->execute()) {
  header('location:../extend/alerta.php?msj=Guardó '.strtolower(tipo_enum($tipo)).'&e='.$tipo.'&c=enu&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No guardó '.strtolower(tipo_enum($tipo)).'&e='.$tipo.'&c=enu&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=enu&p=in&t=error');
}
 ?>
