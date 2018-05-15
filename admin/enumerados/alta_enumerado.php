<?php include '../extend/header.php';
  include '../conexion/conexion.php';
  include '../extend/funciones.php';
  if (isset($_GET['id']))
  {
    $id = $con->real_escape_string(htmlentities($_GET['id']));
    $sel_ope = $con->prepare("SELECT descripcion, tipo FROM enumerado WHERE id= ?");
    $sel_ope->bind_param('i', $id );
    $sel_ope->execute();
    $sel_ope->bind_result( $descripcion, $tipo );


    $sel_ope->fetch();
    $accion = 'Actualizar';
    $sel_ope ->close();
  }
  else {
    $tipo = htmlentities($_GET['tip']); $descripcion = '';
    $accion = 'Insertar';
  }
?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <?php if ($accion == 'Actualizar'): ?>
          <span class="card-title">Edición de <?php echo tipo_enum($tipo)?>s</span>
          <?php else: ?>
          <span class="card-title">Ingreso de <?php echo tipo_enum($tipo)?>s</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS <?php echo tipo_enum($tipo)?></b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_enumerado.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php else: ?>
        <form  action="ins_enumerado.php" method="post" autocomplete="off">
         <?php endif; ?>
         <input type="hidden" name="tipo" value="<?php echo $tipo ?>">
          <div class="row">
            <div class="col s12">
              <div class = "input-field">
                <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>">
                <label for="descripcion">Descripción</label>
              </div>
            </div>
          </div>
        <center>
          <?php if ($accion == 'Actualizar'): ?>
          <button type="submit" class="btn">Guardar</button>
          <?php else: ?>
            <button type="submit" class="btn">Guardar nueva</button>
          <?php endif; ?>
          <input  type="reset" class="btn red" onclick="window.location='index.php'" value ="Cancelar"</input>
        </center>
        </form>
      </div>
    </div>
  </div>
</div>
<script>

</script>
<?php include '../extend/scripts.php'; ?>
</body>
</html>
