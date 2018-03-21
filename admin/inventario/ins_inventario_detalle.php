<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
foreach ($_POST as $campo => $valor) {
$variable = "$".$campo."='".htmlentities($valor)."';";
eval($variable);
}
$compania = $_SESSION['compania'];
$sel = $con->prepare("SELECT sum(IF(tipo = 1, cantidad, 0)) as entrada, SUM(IF(tipo = 2, cantidad, 0)) as salida
FROM inventario_detalle WHERE id_articulo = ? AND id_compania = ? ");
$sel->bind_param('ii', $id_articulo, $compania);
$sel->execute();
$sel->bind_result($entrada, $salida);
if($sel->fetch())
{
  if($tipo == 1){
    $saldo = ($entrada - $salida)+$cantidad;

  }else {
    $saldo = ($entrada - $salida)-$cantidad;
  }
}
  $sel->close();
$id= '';
$con-> begin_transaction();
$ins = $con->prepare("INSERT INTO inventario_detalle VALUES(?,?,?,?,?,?,?,?,?) ");
$ins->bind_param("iiissidds", $compania, $id, $id_articulo, $documento, $descripcion,
 $tipo, $cantidad, $saldo, $fecha);
  if ($ins->execute()) {
    if($tipo == 1){
      $up = $con->prepare("UPDATE inventario SET existencia=?, ultima_entrada=? WHERE id=? AND id_compania =? ");
    }else {
      $up = $con->prepare("UPDATE inventario SET existencia=?, ultima_salida=? WHERE id=? AND id_compania =? ");
    }
    $up -> bind_param('dsii',$saldo,$fecha, $id_articulo, $compania);
    if($up -> execute())
    {
      $up ->close();
      header('location:../extend/alerta.php?msj=Guardo el detalle del Artículo&c=inv&p=in&t=success');
    }
  }else {
    header('location:../extend/alerta.php?msj=No guardo el detalle del Artículo&c=inv&p=in&t=error');
  }
  $con->commit();
  $ins->close();
$con->close();
}else {
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=inv&p=in&t=error');
}
 ?>
