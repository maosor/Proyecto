<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $up = $con->prepare("UPDATE maquina SET codigo=?, nombre_maquina=?, tipo=?,
   operarios=?, maximo_alto=?, maximo_ancho=?, minimo_alto=?, minimo_ancho=?, numero_colores=?
   WHERE id=? AND id_compania=? ");
  $up->bind_param("isiiddddiii", $codigo, $nombre_maquina, $tipo,
  $operarios, $maximo_alto, $maximo_ancho, $minimo_alto, $minimo_ancho, $numero_colores, $id, $compania );
  if ($up->execute()) {
    header('location:../extend/alerta.php?msj=Editó máquina&c=maq&p=in&t=success');
  }else{
    header('location:../extend/alerta.php?msj=No editó la máquina&c=maq&p=in&t=error');
  }
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=maq&p=in&t=error');
}

 ?>
