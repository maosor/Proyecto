<?php
include '../conexion/conexion.php';
include '../logic/terceros_controlador.php';
$log->info($_POST);
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $campo => $valor) {
      $variable = "$" . $campo. "='" . htmlentities($valor). "';";
      eval($variable);
    }
    $compania= $_SESSION['compania'];
    $tercero = new TercerosControlador();
    if($tercero->insTercero_Cotizacion($con, $a, $compania, $c)){
      $log->info('Agregó terceros de #'.$c);
      $terceroactiva = 'active';
      foreach ($tercero->getLista_terceros_Cotizacion($con, $compania, $c) as $key => $value){ ?>
        <li id="tercero_<?php echo $value->id?>"  class="listaterceros collection-item"><div><?php echo $value->descripcion?> ===>> <?php echo $value->monto?><a id="<?php echo $value->id?>" class="eliminar_tercero secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
        <?php $log->info('Tercero: '.$value->descripcion);
        $terceroactiva = '';
      } ?>
      <input type="hidden" id ="arrterceros" name="arrterceros" value ="<?php echo $tercero->getListaterceros()?>">
    <?php
    }
    else {
       $log->error('No se agregó terceros de #'.$c.'\n'.$tercero->getError().$a);
     }
   }
?>
<script src="../js/terceros.js"></script>
