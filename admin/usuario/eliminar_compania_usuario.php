<?php
include '../extend/header.php';
if(isset($_POST['c'])&& isset($_POST['u']))
{
  $compania = htmlentities($_POST['c']);
  $usuario = htmlentities($_POST['u']);
  $del = $con->prepare("DELETE FROM usuario_compania WHERE id_compania = ? AND id_usuario = ? ");
  $del -> bind_param('ii', $compania, $usuario);
  if ($del -> execute()) {
    $sel = $con->query("SELECT id, compania FROM usuario_compania uc inner join compania c on uc.id_compania=c.id
    WHERE uc.id_usuario = $usuario");
    while ($f = $sel -> fetch_assoc()){
    ?>
    <li class="collection-item"><div><?php echo $f['compania']?><a href="#" class="eliminar secondary-content" id = "<?php echo $compania ?>"><i class="material-icons red-text">remove</i></a></div></li>
    <input type="hidden" name="id_compania" value=" <?php echo $compania ?>">
    <?php
  }
  $sel ->close();
  }else {
    echo "La compañía no pudo ser eliminada";
    header('location:../extend/alerta.php?msj=La compañía no pudo ser eliminada&c=us&p=cxu&t=error');
  }
  $del ->close();
  $con->close();
}else{
  echo "Utiliza el formulario";
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=cxu&t=error');
}
 ?>
