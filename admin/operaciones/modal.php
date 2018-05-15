<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel = $con->prepare("SELECT id, codigo, descripcion, id_maquina, tipo_operacion,
  subtipo_operacion, tiempo_parametro, carga_acumulada, costoxcentesima, no_paso_ejecucion,
  es_resta_automatica FROM operacion WHERE id = ? ");
$sel->bind_param('i', $id);
$sel->execute();
$sel->bind_result($id, $codigo, $descripcion, $id_maquina, $tipo_operacion,
  $subtipo_operacion, $tiempo_parametro, $carga_acumulada, $costoxcentesima, $no_paso_ejecucion,
  $es_resta_automatica);
$sel->fetch();
 ?>

 <!DOCTYPE html>
 <html lang="en"> <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="../css/materialize.min.css">
   <title>modal</title>
 </head>
 <body>
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS OPERACIÓN</b></h5>
          <div class="row">
            <div class="col s4">
                <b>Codigo: </b><br>
                <?php echo $codigo ?>
            </div>
            <div class="col s4">
                <b>Descripción: </b><br>
                <?php echo $descripcion ?>
            </div>
            <div class="col s4">
              <?php if ($es_resta_automatica): ?>
                <i class="green-text material-icons">check</i> Resta Automáticamente
              <?php else: ?>
                <i class="green-text material-icons">check_box_outline_blank</i> Resta Automáticamente
              <?php endif; ?>

            </div>
            </div>
          <div class="row">
            <div class="col s4">
              <b>Tipo Máquina: </b><br>
              <?php echo maq($id_maquina) ?>
            </div>
            <div class="col s4">
              <b>Tipo Operación: </b><br>
              <?php echo tipo_ope($tipo_operacion) ?>
              </div>
            <div class="col s4">
              <b>Sub Tipo Operación: </b><br>
              <?php echo subtipo_ope($subtipo_operacion) ?>
            </div>
          </div>
          <div class="row">
            <div class="col s4">
              <b>Tiempo Parametro: </b><br>
              <?php echo $tiempo_parametro ?>
            </div>
            <div class="col s4">
              <b>Carga Acumulada: </b><br>
              <?php echo $carga_acumulada ?>
            </div>
            <div class="col s4">
              <b>Costo Unitario: </b><br>
                <?php echo $costoxcentesima ?>
            </div>
            <div class="col s4">
              <b>N. Paso Ejecución: </b> <br>
                <?php echo $no_paso_ejecucion ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 </body>
</html>
