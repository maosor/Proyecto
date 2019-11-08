<?php include '../extend/header.php';
include '../conexion/conexion.php';
include '../extend/funciones.php';
if (isset($_GET['id']))
{
  $id = $con->real_escape_string(htmlentities($_GET['id']));
  $sel_maq = $con->prepare("SELECT descripcion, ancho, alto
    FROM papel_tamano WHERE id = ? ");
  $sel_maq->bind_param('i', $id);
  $sel_maq->execute();
  $sel_maq->bind_result($descripcion, $ancho, $alto);
  $sel_maq->fetch();
  $accion = 'Actualizar';
  $sel_maq -> close();
}
else {
  $id = ''; $descripcion = ''; $ancho= '';  $alto = '';
  $accion = 'Insertar';
}
?>
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <?php if ($accion == 'Actualizar'): ?>
          <span class="card-title">Edición de Tamaños</span>
          <?php else: ?>
          <span class="card-title">Ingreso de Tamaños</span>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS TAMAÑOS</b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_tamano.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php else: ?>
          <form  action="ins_tamano.php" method="post" autocomplete="off">
         <?php endif; ?>
          <div class="row">
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="codigo" id="codigo" value="<?php echo  $id?>">
                <label for="codigo">Codigo</label>
              </div>
            </div>
            <div class="col s9">
              <div class = "input-field">
                <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>">
                <label for="descripcion">descripcion</label>
              </div>
            </div>
            </div>
          <div class="row">
            <div class="col s6">
              <div class = "input-field">
                <input type="text" name="ancho" id="ancho" value="<?php echo $ancho ?>">
                <label for="ancho">Ancho</label>
              </div>
            </div>
            <div class="col s6">
              <div class = "input-field">
                <input type="text" name="alto" id="alto" value="<?php echo $alto ?>">
                <label for="alto">Alto</label>
              </div>
            </div>
          </div>
          <div class="">
            <center>
              <?php if ($accion == 'Actualizar'): ?>
                <button type="submit" enabled class="btn">Guardar</button>
              <?php else: ?>
                <button type="submit" class="btn">Guardar nuevo</button>
              <?php endif; ?>
              <input  type="reset" class="btn red" onclick="window.location='index.php'" value ="Cancelar"</input>
            </center>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php include '../extend/scripts.php'; ?>

</body>
</html>
