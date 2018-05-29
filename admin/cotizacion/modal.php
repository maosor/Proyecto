<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel_cot = $con->prepare("SELECT id, orden_trabajo, cotizacion, orden_compra,fecha_pedido, fecha_aprobado, fecha_ofrecido,
fecha_facturado, fecha_liquidado, estado, id_cliente, referencia, id_trabajo, recibido, sobre_tecnico,
negativo, plancha, recurso, libros_articulos, hojas, copias, inicio, final FROM cotizacion WHERE id = ? ");
$sel_cot->bind_param('i', $id);
$sel_cot->execute();
$sel_cot->bind_result( $id, $orden_trabajo, $cotizacion, $orden_compra, $fecha_pedido, $fecha_aprobado, $fecha_ofrecido,
$fecha_facturado, $fecha_liquidado, $estado, $id_cliente, $referencia, $id_trabajo, $recibido, $sobre_tecnico,
$negativo, $plancha, $recurso, $libros_articulos, $hojas, $copias, $inicio, $final);
$sel_cot->fetch();
$sel_cot -> close();
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
        <h5 align="center"><b>DATOS COTIZACIÓN</b></h5>
          <div class="row">
            <div class="col s2">
                <b>Cotización: </b><?php echo $cotizacion ?>
            </div>
            <div class="col s2">
                <b>O.T.: </b><?php echo $orden_trabajo ?>
            </div>
            <div class="col s2">
                <b>Ref.: </b><?php echo $referencia ?>
            </div>
            <div class="col s3">
                <b>Pedido: </b><?php echo date_format(date_create($fecha_pedido), 'd/m/Y') ?>
            </div>
            <div class="col s3">
                <b>Estado: </b><?php echo estado_cotizacion($estado) ?>
            </div>
          </div>
          <div class="row">
            <div class="col s5">
              <b>Cliente: </b>
              <?php echo nombre_cliente($id_cliente) ?>
            </div>
            <div class="col s5">
              <b>Trabajo: </b>
              <?php echo enum_description($id_trabajo) ?>
            </div>
            <div class="col s2">
                <b>O. Compra: </b><?php $orden_compra ?>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <b>S. Técnico: </b>
              <?php echo $sobre_tecnico ?>
            </div>
            <div class="col s3">
              <b>Negativo: </b>
              <?php echo $negativo ?>
            </div>
            <div class="col s3">
              <b>Plancha: </b>
                <?php echo $plancha ?>
            </div>
            <div class="col s3">
              <b>Recurso: </b>
                <?php echo $recurso ?>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <b>Lib./Art.: </b>
              <?php echo $libros_articulos ?>
            </div>
            <div class="col s3">
              <b>Hojas: </b>
              <?php echo $hojas ?>
            </div>
            <div class="col s2">
              <b>Copias: </b>
                <?php echo $copias ?>
            </div>
            <div class="col s2">
              <b>Inicio: </b>
                <?php echo $inicio ?>
            </div>
            <div class="col s2">
              <b>Final: </b>
                <?php echo $final ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 </body>
</html>
