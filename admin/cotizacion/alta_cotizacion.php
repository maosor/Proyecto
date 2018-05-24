<?php include '../extend/header.php';
include '../conexion/conexion.php';
include '../extend/funciones.php';
if (isset($_GET['id']))
{
  $id = $con->real_escape_string(htmlentities($_GET['id']));
  $sel_cot = $con->prepare("SELECT id, orden_trabajo, cotizacion, orden_compra,fecha_pedido, fecha_aprobado, fecha_ofrecido,
fecha_facturado, fecha_liquidado, estado, id_cliente, referencia, id_trabajo, recibido, sobre_tecnico,
negativo, plancha, recurso, libros_articulos, hojas, copias, inicio, final FROM cotizacion WHERE id = ? ");
  $sel_cot->bind_param('i', $id);
  $sel_cot->execute();
  $sel_cot->bind_result( $id, $orden_trabajo, $cotizacion, $orden_compra, $fecha_pedido, $fecha_aprobado, $fecha_ofrecido,
  $fecha_facturado, $fecha_liquidado, $estado, $id_cliente, $referencia, $id_trabajo, $recibido, $sobre_tecnico,
  $negativo, $plancha, $recurso, $libros_articulos, $hojas, $copias, $inicio, $final);
  $sel_cot->fetch();
  $accion = 'Actualizar';
  $sel_cot -> close();
}
else {
  $orden_trabajo= ''; $cotizacion= ''; $orden_compra= ''; $fecha_pedido= ''; $fecha_aprobado= ''; $fecha_ofrecido= '';
  $fecha_facturado= ''; $fecha_liquidado= ''; $estado= ''; $id_cliente= ''; $referencia= ''; $id_trabajo= ''; $recibido= ''; $sobre_tecnico= '';
  $negativo= ''; $plancha= ''; $recurso= ''; $libros_articulos= ''; $hojas= ''; $copias= ''; $inicio= ''; $final= '';
  $accion = 'Insertar';
}


$compania= $_SESSION['compania'];
$sel = $con->prepare("SELECT id, nombre FROM clientes WHERE id_compania = ? ");
$sel->bind_param('i', $compania);
$sel->execute();
$sel->bind_result($id_cli, $nombre);
?>
<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <?php if ($accion == 'Actualizar'): ?>
          <span class="card-title">Edición de Cotización</span>
          <?php else: ?>
          <span class="card-title">Ingreso de Cotización</span>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <h5 align="center"><b>DATOS Cotización</b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_cotizacion.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php else: ?>
          <form  action="ins_cotizacion.php" method="post" autocomplete="off">
         <?php endif; ?>
          <div class="row">
            <div class="col s2">
              <div class = "input-field">
                <input type="text" name="cotizacion" id="cotizacion" value="<?php echo $cotizacion ?>">
                <label for="cotizacion">Cotización</label>
              </div>
            </div>
            <div class="col s2">
              <div class = "input-field">
                <input type="text" name="orden_trabajo" id="orden_trabajo" value="<?php echo $orden_trabajo ?>">
                <label for="orden_trabajo">Orden Trabajo</label>
              </div>
            </div>
            <div class="col s2">
              <div class = "input-field">
                <input type="text" name="referencia" id="referencia" value="<?php echo $referencia ?>">
                <label for="referencia">Referencia</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="date" class="datepicker" name="fecha_pedido" id="fecha_pedido" value="<?php echo $fecha_pedido ?>">
                <label for="fecha_pedido">Fecha Pedido</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="estado" id="estado" value="<?php echo $estado ?>">
                <label for="estado">Estado</label>
              </div>
            </div>
            <div class="row">
              <div class="col s5">
                <select id="id_cliente" name="id_cliente" required value = "1">
                  <?php if ($accion == 'Actualizar'): ?>
                      <option value="<?php echo $id_cliente ?>" selected ><?php echo nombre_cliente($id_cliente) ?></option>
                    <?php else: ?>
                      <option value="0" selected disabled>SELECCIONE UN CLIENTE</option>
                   <?php endif; ?>
                   <?php while ($sel->fetch()) {?>
                    <option value="<?php echo $id_cli ?>"><?php echo $nombre ?></option>
                  <?php }
                  $sel ->close();    ?>
                </select>
              </div>
              <?php
                $sel_trab = $con->prepare("SELECT id, descripcion FROM enumerado WHERE id_compania = ? and tipo = 2");
                $sel_trab->bind_param('i', $compania);
                $sel_trab->execute();
                $sel_trab->bind_result($id_trab, $descripcion);
               ?>
              <div class="col s5">
                <select id="id_trabajo" name="id_trabajo" required value = "1">
                  <?php if ($accion == 'Actualizar'): ?>
                      <option value="<?php echo $id_trabajo ?>" selected ><?php echo enum_description($id_trabajo) ?></option>
                    <?php else: ?>
                      <option value="0" selected disabled>SELECCIONE UN TRABAJO</option>
                   <?php endif; ?>
                   <?php while ($sel_trab->fetch()) {?>
                    <option value="<?php echo $id_trab ?>"><?php echo $descripcion ?></option>
                  <?php }
                  $sel_trab ->close(); ?>
                </select>
              </div>
              <div class="col s2">
                <div class = "input-field">
                  <input type="text" name="orden_compra" id="orden_compra" value="<?php echo $orden_compra ?>">
                  <label for="orden_compra">Orden Compra</label>
                </div>
              </div>
            </div>
         <div class="row">
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="sobre_tecnico" id="sobre_tecnico" value="<?php echo $sobre_tecnico ?>">
                <label for="sobre_tecnico">Sobre Técnico</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="negativo" id="negativo" value="<?php echo $negativo ?>">
                <label for="negativo">Negativo</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="plancha" id="plancha" value="<?php echo $plancha ?>">
                <label for="plancha">Plancha</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="recurso" id="recurso" value="<?php echo $recurso ?>">
                <label for="recurso">Recurso</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="libros_articulos" id="libros_articulos" value="<?php echo $libros_articulos ?>">
                <label for="libros_articulos">Libros/articulos</label>
              </div>
            </div>
            <div class="col s3">
              <div class = "input-field">
                <input type="text" name="hojas" id="hojas" value="<?php echo $hojas ?>">
                <label for="hojas">Hojas</label>
              </div>
            </div>
            <div class="col s2">
              <div class = "input-field">
                <input type="text" name="copias" id="copias" value="<?php echo $copias ?>">
                <label for="copias">Copias</label>
              </div>
            </div>
            <div class="col s2">
              <div class = "input-field">
                <input type="text" name="inicio" id="inicio" value="<?php echo $inicio ?>">
                <label for="inicio">Numero Inicio</label>
              </div>
            </div>
            <div class="col s2">
              <div class = "input-field">
                <input type="text" name="final" id="final" value="<?php echo $final ?>">
                <label for="final">Numero final</label>
              </div>
            </div>
          </div>
          <div class="row">
             <div class="col s3">
               <div class = "input-field">
                 <input type="date" class="datepicker" name="fecha_aprobado" id="fecha_aprobado" value="<?php echo $fecha_aprobado ?>">
                 <label for="fecha_aprobado">Fecha Aprobado</label>
               </div>
             </div>
             <div class="col s3">
               <div class = "input-field">
                 <input type="date" class="datepicker" name="fecha_ofrecido" id="fecha_ofrecido" value="<?php echo $fecha_ofrecido ?>">
                 <label for="fecha_ofrecido">Fecha Ofrecido</label>
               </div>
             </div>
             <div class="col s3">
               <div class = "input-field">
                 <input type="date" class="datepicker" name="fecha_facturado" id="fecha_facturado" value="<?php echo $fecha_facturado ?>">
                 <label for="fecha_facturado">Fecha Facturado</label>
               </div>
             </div>
             <div class="col s3">
               <div class = "input-field">
                 <input type="date" class="datepicker" name="fecha_liquidado" id="fecha_liquidado" value="<?php echo $fecha_liquidado ?>">
                 <label for="fecha_liquidado">Fecha Liquidado</label>
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
