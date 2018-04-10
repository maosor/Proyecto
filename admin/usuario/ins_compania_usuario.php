<?php
include '../conexion/conexion.php';
if(isset($_POST['c'])&& isset($_POST['u']))
{
  $compania = htmlentities($_POST['c']);
  $usuario = htmlentities($_POST['u']);
//  $hoy = Date("y-m-d");
  $quien = $_SESSION['nick'];
  $ins = $con->query("INSERT INTO usuario_compania(id_usuario,	id_compania,	creado_por) VALUES ( $usuario, $compania,'$quien') ");
if ($ins) {
    $sel = $con->query("SELECT id, compania FROM usuario_compania uc inner join compania c on uc.id_compania=c.id
    WHERE uc.id_usuario = $usuario");
    while ($f = $sel -> fetch_assoc()){
    ?>
    <li class="collection-item"><div><?php echo $f['compania']?><a href="#" class="eliminar secondary-content" id = "<?php echo $compania ?>"><i class="material-icons red-text">remove</i></a></div></li>
    <input type="hidden" name="id_compania" value="<?php echo $compania ?>">
    <?php
  }
  $sel ->close();
}
else {
  header('location:../extend/alerta.php?msj=La compañía no pudo ser registrada&c=us&p=cxu&t=error');
}
$con->close();
}else{
  header('location:../extend/alerta.php?msj=Utiliza el formulario&c=us&p=cxu&t=error');
}
 ?>
