<?php include '../extend/header.php';
  include '../conexion/conexion.php';
  include '../extend/funciones.php';
  if (isset($_GET['id']))
  {
    $id = $con->real_escape_string(htmlentities($_GET['id']));
    $sel_ope = $con->prepare("SELECT id, codigo, descripcion, id_maquina, tipo_operacion,
      subtipo_operacion, tiempo_parametro, carga_acumulada, costoxcentesima, no_paso_ejecucion,
      es_resta_automatica FROM operacion WHERE id = ? ");
    $sel_ope->bind_param('i', $id);
    $sel_ope->execute();
    $sel_ope->bind_result( $id, $codigo, $descripcion, $id_maquina, $tipo_operacion,
      $subtipo_operacion, $tiempo_parametro, $carga_acumulada, $costoxcentesima, $no_paso_ejecucion,
      $es_resta_automatica );


    $sel_ope->fetch();
    $accion = 'Actualizar';
    $sel_ope ->close();
  }
  else {
    $codigo = ''; $descripcion = ''; $id_maquina= '';
    $tipo_operacion = ''; $subtipo_operacion = ''; $tiempo_parametro ='';$carga_acumulada ='';
    $costoxcentesima= ''; $no_paso_ejecucion = ''; $es_resta_automatica = 0;
    $accion = 'Insertar';
  }
  $compania = $_SESSION ['compania'];
  $sel = $con->prepare("SELECT id FROM maquina WHERE id_compania = ? ");
  $sel->bind_param('i', $compania);
  $sel->execute();
  $sel->bind_result($maquina);
?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <?php if ($accion == 'Actualizar'): ?>
          <span class="card-title">Edición de Operaciones</span>
          <?php else: ?>
          <span class="card-title">Ingreso de Operaciones</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS OPERACIÓN</b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_operacion.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php else: ?>
        <form  action="ins_operacion.php" method="post" autocomplete="off">
         <?php endif; ?>
          <div class="row">
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="codigo" id="codigo" value="<?php echo $codigo ?>">
                <label for="codigo">Código</label>
              </div>
            </div>
            <div class="col s6">
              <div class = "input-field">
                <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion ?>">
                <label for="descripcion">Descripción</label>
              </div>
            </div>
              <p>
                <input type="checkbox" class="filled-in" name="es_resta_automatica"
                id="es_resta_automatica" <?php echo chequeado($es_resta_automatica)?>/>
                <label for="es_resta_automatica">Resta Automáticamente </label>
              </p>
          </div>
          <div class="row">
            <div class="col s4">
              <select id="id_maquina" name="id_maquina" required value = "1">
                <?php if ($accion == 'Actualizar'): ?>
                    <option value="<?php echo $id_maquina ?>" selected><?php echo maq($id_maquina) ?></option>
                  <?php else: ?>
                    <option value="0" selected disabled>SELECCIONE UN TIPO</option>
                 <?php endif; ?>
                 <?php while ($sel->fetch()) {?>
                  <option value="<?php echo $maquina ?>"><?php echo maq($maquina) ?></option>
                <?php }
                $sel ->close(); ?>
              </select>
            </div>
            <div class="col s4">
              <select id="tipo_operacion" name="tipo_operacion" required value = "1">
                <?php if ($accion == 'Actualizar'): ?>
                    <option value="<?php echo $tipo_operacion ?>" selected><?php echo tipo_ope($tipo_operacion) ?></option>
                  <?php else: ?>
                    <option value="0" selected disabled>SELECCIONE UN TIPO</option>
                 <?php endif; ?>
                  <option value="1">PRENSA</option>
                  <option value="2">PRE-PRENSAS</option>
                  <option value="3">ACABADOS</option>
                  <option value="4">OTRAS</option>
                  <option value="5">EXTRAS</option>
              </select>
            </div>
            <div class="col s4">
              <select id="subtipo_operacion" name="subtipo_operacion" required value = "1">
                <?php if ($accion == 'Actualizar'): ?>
                    <option value="<?php echo $subtipo_operacion ?>" selected><?php echo subtipo_ope($subtipo_operacion) ?></option>
                  <?php else: ?>
                    <option value="0" selected disabled>SELECCIONE UN TIPO</option>
                 <?php endif; ?>
                  <option value="1">PRODUCTIVA</option>
                  <option value="2">IMPRODUCTIVA EVITABLE</option>
                  <option value="3">IMPRODUCTIVA NO EVITABLE</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <div class = "input-field">
                <input type="number" step="0.0001" name="tiempo_parametro" id="tiempo_parametro" value="<?php echo $tiempo_parametro ?>">
                <label for="tiempo_parametro">Tiempo Parámetro</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="number" step="0.0001" name="carga_acumulada" id="carga_acumulada" value="<?php echo $carga_acumulada ?>">
                <label for="carga_acumulada">Carga Acumulada</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="number" step="0.0001" name="costoxcentesima" id="costoxcentesima" value="<?php echo $costoxcentesima ?>">
                <label for="costoxcentesima">Costo Centésima</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="number" name="no_paso_ejecucion" id="no_paso_ejecucion" value="<?php echo $no_paso_ejecucion ?>">
                <label for="no_paso_ejecucion">No. Paso Ejecución</label>
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
