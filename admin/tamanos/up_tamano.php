<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $up = $con->prepare("UPDATE papel_tamano SET descripcion=?, ancho=?,
   alto=? WHERE id=? AND id_compania=? ");
  $up->bind_param("sddis",$descripcion, $ancho, $alto, $id, $compania);
  if ($up->execute()) {
    header('location:../extend/alerta.php?msj=Editó tamaño&c=tam&p=in&t=success');
  }else{
    header('location:../extend/alerta.php?msj=No editó la tamaño&c=tam&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=tam&p=in&t=error');
}

 ?>
