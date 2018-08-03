<?php include '../extend/header.php';
include '../conexion/conexion.php';
include '../extend/funciones.php';
if (isset($_GET['id']))
{
  $id = $con->real_escape_string(htmlentities($_GET['id']));
  $sel_maq = $con->prepare("SELECT descripcion, gramos_pulgada_tiraje, costo_gramo
    FROM tinta_tipo WHERE id = ? ");
  $sel_maq->bind_param('i', $id);
  $sel_maq->execute();
  $sel_maq->bind_result($descripcion, $gramos_pulgada_tiraje, $costo_gramo);
  $sel_maq->fetch();
  $accion = 'Actualizar';
  $sel_maq -> close();
}
else {
  $id = ''; $descripcion = ''; $gramos_pulgada_tiraje= '';  $costo_gramo = '';
  $accion = 'Insertar';
}
?>
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <?php if ($accion == 'Actualizar'): ?>
          <span class="card-title">Edición de Tintas</span>
          <?php else: ?>
          <span class="card-title">Ingreso de Tintas</span>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS TINTAS</b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_tinta.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php else: ?>
          <form  action="ins_tinta.php" method="post" autocomplete="off">
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
                <input type="text" name="gramos_pulgada_tiraje" id="gramos_pulgada_tiraje" value="<?php echo $gramos_pulgada_tiraje ?>">
                <label for="gramos_pulgada_tiraje">Gramos Pulgada Tiraje</label>
              </div>
            </div>
            <div class="col s6">
              <div class = "input-field">
                <input type="text" name="costo_gramo" id="costo_gramo" value="<?php echo $costo_gramo ?>">
                <label for="costo_gramo">Costo Gramo</label>
              </div>
            </div>
          </div>
          <div class="">
            <center>
              <?php if ($accion == 'Actualizar'): ?>
                <button type="submit" enabled class="btn">Guardar</button>
              <?php else: ?>
                <button type="submit" class="btn">Guardar nueva</button>
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
