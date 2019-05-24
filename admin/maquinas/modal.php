<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';

$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel = $con->prepare("SELECT  id, codigo, nombre_maquina, tipo, operarios, maximo_alto,
    maximo_ancho, minimo_alto, minimo_ancho, 	cod_plancha_o_mascara FROM maquina WHERE id =? ");
$sel->bind_param('i', $id);
$sel->execute();
$sel->bind_result($id, $codigo, $nombre_maquina, $tipo, $operarios, $maximo_alto,
    $maximo_ancho, $minimo_alto, $minimo_ancho, $numero_colores);
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
        <h5 align="center"><b>DATOS MAQUINA</b></h5>
          <div class="row">
            <div class="col s4">
                <b>Codigo: </b><?php echo $codigo ?>
            </div>
            <div class="col s8">
                <b>Nombre: </b><?php echo $nombre_maquina ?>
            </div>
            </div>
            <div class="row">
              <div class="col s6">
                <h6 align="center"><b>Minimo Alto X Ancho</b></h6>
              </div>
              <div class="col s6">
                <h6 align="center"><b>Maximo Alto X Ancho</b></h6>
              </div>
            </div>
          <div class="row">
            <div class="col s3">
              <b>Alto: </b>
              <?php echo $minimo_alto ?>
            </div>
            <div class="col s3">
              <b>Ancho: </b>
              <?php echo $minimo_ancho ?>
              </div>
            <div class="col s3">
              <b>Alto: </b>
              <?php echo $maximo_alto ?>
            </div>
            <div class="col s3">
              <b>Ancho: </b>
              <?php echo $maximo_ancho ?>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <b>Operarios: </b>
              <?php echo $operarios ?>
            </div>
            <div class="col s6">
              <b>Numero Colores: </b>
              <?php echo $numero_colores ?>
            </div>
            <div class="col s3">
              <b>Tipo: </b>
                <?php echo tipo_maq($tipo) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 </body>
</html>
