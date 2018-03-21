<?php include '../extend/header.php';
include '../conexion/conexion.php';
include '../extend/funciones.php';
if (isset($_GET['det']))
{
  $id = $con->real_escape_string(htmlentities($_GET['det']));
  $sel_invdet = $con->prepare("SELECT id_articulo, documento, descripcion, tipo, cantidad, fecha
    FROM inventario_detalle WHERE id = ? ");
  $sel_invdet->bind_param('i', $id);
  $sel_invdet->execute();
  $sel_invdet->bind_result( $id_articulo, $documento, $descripcion, $tipo, $cantidad, $fecha);
  $sel_invdet->fetch();
  $accion = 'Actualizar';
  $tipo_trans = tipo_trans($tipo);
  $sel_invdet->close();
}
else {
  $id_articulo = htmlentities($_GET['id']); $documento = ''; $descripcion= '';
  $tipo = ''; $cantidad = ''; $fecha= date('Y-m-d');
  $accion = 'Insertar';
}
$sel_inv = $con->prepare("SELECT descripcion FROM inventario WHERE id = ? ");
$sel_inv->bind_param('i', $id_articulo);
$sel_inv->execute();
$sel_inv->bind_result($descripcion_articulo);
$sel_inv->fetch();
$sel_inv->close();
?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <?php if ($accion == 'Actualizar'): ?>
          <span b class="card-title">Edición detalle de: <?php echo $descripcion_articulo?> </span>
          <?php else: ?>
          <span class="card-title">Ingreso detalle de: <?php echo $descripcion_articulo?> </span>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS DETALLE</b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_inventario_detalle.php" method="post" autocomplete="off">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <input type="hidden" name="last_cantidad" value="<?php echo $cantidad ?>">
          <input type="hidden" name="last_tipo" value="<?php echo $tipo ?>">
        <?php else: ?>
          <form  action="ins_inventario_detalle.php" method="post" autocomplete="off">
         <?php endif; ?>
          <input type="hidden" name="id_articulo" value="<?php echo $id_articulo ?>">
          <div class="row">
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="documento" id="documento" value="<?php echo $documento?>">
                <label for="documento">Documento</label>
              </div>
            </div>
            <div class="col s9">
              <div class = "input-field">
                <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion?>">
                <label for="descripcion">Descrición</label>
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col s4">
              <div class = "input-field">
                <input type="number" name="cantidad" id="cantidad" value="<?php echo $cantidad?>">
                <label for="cantidad">Cantidad</label>
              </div>
            </div>
            <div class="col s4">
              <select id="tipo" name="tipo" required value = "1">
                <?php if ($accion == 'Actualizar'): ?>
                    <option value="<?php echo $tipo?>" selected><?php echo $tipo_trans?></option>
                  <?php else: ?>
                    <option value="0" selected disabled>SELECCIONE UN TIPO</option>
                 <?php endif; ?>
                  <option value="1">ENTRADA</option>
                  <option value="2">SALIDA</option>
              </select>
            </div>
            <div class="col s4">
              <div class = "input-field">
                <input type="date" class="datepicker" name="fecha" id="fecha" value="<?php echo $fecha?>">
                <label for="fecha">Fecha</label>
              </div>
            </div>
          </div>
        <center>
        <button type="submit" class="btn">Guardar</button>
        </center>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../extend/scripts.php'; ?>
<script src="../js/estados.js"></script>
</body>
</html>
