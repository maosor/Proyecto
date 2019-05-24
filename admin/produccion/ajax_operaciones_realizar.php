<?php
include '../conexion/conexion.php';
include '../extend/funciones.php';
$compania = $_SESSION ['compania'];
if (isset($_POST['id'])){

  $id = htmlentities($_POST['id']);
  $compania = $_SESSION ['compania'];
  $sel = $con->prepare("SELECT cor.id, o.codigo, o.descripcion, m.descripcion,
    cor.tiempo,cor.cantidad_operaciones, cor.costo, cor.estado
    FROM (operacion o INNER JOIN maquina_tipo m ON o.id_maquina = m.id)
    INNER JOIN cotizacion_operacion_realizar cor
    ON (o.codigo = cor.codigo_operacion AND cor.codigo_maquina = o.id_maquina)
    WHERE o.id_compania =? AND cor.id_cotizacion = ?");
    $sel->bind_param("ii", $compania, $id);
  }
  ?>
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Operaciones
            </span>
        <table class="excel" border="1">
          <thead>
            <tr class="cabecera">
              <th class="borrar">Vista</th>
              <th>Código</th>
              <th>Descripción</th>
              <th>Estado</th>
              <th>Máquina</th>
              <th>Cantidad</th>
              <th>Tiempo</th>
              <th>Costo<br>unitario</th>
              <th colspan="1">Acciones </th>

            </tr>
          </thead>
          <?php $sel->execute();
          $sel->bind_result($id, $codigo, $descripcion, $maquina, $cantidad, $tiempo,$costo, $estado);
          while ($sel->fetch()) {
            ?>
          <tr class="">
            <td class="borrar"><a <?php echo $estado==0?'':($estado==2?'':'disabled')?>
                          href="estado.php?id=<?php echo $id?>&estado=1" class="btn green btn-floating"><i class="material-icons">play_arrow</i></a></td>
            <td><?php echo $codigo ?></td>
            <td><?php echo $descripcion?></td>
            <td><?php echo operacion_estado($estado)?></td>
            <td><?php echo $maquina?></td>
            <td><?php echo $cantidad?></td>
            <td><?php echo $tiempo?></td>
            <td><?php echo $costo?></td>
            <td class="borrar"><a <?php echo $estado==1?'':'disabled'?>
                            href="estado.php?id=<?php echo $id?>&estado=2"class="btn blue btn-floating"><i class="material-icons">pause</i></a></td>
            <td class="borrar"><a <?php echo $estado==1||$estado==2?'':'disabled'?>
                            href="estado.php?id=<?php echo $id?>&estado=3" class="btn red btn-floating"><i class="material-icons">stop</i></a></td>

            </tr>
        <?php }
        $sel->close();
        $con->close();
         ?>
          </table>
        </div>
      </div>
    </div>
  </div>
