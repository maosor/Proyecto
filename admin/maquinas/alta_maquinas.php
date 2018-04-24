<?php include '../extend/header.php';
include '../conexion/conexion.php';
include '../extend/funciones.php';
if (isset($_GET['id']))
{
  $id = $con->real_escape_string(htmlentities($_GET['id']));
  $sel_maq = $con->prepare("SELECT id, codigo, nombre_maquina, operarios, tipo,
   maximo_alto, maximo_ancho, minimo_alto, minimo_ancho, cod_mascara, cod_plan_metal,
   cod_plan_carton_gde, cod_plan_carton_peq FROM maquina WHERE id = ? ");
  $sel_maq->bind_param('i', $id);
  $sel_maq->execute();
  $sel_maq->bind_result( $id, $codigo, $nombre_maquina, $operarios, $tipo,
  $maximo_alto, $maximo_ancho, $minimo_alto, $minimo_ancho, $cod_mascara, $cod_plan_metal,
   $cod_plan_carton_gde, $cod_plan_carton_peq );
  $sel_maq->fetch();
  $accion = 'Actualizar';
  $tipo_desc = tipo_maq($tipo);
}
else {
  $codigo = ''; $nombre_maquina = ''; $operarios= '';
  $tipo = ''; $maximo_alto = ''; $maximo_ancho =''; $minimo_alto= '';
  $minimo_ancho = ''; $cod_mascara = ''; $cod_plan_metal= '';
  $cod_plan_carton_gde= ''; $cod_plan_carton_peq= '';
  $accion = 'Insertar';
}
?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <?php if ($accion == 'Actualizar'): ?>
          <span class="card-title">Edición de Maquina</span>
          <?php else: ?>
          <span class="card-title">Ingreso de Maquina</span>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS MAQUINA</b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_maquina.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php else: ?>
          <form  action="ins_maquina.php" method="post" autocomplete="off">
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
                <input type="text" name="nombre_maquina" id="nombre_maquina" value="<?php echo $nombre_maquina ?>">
                <label for="nombre_maquina">Nombre</label>
              </div>
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
              <div class = "input-field">
                <input type="text" name="minimo_alto" id="minimo_alto" value="<?php echo $minimo_alto ?>">
                <label for="minimo_alto">Alto</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="minimo_ancho" id="minimo_ancho" value="<?php echo $minimo_ancho ?>">
                <label for="minimo_ancho">Ancho</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="maximo_alto" id="maximo_alto" value="<?php echo $maximo_alto ?>">
                <label for="maximo_alto">Alto</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="maximo_ancho" id="maximo_ancho" value="<?php echo $maximo_ancho ?>">
                <label for="maximo_ancho">Ancho</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col s4">
              <div class = "input-field">
                <input type="number" name="operarios" id="operarios" value="<?php echo $operarios ?>">
                <label for="operarios">Numero Operarios</label>
              </div>
            </div>
            <div class="col s4">
              <div class = "input-field">
                <input type="text" name="cod_mascara" id="cod_mascara" value="<?php echo $cod_mascara ?>">
                <label for="cod_mascara">Codigo Mascara</label>
              </div>
            </div>
            <div class="col s4">
              <div class = "input-field">
                <input type="text" name="cod_plan_metal" id="cod_plan_metal" value="<?php echo $cod_plan_metal ?>">
                <label for="cod_plan_metal">Codigo plancha Metal</label>
              </div>
            </div>
            <div class="row">
              <div class="col s4">
                <div class = "input-field">
                  <input type="text" name="cod_plan_carton_gde" id="cod_plan_carton_gde" value="<?php echo $cod_plan_carton_gde ?>">
                  <label for="cod_plan_carton_gde">Codigo plancha Carton Gde.</label>
                </div>
              </div>
              <div class="col s4">
                <div class = "input-field">
                  <input type="text" name="cod_plan_carton_peq" id="cod_plan_carton_peq" value="<?php echo $cod_plan_carton_peq ?>">
                  <label for="cod_plan_carton_peq">Codigo plancha Carton Peq.</label>
                </div>
              </div>
              <div class="col s4">
                <select id="tipo" name="tipo" required value = "1">
                  <?php if ($accion == 'Actualizar'): ?>
                      <option value="<?php echo $tipo ?>" selected><?php echo $tipo_desc ?></option>
                    <?php else: ?>
                      <option value="0" selected disabled>SELECCIONE UN TIPO</option>
                   <?php endif; ?>
                    <option value="1">LITOGRAFIA</option>
                    <option value="2">TIPOGRAFIA</option>
                </select>
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

<?php include '../extend/scripts.php'; ?>
<script src="../js/estados.js"></script>
</body>
</html>
