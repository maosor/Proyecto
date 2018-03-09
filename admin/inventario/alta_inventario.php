<?php include '../extend/header.php';
include '../conexion/conexion.php';
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
        <form  action="ins_inventario.php" method="post" autocomplete="off" >
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
                <label for="descripcion">Descrición</label>
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
                <option value="0" selected disabled>SELECCIONE UN TIPO</option>
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
                <input type="number" name="existencia" id="existencia"  value="<?php echo $existencia ?>">
                <label for="existencia">Existencia</label>
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
          <div class="row">
            <div class="col s4">
              <div class = "input-field">
                <input type="number" name="precio_unitario" id="precio_unitario" value="<?php echo $precio_unitario ?>">
                <label for="precio_unitario">Precio Unitario</label>
              </div>
            </div>
            <div class="col s4">
              <div class = "input-field">
                <input type="date" class="datepicker" name="ultima_entrada" id="ultima_entrada" value="<?php echo $ultima_entrada?>">
                <label for="ultima_entrada">Fecha Ultima Entrada</label>
              </div>
            </div>
            <div class="col s4">
              <div class = "input-field">
                <input type="date" class="datepicker" name="ultima_salida" id="ultima_salida" value="<?php echo $ultima_salida ?>">
                <label for="ultima_salida">Fecha Ultima Salida</label>
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
