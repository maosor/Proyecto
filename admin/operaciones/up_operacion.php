<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $es_resta_automatica = valor($es_resta_automatica);
  $up = $con->prepare("UPDATE operacion SET codigo=?,descripcion=?,id_maquina=?,tipo_operacion=?,subtipo_operacion=?,
      tiempo_parametro=?,carga_acumulada=?,costoxcentesima=?,no_paso_ejecucion=?,es_resta_automatica=?
      WHERE id=? AND id_compania=? ");
  $up->bind_param("ssiiidddiiii", $codigo, $descripcion, $id_maquina,
    $tipo_operacion, $subtipo_operacion, $tiempo_parametro, $carga_acumulada,
    $costoxcentesima, $no_paso_ejecucion, $es_resta_automatica, $id, $compania );
  if ($up->execute()) {
    header('location:../extend/alerta.php?msj=Editó operación&c=ope&p=in&t=success');
  }else{
    header('location:../extend/alerta.php?msj=No editó la operación&c=ope&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=ope&p=in&t=error');
}

 ?>
