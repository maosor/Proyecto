<?php
include '../conexion/conexion.php';
include '../logic/extra_controlador.php';
$log->info($_POST);
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $campo => $valor) {
      $variable = "$" . $campo. "='" . htmlentities($valor). "';";
      eval($variable);
    }
    $compania= $_SESSION['compania'];
    $extra = new ExtraControlador();
    if($extra->insExtra_Cotizacion($con, $a, $compania, $c)){
      $log->info('Agregó extras de #'.$c);
      $extraactiva = 'active';
      foreach ($extra->getLista_Extras_Cotizacion($con, $compania, $c) as $key => $value){ ?>
        <li id="extras_<?php echo $value->id?>"  class="listaextras collection-item"><div><?php echo $value->cantidad ?> ===>> <?php echo  $value->descripcion ?><a id="<?php echo $value->id?>" class="eliminar_extra secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
        <?php $log->info('Extras: '.$value->descripcion);
        $extraactiva = '';
      } ?>
      <input type="hidden" id ="arrextras" name="arrextras" value ="<?php echo $extra->getListaextras()?>">
    <?php }
    else {
       $log->error('No se agregó extras de #'.$c.'\n'.$extra->getError().$a);
    }
  }
?>
<script src="../js/extras.js"></script>
