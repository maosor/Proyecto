<?php
include '../conexion/conexion.php';
include '../logic/tinta_controlador.php';
$log->info($_POST);
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $campo => $valor) {
      $variable = "$" . $campo. "='" . htmlentities($valor). "';";
      eval($variable);
    }
    $compania= $_SESSION['compania'];
    $tinta = new TintaControlador();
    if($tinta->insTinta_Cotizacion($con, $a, $compania, $c)){
      $log->info('Agregó colores de #'.$c);
        $activo='active';
          foreach ($tinta->getLista_Tintas_Cotizacion($con, $compania, $c) as $key => $value){
           ?>
         <li id="color_<?php echo $value->id?>" class="listacolores collection-item <?php echo $activo?>" ><div><?php echo $value->color?><a id= "<?php echo $value->color?>" class="eliminar_color secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>

      <?php
    $activo='';
  } ?>
      <input type="hidden" id ="arrcolores" name="arrcolores" value ="<?php echo $tinta->getListaColores()?>">
      <?php
    }
    else {
       $log->error('Error agregando colores de #'.$c);
     }
   }
?>
<script src="../js/tintas.js"></script>
