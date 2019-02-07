<?php
include '../conexion/conexion.php';
include '../logic/cotizacion_calculos.php';
$cal= new CotizacionCalculos();
 ?>
 <div class="testfunciones">
  <?php //phpinfo();
  var_dump($cal->CalcularCostoManoObra($con, 1,20, 50, 500,3 )) //compañia, cotización, Libros, hojas, copias?>

 </div>
