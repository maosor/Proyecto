<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $up = $con->prepare("UPDATE tinta_tipo SET descripcion=?, gramos_pulgada_tiraje=?,
   costo_gramo=? WHERE id=? AND id_compania=? ");
  $up->bind_param("sddis",$descripcion, $gramos_pulgada_tiraje, $costo_gramo, $id, $compania);
  if ($up->execute()) {
    header('location:../extend/alerta.php?msj=Editó tinta&c=tin&p=in&t=success');
  }else{
    header('location:../extend/alerta.php?msj=No editó la tinta&c=tin&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=tin&p=in&t=error');
}

 ?>
