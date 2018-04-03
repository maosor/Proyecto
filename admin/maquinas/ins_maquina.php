<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}
$id= '';
$compania = $_SESSION['compania'];
$ins = $con->prepare("INSERT INTO maquina VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
$ins->bind_param("iissiiddddssss", $compania, $id, $codigo, $nombre_maquina, $tipo,
$operarios, $maximo_alto, $maximo_ancho, $minimo_alto, $minimo_ancho, $cod_mascara,
 $cod_plan_metal, $cod_plan_carton_gde, $cod_plan_carton_peq);

if ($ins->execute()) {
  header('location:../extend/alerta.php?msj=Guardó máquina&c=maq&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=No guardó la máquina&c=maq&p=in&t=error');
}
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=maq&p=in&t=error');
}
 ?>
