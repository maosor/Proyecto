<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
    $up = $con->prepare("UPDATE inventario_detalle SET id_compania=?,id=?,id_articulo=?,documento=?,descripcion=?,
      tipo=?,cantidad=?,saldo=?,fecha=? WHERE id=?");
  $up->bind_param("iiiisiddsi", $compania, $id, $id_articulo, $documento, $descripcion,
   $tipo, $cantidad, $saldo, $fecha,$id);
  if ($up->execute()) {
    header('location:../extend/alerta.php?msj=Edito el detalle del articulo&c=inv&p=in&t=success');
  }else{
    header('location:../extend/alerta.php?msj=No edito el detalle del articulo&c=inv&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=inv&p=in&t=error');
}

 ?>
