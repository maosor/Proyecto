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
$ins = $con->prepare("INSERT INTO operacion VALUES(?,?,?,?,?,?,?,?,?,?,?,?) ");
$ins->bind_param("iissiiidddii", $compania, $id, $codigo, $descripcion, $id_maquina,
  $tipo_operacion, $subtipo_operacion, $tiempo_parametro, $carga_acumulada,
  $costoxcentesima, $no_paso_ejecucion, $es_resta_automatica);

if ($ins->execute()) {
  header('location:../extend/alerta.php?msj=Guardó operación'.$es_resta_automatica.'&c=ope&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No guardó la operación'.$es_resta_automatica.'&c=ope&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ope&p=in&t=error');
}
 ?>
