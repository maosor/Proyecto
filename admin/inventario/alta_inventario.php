<?php include '../extend/header.php';
include '../conexion/conexion.php';
include '../extend/funciones.php';
if (isset($_GET['id']))
{
  $id = $con->real_escape_string(htmlentities($_GET['id']));
  $sel_prop = $con->prepare("SELECT id, codigo, descripcion, precio_unitario, tipo,
   existencia, minimo, maximo, proveedor, ultima_entrada, ultima_salida FROM inventario WHERE id = ? ");
  $sel_prop->bind_param('i', $id);
  $sel_prop->execute();
  $sel_prop->bind_result( $id, $codigo, $descripcion, $precio_unitario, $tipo,
  $existencia, $minimo, $maximo, $proveedor, $ultima_entrada, $ultima_salida);
  $sel_prop->fetch();
  $accion = 'Actualizar';
  $tipo_desc = tipo_desc($tipo);
}
else {
  $codigo = ''; $descripcion = ''; $precio_unitario= '';
  $tipo = ''; $existencia = ''; $minimo =''; $maximo= '';
  $proveedor = ''; $ultima_entrada = ''; $ultima_salida = '';
  $accion = 'Insertar';
}
?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <?php if ($accion == 'Actualizar'): ?>
          <span class="card-title">Edición de Inventario</span>
          <?php else: ?>
          <span class="card-title">Ingreso de Inventario</span>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS ARTICULO</b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_inventario.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php else: ?>
          <form  action="ins_inventario.php" method="post" autocomplete="off">
         <?php endif; ?>
          <div class="row">
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="codigo" id="codigo" value="<?php echo $codigo ?>">
                <label for="codigo">Codigo</label>
              </div>
            </div>
            <div class="col s9">
              <div class = "input-field">
                <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>">
                <label for="descripcion">Descripción</label>
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col s8">
              <div class = "input-field">
                <input type="text" name="proveedor" id="proveedor" value="<?php echo $proveedor ?>">
                <label for="proveedor">proveedor</label>
              </div>
            </div>
            <div class="col s4">
              <select id="tipo" name="tipo" required value = "1">
                <?php if ($accion == 'Actualizar'): ?>
                    <option value="<?php echo $tipo ?>" selected><?php echo $tipo_desc ?></option>
                  <?php else: ?>
                    <option value="0" selected disabled>SELECCIONE UN TIPO</option>
                 <?php endif; ?>
                  <option value="1">PAPELES</option>
                  <option value="2">SUMINISTROS</option>
                  <option value="3">REPUESTOS</option>
                  <option value="4">OTROS</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col s4">
              <div class = "input-field">
                <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" value="<?php echo $precio_unitario ?>">
                <label for="precio_unitario">Precio Unitario</label>
              </div>
            </div>
            <div class="col s4">
              <div class = "input-field">
                <input type="number" name="minimo" id="minimo" value="<?php echo $minimo ?>">
                <label for="minimo">Existencia Mínima</label>
              </div>
            </div>
            <div class="col s4">
              <div class = "input-field">
                <input type="number" name="maximo" id="maximo" value="<?php echo $maximo ?>">
                <label for="maximo">Existencia Máxima</label>
              </div>
            </div>
          </div>
        <center>
        <?php if ($accion == 'Actualizar'): ?>
        <button type="submit" class="btn">Guardar</button>
        <?php else: ?>
          <button type="submit" class="btn">Guardar nuevo</button>
        <?php endif; ?>
        <input  type="reset" class="btn red" onclick="window.location='index.php'" value ="Cancelar"</input>
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
