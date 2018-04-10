<?php
include '../conexion/conexion.php';
$compania = htmlentities($_POST['c']);
$user = $_SESSION['id_usuario'];
$_SESSION['compania']=$compania;
$up = $con->query("UPDATE usuario SET id_compania= $compania WHERE id='$user'");
if ($up) {
    header('location:../extend/alerta.php?msj=Compañía actualizada&c=home&p=in&t=success');
}
else {
  header('location:../extend/alerta.php?msj=Compañía no pudo ser actualizada&c=home&p=in&t=error');
}
 ?>
