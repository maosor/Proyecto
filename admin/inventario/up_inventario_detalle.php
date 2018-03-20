<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
  $compania = $_SESSION ['compania'];
  $sel = $con->prepare("SELECT sum(IF(tipo = 1, cantidad, 0)) as entrada, SUM(IF(tipo = 2, cantidad, 0)) as salida
  FROM inventario_detalle WHERE id_articulo = ? AND id_compania = ? ");
  $sel->bind_param('ii', $id_articulo, $compania);
  $sel->execute();
  $sel->bind_result($entrada, $salida);
  if($sel->fetch())
  {
    if($tipo = 1){
      $saldo = ($entrada - $salida)+$cantidad;

    }else {
      $saldo = ($entrada - $salida)-$cantidad;
    }
  }
    $sel->close();
$con-> begin_transaction();
    $up = $con->prepare("UPDATE inventario_detalle SET id_compania=?,id=?,id_articulo=?,documento=?,descripcion=?,
      tipo=?,cantidad=?,saldo=?,fecha=? WHERE id=?");
  $up->bind_param("iiiisiddsi", $compania, $id, $id_articulo, $documento, $descripcion,
   $tipo, $cantidad, $saldo, $fecha,$id);
  if ($up->execute()) {
    if($tipo = 1){
      $up_inv = $con->prepare("UPDATE inventario SET existencia=?, ultima_entrada=? WHERE id=? AND id_compania =? ");
    }else {
      $up_inv = $con->prepare("UPDATE inventario SET existencia=?, ultima_salida=? WHERE id=? AND id_compania =? ");
    }
    $up_inv-> bind_param('dsii',$saldo,$fecha, $id_articulo, $compania);
    if($up_inv -> execute())
    {
      $up_inv ->close();
    header('location:../extend/alerta.php?msj=Edito el detalle del articulo&c=inv&p=in&t=success');
  }
  }else{
    header('location:../extend/alerta.php?msj=No edito el detalle del articulo&c=inv&p=in&t=error');
  }
  $con->commit();
  $up->close();
  $con->close();
}else {
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=inv&p=in&t=error');
}

 ?>
