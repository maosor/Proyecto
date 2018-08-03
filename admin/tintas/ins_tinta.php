<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}
$id= '';
$compania = $_SESSION['compania'];
$ins = $con->prepare("INSERT INTO tinta_tipo VALUES(?,?,?,?,?) ");
$ins->bind_param("iisdd", $compania, $id, $descripcion, $gramos_pulgada_tiraje, $costo_gramo);

if ($ins->execute()) {
  header('location:../extend/alerta.php?msj=Guardó tinta&c=tin&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No guardó la tinta&c=tin&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=tin&p=in&t=error');
}
 ?>
