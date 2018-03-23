<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel = $con->prepare("SELECT i.descripcion, d.id, documento, d.descripcion, d.tipo, fecha, cantidad, saldo
   FROM inventario_detalle d INNER JOIN inventario i ON (d.id_articulo = i.id) WHERE d.id =? ");
$sel->bind_param('i', $id);
$sel->execute();
$sel->bind_result($articulo, $id, $documento, $descripcion, $tipo, $fecha,$cantidad, $saldo);
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
        <h5 align="center"><b>DATOS ARTICULO</b></h5>
        <h6 align="center"><b><?php echo $articulo ?></b></h6>
          <div class="row">
            <div class="col s4">
                <b>Documento: </b><?php echo $documento ?>
            </div>
            <div class="col s8">
                <b>Descrición: </b><?php echo $descripcion ?>
            </div>
            </div>
          <div class="row">
            <div class="col s6">
              <b>Tipo: </b>
              <?php echo tipo_trans($tipo) ?>
            </div>
            <div class="col s6">
              <b>Fecha: </b>
              <?php echo $fecha ?>
              </div>
          </div>
          <div class="row">
                <div class="col s6">
                <b>Cantidad: </b>
                <?php echo $cantidad ?>
              </div>
            <div class="col s6">
                <b>Saldo: </b>
                <?php echo $saldo ?>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

 </body>
</html>
