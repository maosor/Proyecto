<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $up = $con->prepare("UPDATE inventario SET codigo=?, descripcion=?, precio_unitario=?, tipo=?,
   existencia=?, minimo=?, maximo=?, proveedor=?, ultima_entrada=?, ultima_salida=? WHERE id=? AND id_compania=? ");
  $up->bind_param("ssdidddsssii", $codigo, $descripcion, $precio_unitario, $tipo,
   $existencia, $minimo, $maximo, $proveedor, $ultima_entrada, $ultima_salida, $id, $compania);
  if ($up->execute()) {
    header('location:../extend/alerta.php?msj=Editó artículo&c=inv&p=in&t=success');
  }else{
    header('location:../extend/alerta.php?msj=No editó el artículo&c=inv&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=inv&p=in&t=error');
}

 ?>
