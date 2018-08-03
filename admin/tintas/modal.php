<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel = $con->prepare("SELECT id, descripcion, gramos_pulgada_tiraje, costo_gramo
  FROM tinta_tipo  WHERE id = ? ");
$sel->bind_param('i', $id);
$sel->execute();
$sel->bind_result($id, $descripcion, $gramos_pulgada_tiraje, $costo_gramo);
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
        <h5 align="center"><b>DATOS TINTA</b></h5>
          <div class="row">
            <div class="col s4">
                <b>Codigo: </b><?php echo $id ?>
            </div>
            <div class="col s8">
                <b>Nombre: </b><?php echo $descripcion ?>
            </div>
            </div>
          <div class="row">
            <div class="col s6">
              <b>Gramos: </b>
              <?php echo $gramos_pulgada_tiraje ?>
            </div>
            <div class="col s6">
              <b>Costo: </b>
              <?php echo $costo_gramo ?>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 </body>
</html>
