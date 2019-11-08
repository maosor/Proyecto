<?php
include '../conexion/conexion.php';
include '../logic/papel_controlador.php';
$log->info($_POST);
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $campo => $valor) {
      $variable = "$" . $campo. "='" . htmlentities($valor). "';";
      eval($variable);
    }
    $compania= $_SESSION['compania'];
    $papel = new PapelControlador();
    if($papel->insPapel_Cotizacion($con, $a, $compania, $c)){
      $log->info('Agregó papeles de #'.$c);
        $activo='active';
        foreach ($papel->getLista_Papel_Cotizacion($con, $compania, $c) as $key => $value){ ?>
           <li id="papel_<?php echo $value->papel?>" class="listapapeles collection-item <?php echo $activo?>" ><div><?php echo $papel->getNombrePapel($con, $compania,$value->papel)?><a id="<?php echo $value->papel?>" class="eliminar_papel secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
      <?php
    $activo='';
  } ?>
  <input type="hidden" id ="arrpapel" name="arrpapel" value ="<?php echo $papel->getListaPapeles()?>">
      <?php
    }
    else {
       $log->error('No se agregó papeles de #'.$c.'\n'.$papel->getError());
    }
   }
?>
<script src="../js/global.js"></script>
