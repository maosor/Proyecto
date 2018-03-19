<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel = $con->prepare("SELECT  id, codigo, descripcion, tipo, existencia, minimo, maximo,
  precio_unitario, proveedor, ultima_entrada, ultima_salida
   FROM inventario WHERE id = ? ");
$sel->bind_param('i', $id);
$sel->execute();
$sel->bind_result($id, $codigo, $descripcion, $tipo, $existencia,$minimo, $maximo, $precio_unitario,
 $proveedor, $ultima_entrada, $ultima_salida);
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
          <div class="row">
            <div class="col s4">
                <b>Codigo: </b><?php echo $codigo ?>
            </div>
            <div class="col s8">
                <b>Descrición: </b><?php echo $descripcion ?>
            </div>
            </div>
          <div class="row">
            <div class="col s4">
              <b>Tipo: </b>
              <?php echo tipo_desc($tipo) ?>
            </div>
            <div class="col s8">
              <b>Proveedor: </b>
              <?php echo $proveedor ?>
              </div>
          </div>
          <div class="row">
                <div class="col s6">
                <b>Existencia Mínima: </b>
                <?php echo $minimo ?>
              </div>
            <div class="col s6">
                <b>Existencia Máxima: </b>
                <?php echo $maximo ?>
              </div>
          </div>
          <div class="row">
            <div class="col s6">
                <b>Existencia: </b>
                <?php echo $existencia ?>
            </div>
            <div class="col s4">
              <b>Precio: </b>
                <?php echo $precio_unitario ?>
              </div>
            </div>
          <div class="row">
            <div class="col s6">
              <b>Ultima Entrada: </b>
                <?php echo $ultima_entrada?>
              </div>
            <div class="col s6">
              <b>Ultima Salida: </b>
                <?php echo $ultima_salida ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

 </body>
</html>
