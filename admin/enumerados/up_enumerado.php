<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $up = $con->prepare("UPDATE enumerado SET descripcion=? WHERE id =?");
  $up->bind_param("si", $descripcion, $id);
  if ($up->execute()) {
    header('location:../extend/alerta.php?msj=Editó '.strtolower(tipo_enum($tipo)).'&e='.$tipo.'&c=enu&p=in&t=success');
  }else{
    header('location:../extend/alerta.php?msj=No editó '.strtolower(tipo_enum($tipo)).'&e='.$tipo.'&c=enu&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=enu&p=in&t=error');
}

 ?>
