<?php
include '../conexion/conexion.php';
$id = htmlentities($_GET['id']);
$compania = $_SESSION['compania'];
$sel_inv = $con->prepare("SELECT id_articulo, cantidad
FROM inventario_detalle WHERE id=? AND id_compania = ?");
$sel_inv->bind_param('ii', $id, $compania);
$sel_inv->execute();
$sel_inv->bind_result($id_articulo, $cantidad);
$sel_inv->fetch();
$sel_inv->close();
$sel = $con->prepare("SELECT sum(IF(tipo = 1, cantidad, 0)) as entrada, SUM(IF(tipo = 2, cantidad, 0)) as salida
FROM inventario_detalle WHERE id_articulo = ? AND id_compania = ? ");
$sel->bind_param('ii', $id_articulo, $compania);
$sel->execute();
$sel->bind_result($entrada, $salida);
if($sel->fetch())
{
  if($tipo == 1){
    $saldo = ($entrada - $salida)-$cantidad;

  }else {
    $saldo = ($entrada - $salida)+$cantidad;
  }
}
  $sel->close();
$con-> begin_transaction();
$del_det = $con->prepare("DELETE FROM inventario_detalle WHERE id=? AND id_compania=? ");
$del_det -> bind_param('ii', $id, $compania);
if ($del_det -> execute()) {
  if($tipo == 1){
    $up = $con->prepare("UPDATE inventario SET existencia=?, ultima_entrada=? WHERE id=? AND id_compania =? ");
  }else {
    $up = $con->prepare("UPDATE inventario SET existencia=?, ultima_salida=? WHERE id=? AND id_compania =? ");
  }
  $up -> bind_param('dsii',$saldo,$fecha, $id_articulo, $compania);
  if($up -> execute())
  {
    $up->close();
  header('location:../extend/alerta.php?msj=Artículo eliminado&c=inv&p=in&t=success');
}else {
  header('location:../extend/alerta.php?msj=El artículo no eliminado&c=inv&p=in&t=error');
}
}
$con->commit();
$con ->close();
$del ->close();
 ?>
