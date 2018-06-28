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
  $fecha_facturado= ''; $fecha_liquidado= ''; $estado= null; $id_cliente= ''; $referencia= ''; $id_trabajo= ''; $recibido= ''; $sobre_tecnico= '';
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
        <h5 align="center"><b>DATOS COTIZACIÓN</b></h5>
        <?php if ($accion == 'Actualizar'): ?>
          <form  action="up_cotizacion.php" method="post" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php else: ?>
          <form  action="ins_cotizacion.php" method="post" autocomplete="off">
         <?php endif; ?>
          <div class="row">
            <div class="col s2">
              <div class = "input-field">
                <input type="number" name="cotizacion" id="cotizacion" value="<?php echo $cotizacion ?>"readonly>
                <label for="cotizacion">Cotización</label>
              </div>
            </div>
            <div class="col s2">
              <div class = "input-field">
                <input type="number" name="orden_trabajo" id="orden_trabajo" value="<?php echo $orden_trabajo ?>"readonly>
                <label for="orden_trabajo">Orden Trabajo</label>
              </div>
            </div>
            <div class="col s2">
              <div class = "input-field">
                <input type="text" name="referencia" id="referencia" value="<?php echo $referencia ?>"autofocus>
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
              <div class="col s6">
                <div class = "input-field">
                  <input type="text" name="estado" id="estado" value="<?php echo estado_cotizacion($estado)?>"readonly>
                  <label for="estado">Estado</label>
                </div>
              </div>
              <div class="col s6">
                <?php   $log->info($estado);
                if ($estado == 0 && $cotizacion ==0): ?>
                  <a class="btn" href="#"name="cambia_estado" id="cambia_estado" disabled>APROBAR</a>
                <?php else: ?>
                  <a class="btn" href="up_estado.php?id=<?php echo $id?>&est=<?php echo $estado+1?>"name="cambia_estado" id="cambia_estado"><?php echo btn_estado_cotizacion($estado+1)?></a>
                <?php endif; ?>
              </div>
            </div>
            <div class="row">
              <div class="col s1">
                <div class = "input-field">
                  <input type="text" name="codigo" id="codigo" value="<?php echo cod_cliente($id_cliente) ?>"readonly>
                  <label for="codigo">Código</label>
                </div>
              </div>
              <div class="col s4">
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
                <label for="final">Numero Final</label>
              </div>
            </div>
          </div>
          <div class="row">
             <div class="col s3">
               <div class = "input-field">
                 <input type="date" class="datepicker" name="fecha_aprobado" id="fecha_aprobado" value="<?php echo $fecha_aprobado ?>"disabled>
                 <label for="fecha_aprobado">Fecha Aprobado</label>
               </div>
             </div>
             <div class="col s3">
               <div class = "input-field">
                 <input type="date" class="datepicker" name="fecha_ofrecido" id="fecha_ofrecido" value="<?php echo $fecha_ofrecido ?>"disabled>
                 <label for="fecha_ofrecido">Fecha Ofrecido</label>
               </div>
             </div>
             <div class="col s3">
               <div class = "input-field">
                 <input type="date" class="datepicker" name="fecha_facturado" id="fecha_facturado" value="<?php echo $fecha_facturado ?>"disabled>
                 <label for="fecha_facturado">Fecha Facturado</label>
               </div>
             </div>
             <div class="col s3">
               <div class = "input-field">
                 <input type="date" class="datepicker" name="fecha_liquidado" id="fecha_liquidado" value="<?php echo $fecha_liquidado ?>"disabled>
                 <label for="fecha_liquidado">Fecha Liquidado</label>
               </div>
             </div>
           </div>
           <!-- Inicia div expandible  -->
           <div class="row">
             <ul class="collapsible expandable"data-collapsible="expandable">
                <li>
                  <div class="collapsible-header"><i class="material-icons">vertical_split</i>Varios</div>
                  <div class="collapsible-body">
                    <div class="row">
                      <div class="col s12 m6">
                        <div class="card large blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Clasificación del Trabajo</span>
                            <div class="col s12">
                              <h6><center><b>tamaño del trabajo</b></center></h6>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="tamaño_trabajo"
                              id="peq" />
                              <label for="peq">PEQUEÑO</label>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="tamaño_trabajo"
                              id="med" />
                              <label for="med">MEDIANO</label>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="tamaño_trabajo"
                              id="gra" />
                              <label for="gra">GRANDE</label>
                            </div>
                            <div class="col s12">
                              <h6><center><b>forma del trabajo</b></center></h6>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="forma_trabajo"
                              id="rec" />
                              <label for="rec">RECTANGULAR </label>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="forma_trabajo"
                              id="esp" />
                              <label for="esp">ESPECIAL </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- inicia div Impresión -->
                      <div class="col s12 m6">
                        <div class="card large blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Impresión</span>
                            <div class="col s12">
                              <select id="lados_imprimir" name="lados_imprimir">
                                <option value="" selected disabled>SELECIONE LADOS A IMPRIMIR</option>
                                <option value="1">UN LADO</option>
                                <option value="2">FRENTE Y REVERSO</option>
                                <option value="3">TIRO Y RETIRO</option>
                              </select>
                            </div>
                            <div class="col s12">
                              <select id="modo_retiro" name="modo_retiro">
                                <option value="" selected disabled>SELECIONE MODO DE RETIRO</option>
                                <option value="1">CABEZA CON CABEZA</option>
                                <option value="2">CABEZA CON PIE</option>
                              </select>
                            </div>
                            <div class="col s12">
                              <h6><center><b>Molde y Distribución</b></center></h6>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="molde_ancho" id="molde_ancho" value=""readonly>
                                <label for="molde_ancho">Ancho</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="molde_ancho" id="molde_ancho" value=""readonly>
                                <label for="molde_ancho">Alto</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <h6><center><b>Área de Levantado de Texto</b></center></h6>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="area_levantado_ancho" id="area_levantado_ancho" value=""readonly>
                                <label for="area_levantado_ancho">Ancho</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="area_levantado_alto" id="area_levantado_alto" value=""readonly>
                                <label for="area_levantado_alto">Alto</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="text" name="Observacion_retiro" id="Observacion_retiro" value=""readonly>
                                <label for="Observacion_retiro">Observación Modo de Retiro</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- inicia div Troquel -->
                      <div class="col s12 m6">
                        <div class="card medium blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Troquel</span>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="number" name="num_troquel" id="num_troquel" value=""readonly>
                                <label for="num_troquel">Numero Troquel</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <select id="estado_inicial" name="estado_inicial">
                                <option value="" selected disabled>ESTADO INICIAL</option>
                                <option value="1">BUENO</option>
                                <option value="2">REGULAR</option>
                                <option value="3">MALO</option>
                              </select>
                            </div>
                            <div class="col s12 m6">
                              <select id="estado_final" name="estado_final">
                                <option value="" selected disabled>ESTADO FINAL</option>
                                <option value="1">BUENO</option>
                                <option value="2">REGULAR</option>
                                <option value="3">MALO</option>
                              </select>
                            </div>
                            <div class="col s12">
                              <select id="medio_corte" name="medio_corte">
                                <option value="" selected disabled>SELECIONE MEDIO CORTE</option>
                                <option value="1">FRENTE</option>
                                <option value="2">REVERSO</option>
                              </select>
                            </div>
                            <div class="col s12">
                              <h6><center><b>Tamaño del Troquel</b></center></h6>
                            </div>
                            <div class="col s6 ">
                              <div class = "input-field">
                                <input type="number" name="tamano_troquel_ancho" id="tamano_troquel_ancho" value=""readonly>
                                <label for="tamano_troquel_ancho">Ancho</label>
                              </div>
                            </div>
                            <div class="col s6 ">
                              <div class = "input-field">
                                <input type="number" name="tamano_troquel_alto" id="tamano_troquel_alto" value=""readonly>
                                <label for="tamano_troquel_alto">Alto</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- inicia div Arte -->
                      <div class="col s12 m6">
                        <div class="card medium blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Arte</span>
                            <div class="col s12">
                              <h6><center><b>Número de Montajes</b></center></h6>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="negativo_frente" id="negativo_frente" value=""readonly>
                                <label for="negativo_frente">Negativo Frente</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="negativo_reverso" id="negativo_reverso" value=""readonly>
                                <label for="negativo_reverso">Negativo Reverso</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="arte_frente" id="arte_frente" value=""readonly>
                                <label for="arte_frente">Arte Frente</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="arte_reverso" id="arte_reverso" value=""readonly>
                                <label for="arte_reverso">Arte Reverso</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="tamano_montaje" id="tamano_montaje" value=""readonly>
                                <label for="tamano_montaje">Tamaño de Montaje</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="lado_montaje" id="lado_montaje" value=""readonly>
                                <label for="lado_montaje">Lado del Montaje</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="number" name="complejidad_montaje" id="complejidad_montaje" value=""readonly>
                                <label for="complejidad_montaje">Nivel Complejidad del Montaje</label>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <!-- Inicia div Detalles -->
                      <div class="col s12 m6">
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Detalles</span>
                            <div class="col s12">
                              <div class = "input-field">
                                <textarea name="detalles" rows="8" cols="80" id="detalles"class="materialize-textarea"></textarea>
                                <label for="detalles">Detalles</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Inicia div M.S.C. -->
                      <div class="col s12 m6">
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                        <?php
                              $sel_lstck = $con->prepare('SELECT id, codigo, descripcion FROM lista_check WHERE id_compania=1 AND grupo =6');
                              $sel_lstck -> execute();
                              $sel_lstck -> bind_result($id, $codigo, $descripcion);
                               ?>

                              <span class="card-title">M.S.C.</span>
                              <?php while ($sel_lstck-> fetch()): ?>
                                <div class="col s12 m6">
                                  <input type="checkbox" class="filled-in" name="<?php echo $codigo?>"
                                  id="<?php echo $codigo?>" />
                                  <label for="<?php echo $codigo?>"><?php echo $descripcion?> </label>
                                </div>
                              <?php endwhile;
                              $sel_lstck ->close();
                              ?>


                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">format_color_fill</i>Tintas</div>
                  <div class="collapsible-body">
                    <div class="row">
                      <div class="col s12 ">
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                            <div class="col m3 s4">
                                <a class="btn" href="#">full color</a>
                              <div class = "input-field">
                                <input type="text" name="color" id="color" value="">
                                <label for="color">Color</label>
                              </div>
                              <div class = "input-field">
                                <input type="text" name="tintas_prep" id="tintas_prep" value="">
                                <label for="tintas_prep">Tinta a Preparar</label>
                              </div>
                            </div>
                            <div class="col m1 s2">
                              <br>
                              <br>
                              <br>
                              <a class="" href="#"><i class="material-icons">add </i></a>
                            </div>

                            <div class="col s12 m4">
                              <h6><center><b>Colores Pantones</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>Cyan<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Magenta<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Amarillo<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Negro<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Barniz<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                              </ul>
                            </div>
                            <div class="col s6 m4">
                              <select id="lados_imprimir" name="lados_imprimir">
                                <option value="" selected disabled>SELECIONE TIPO TINTA</option>
                                <option value="1">UN LADO</option>
                                <option value="2">FRENTE Y REVERSO</option>
                                <option value="3">TIRO Y RETIRO</option>
                              </select>
                              <div class="col s12">
                                <input type="radio" class="with-gap" name="donde_imprimir"
                                id="frente" />
                                <label for="frente">FRENTE</label>
                                <input type="radio" class="with-gap" name="donde_imprimir"
                                id="revez" />
                                <label for="revez">REVEZ</label>
                                <div class = "input-field">
                                <input type="text" name="gramos_tinta" id="gramos_tinta" value="">
                                <label for="gramos_tinta">Gramos Tinta</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">insert_drive_file</i>Papeles</div>
                  <div class="collapsible-body">
                    <div class="row">
                      <div class="col s12 ">
                        <div class="card x-large blue-grey lighten-5">
                          <div class="card-content">
                            <div class="col s12 m4">
                              <h6><center><b>Operaciones</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>Cyan<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                                <li class="collection-item"><div>Magenta<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                                <li class="collection-item"><div>Amarillo<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                                <li class="collection-item"><div>Negro<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                                <li class="collection-item"><div>Barniz<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                              </ul>
                              <div class="col s10">
                                <div class = "input-field">
                                  <input type="text" name="distribucion" id="distribucion" value="">
                                  <label for="distribucion">Distribucion</label>
                                </div>
                              </div>
                              <br><a class="" href="#"><i class="material-icons">add</i></a>
                              <h6><center><b>Perforas</b></center></h6>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="perforas_c" id="perforas_c" value="">
                                  <label for="perforas_c" style="padding-left: 45%;">C</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="perforas_p" id="perforas_p" value="">
                                  <label for="perforas_p" style="padding-left: 45%;">P</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="perforas_i" id="perforas_i" value="">
                                  <label for="perforas_i" style="padding-left: 45%;">I</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="perforas_d" id="perforas_d" value="">
                                  <label for="perforas_d" style="padding-left: 45%;">D</label>
                                </div>
                              </div>
                              <h6><center><b>Huecos</b></center></h6>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="huecos_c" id="huecos_c" value="">
                                  <label for="huecos_c" style="padding-left: 45%;">C</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="huecos_p" id="huecos_p" value="">
                                  <label for="huecos_p" style="padding-left: 45%;">P</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="huecos_i" id="huecos_i" value="">
                                  <label for="huecos_i" style="padding-left: 45%;">I</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="huecos_d" id="huecos_d" value="">
                                  <label for="huecos_d" style="padding-left: 45%;">D</label>
                                </div>
                              </div>
                            </div>
                            <div class="col s12 m4">
                              <h6><center><b>Operaciones Extras Asignadas</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>Cyan<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Magenta<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Amarillo<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Negro<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Barniz<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                              </ul>
                              <h6><center><b>Distribuición de Copias</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>Cyan<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Magenta<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Amarillo<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Negro<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>Barniz<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                              </ul>
                            </div>
                            <div class="col s12 m4">
                              <div class="col m6 s12">
                                <div class = "input-field">
                                  <input type="text" name="numero_hojas" id="numero_hojas" value="">
                                  <label for="numero_hojas">N° Hojas</label>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class = "input-field">
                                  <input type="text" name="numero_moldes" id="numero_moldes" value="">
                                  <label for="numero_moldes">N° Moldes</label>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class = "input-field">
                                  <input type="text" name="numero_tintas" id="numero_tintas" value="">
                                  <label for="numero_tintas">N° tintas</label>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class = "input-field">
                                  <input type="text" name="numero_tamanos" id="numero_tamanos" value="">
                                  <label for="numero_tamanos">N° Tamanos</label>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class = "input-field">
                                  <input type="text" name="numero_pliegos" id="numero_pliegos" value="">
                                  <label for="numero_pliegos">N° pliegos</label>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class = "input-field">
                                  <input type="text" name="numero_grupos" id="numero_grupos" value="">
                                  <label for="numero_grupos">N° Grupos</label>
                                </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="text" name="numero_cort_grupo" id="numero_cort_grupo" value="">
                                <label for="numero_cort_grupo">N° Corte x Grupos</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="text" name="numero_refiles" id="numero_refiles" value="">
                                <label for="numero_refiles">N° Refiles</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="text" name="numero_grupos" id="numero_grupos" value="">
                                <label for="numero_grupos">N° Grupo Refiles</label>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">print</i>Maquinas</div>
                  <div class="collapsible-body">
                    <div class="row">
                      <div class="col s12 ">
                        <div class="card large blue-grey lighten-5">
                          <div class="card-content">
                            <div class="col s12 m4">
                              <h6><center><b>Máquinas</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>XXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons">add</i></a></div> </li>
                              </ul>
                            </div>
                            <div class="col s12 m4">
                              <h6><center><b>Máquinas seleccionadas</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>xxxxxxxx<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>xxxxxxxx<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>xxxxxxxx<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>xxxxxxxx<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>xxxxxxxx<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                              </ul>
                            </div>
                            <div class="col s12 m4">
                              <div class="col m6 s12">
                                <div class = "input-field">
                                  <input type="text" name="papeles_numero_hojas" id="papeles_numero_hojas" value="">
                                  <label for="papeles_numero_hojas">N° Hojas</label>
                                </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="text" name="papeles_numero_copias" id="papeles_numero_copias" value="">
                                    <label for="papeles_numero_copias">N° Copias</label>
                                  </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="text" name="numero_tintas_montajes" id="numero_tintas_montajes" value="">
                                    <label for="numero_tintas_montajes">N° Montajes</label>
                                  </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="text" name="numero_tintas_lavados" id="numero_tintas_lavados" value="">
                                    <label for="numero_tintas_lavados">N° Lavados</label>
                                  </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="text" name="numero_moldes" id="numero_moldes" value="">
                                    <label for="numero_moldes">N° Moldes</label>
                                  </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="text" name="numero_mascaras" id="numero_mascaras" value="">
                                    <label for="numero_mascsras">N° Mascaras</label>
                                  </div>
                              </div>
                            </div>
                            <div class="col s12 m12">
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="numero_planchas" id="numero_planchas" value="">
                                  <label for="numero_planchas">N° Planchas</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="numero_quemados" id="numero_quemados" value="">
                                  <label for="numero_quemados">N° Quemados</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="numero_med_cortes" id="numero_med_cortes" value="">
                                  <label for="numero_med_cortes">N° 1/2 Cortes</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="numero_tiros_impresos" id="numero_tiros_impresos" value="">
                                  <label for="numero_tiros_impresos">N° Tiros Impresos</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="numero_tiros_troquel" id="numero_tiros_troquel" value="">
                                  <label for="numero_tiros_troquel">N° Tiros Troquel</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <input type="checkbox" class="filled-in" name="cobra_planchas"
                                id="cobra_planchas" />
                                <label for="cobra_planchas">¿Cobra Planchas? </label>
                              </div>
                              <div class="col m3 s6">
                                <input type="checkbox" class="filled-in" name="troquelado"
                                id="troquelado" />
                                <label for="troquelado">Troquelado </label>
                              </div>
                              <div class="col m3 s6">
                                <input type="checkbox" class="filled-in" name="impresion"
                                id="impresion" />
                                <label for="impresion">Impresión </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">style</i>Otros</div>
                  <div class="collapsible-body">
                    <div class="row">
                      <div class="col s12 ">
                        <div class="card large blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Servicios</span>
                            <div class="col m2 s6">
                              <h6><center><b>Arte y Diseño</b></center></h6>
                              <input type="checkbox" class="filled-in" name="boceto"
                              id="boceto" />
                              <label for="boceto">Boceto </label>
                              <input type="checkbox" class="filled-in" name="arte_final"
                              id="arte_final" />
                              <label for="arte_final">Arte Final</label>
                              <input type="checkbox" class="filled-in" name="seleccion"
                              id="seleccion" />
                              <label for="seleccion">Selección</label>
                              <input type="checkbox" class="filled-in" name="clises"
                              id="clises" />
                              <label for="clises">Clises</label>
                              <div class = "input-field">
                                <input type="text" name="numero_copias" id="numero_copias" value="">
                                <label for="numero_copias">N° Copias Laser</label>
                              </div>
                            </div>
                            <div class="col m2 s6">
                              <h6><center><b>Pruebas</b></center></h6>
                              <input type="checkbox" class="filled-in" name="prueba_laser"
                              id="prueba_laser" />
                              <label for="prueba_laser">Laser </label>
                              <br><br>
                              <input type="checkbox" class="filled-in" name="prueba_impresora"
                              id="prueba_impresora" />
                              <label for="prueba_impresora">Impresora</label>
                            </div>
                            <div class="col m2 s6">
                              <h6><center><b>Encolado</b></center></h6>
                              <input type="checkbox" class="filled-in" name="cabeza"
                              id="cabeza" />
                              <label for="cabeza">Cabeza </label>
                              <input type="checkbox" class="filled-in" name="pie"
                              id="pie" />
                              <label for="pie">Pie</label>
                              <input type="checkbox" class="filled-in" name="izquierdo"
                              id="izquierdo" />
                              <label for="izquierdo">L. Izquierdo</label>
                              <input type="checkbox" class="filled-in" name="derecho"
                              id="derecho" />
                              <label for="derecho">L. Derecho</label>
                              <div class = "input-field">
                                <input type="text" name="numero_encolados" id="numero_encolados" value="">
                                <label for="numero_encolados">N° Encolados</label>
                              </div>
                            </div>
                            <div class="col m3 s6">
                              <h6><center><b>Acabados</b></center></h6>
                              <input type="checkbox" class="filled-in" name="carbon_intercalado"
                              id="carbon_intercalado" />
                              <label for="carbon_intercalado">Carbón Intercalado </label>
                              <input type="checkbox" class="filled-in" name="coleccionado"
                              id="coleccionado" />
                              <label for="coleccionado">Coleccionado</label>
                              <input type="checkbox" class="filled-in" name="abrir_sobres"
                              id="abrir_sobres" />
                              <label for="abrir_sobres">AbrirSobres</label>
                              <div class = "input-field">
                                <input type="text" name="numero_dobleces" id="numero_dobleces" value="">
                                <label for="numero_dobleces">N° Dobleces</label>
                              </div>
                            </div>
                            <div class="col m3 s6">
                                <h6><center><b>Tipo Safado</b></center></h6>
                                <input type="radio" class="with-gap" name="tipo_safado"
                                id="libros" />
                                <label for="libros">Por Libros</label>
                                <input type="radio" class="with-gap" name="tipo_safado"
                                id="juegos" />
                                <label for="juegos">Por Juegos</label>
                                <h6><center><b>Control Calidad</b></center></h6>
                                <input type="radio" class="with-gap" name="control_calidad"
                                id="militar" />
                                <label for="militar">Militar</label>
                                <input type="radio" class="with-gap" name="control_calidad"
                                id="individual" />
                                <label for="individual">Individual</label>
                                <div class = "input-field">
                                  <input type="text" name="numero_grupos" id="numero_grupos" value="">
                                  <label for="numero_grupos">N° grupos</label>
                                </div>
                            </div>
                            <div class="col m2 s2">
                                <h6><center><b>Pegado de Cajas</b></center></h6>
                                <input type="checkbox" class="filled-in" name="pegar_cajas"
                                id="pegar_cajas" />
                                <label for="pegar_cajas">Pegar?</label>
                                <div class = "input-field">
                                  <input type="text" name="tipo_caja" id="tipo_caja" value="">
                                  <label for="tipo_caja">Tipo Caja</label>
                                </div>
                            </div>
                            <div class="col m5 s2">
                                <h6><center><b>Acabados </b></center></h6>
                                <div class="row">
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_remaches" id="numero_remaches" value="">
                                      <label for="numero_remaches">N° Remaches</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_grapas_libro" id="numero_grapas_libro" value="">
                                      <label for="numero_grapas_libro">N° Grapas Libro</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_grapas_huecos" id="numero_grapas_huecos" value="">
                                      <label for="numero_grapas_huecos">N° Grapas Huecos</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_huecos" id="numero_huecos" value="">
                                      <label for="numero_huecos">N° Huecos</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <div class="col m5 s2">
                                <h6><center><b>Empaques</b></center></h6>
                                <div class="row">
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_fajillas" id="numero_fajillas" value="">
                                      <label for="numero_fajillas">N° Fajillas</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_cajas" id="numero_cajas" value="">
                                      <label for="numero_cajas">N° Cajas</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_paquetes" id="numero_paquetes" value="">
                                      <label for="numero_paquetes">N° Paquetes</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="cantidad_x_paquete" id="cantidad_x_paquete" value="">
                                      <label for="cantidad_x_paquete">Cantidad X Paquete</label>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col s6">
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Negativos</span>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="cantidad_negativos" id="cantidad_negativos" value=""readonly>
                                <label for="cantidad_negativos">Cantidad</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <select id="tipo_negativo" name="tipo_negativo">
                                <option value="" selected disabled>TIPO NEGATIVO</option>
                                <option value="1">NEGATIVO</option>
                                <option value="2">ACETATO LECHOSO</option>
                                <option value="3">ACETATO TRANPARENTE</option>
                              </select>
                            </div>
                            <div class="col s8">
                              <h6><center><b>Tamaño del Negativo</b></center></h6>
                            </div>
                          </div>
                          <div class="col s12 m4">
                            <div class = "input-field">
                              <input type="number" name="tamano_negativo_ancho" id="tamano_negativo_ancho" value=""readonly>
                              <label for="tamano_negativo_ancho">Ancho</label>
                            </div>
                          </div>
                          <div class="col s12 m4">
                            <div class = "input-field">
                              <input type="number" name="tamano_negativo_alto" id="tamano_negativo_alto" value=""readonly>
                              <label for="tamano_negativo_alto">Alto</label>
                            </div>
                          </div>
                          <div class="col s12 m4">
                            <br>
                            <input type="checkbox" class="filled-in" name="cobra_negativo"
                            id="cobra_negativo" />
                            <label for="cobra_negativo">Cobra? </label>
                          </div>
                          </div>
                        </div>
                      <div class="col s6">
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Terceros</span>
                            <div class="col m3 s12">
                              <div class = "input-field">
                                <input type="text" name="servicio_tercero" id="servicio_tercero" value="">
                                <label for="servicio_tercero">Servicio</label>
                              </div>
                              <div class = "input-field">
                                <input type="text" name="costo_servicio" id="costo_servicio" value="">
                                <label for="costo_servicio">Costo</label>
                              </div>
                            </div>
                            <div class="col m1 s2">
                              <br>
                              <br>
                              <a class="" href="#"><i class="material-icons">add </i></a>
                            </div>
                            <div class="col s12 m8">
                              <h6><center><b>Servicios</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>XXXXXX ===>> 00000<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXX ===>> 00000<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXX ===>> 00000<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXX ===>> 00000<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col s6">
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Material Extra</span>
                            <div class="col m3 s12">
                              <div class = "input-field">
                                <input type="text" name="material_extra" id="material_extra" value="">
                                <label for="material_extra">Material</label>
                              </div>
                              <div class = "input-field">
                                <input type="text" name="cantidad_material" id="cantidad_material" value="">
                                <label for="cantidad_material">cantidad</label>
                              </div>
                            </div>
                            <div class="col m1 s2">
                              <br>
                              <br>
                              <a class="" href="#"><i class="material-icons">add </i></a>
                            </div>
                            <div class="col s12 m8">
                              <h6><center><b>Materiales</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>XXXXXX ===>> 00000<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXX ===>> 00000<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXX ===>> 00000<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXX ===>> 00000<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col s6">
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Operaciones Extras</span>
                            <div class="col s12 m6">
                              <h6><center><b>Extras</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>XXXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons green-text">add</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons green-text">add</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons green-text">add</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons green-text">add</i></a></div> </li>
                              </ul>
                            </div>
                            <div class="col s12 m6">
                              <h6><center><b>Extras Asignadas</b></center></h6>
                              <ul class="collection small">
                                <li class="collection-item"><div>XXXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                                <li class="collection-item"><div>XXXXXXXXX<a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div> </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">monetization_on</i>Costos</div>
                  <div class="collapsible-body">
                    <div class="row">
                      <div class="col m6 s12">
                        <div class="card xx-large blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Costos Estimados</span>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_m_obra" id="est_m_obra" value=""readonly>
                                <label for="est_m_obra">Mano de Obra</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_o_materiales" id="est_o_materiales" value=""readonly>
                                <label for="est_o_materiales">Otros Materiales</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_tintas" id="est_tintas" value=""readonly>
                                <label for="est_tintas">Tintas</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_indirectos" id="est_indirectos" value=""readonly>
                                <label for="est_indirectos">Indirectos</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_servicios_terceros" id="est_servicios_terceros" value=""readonly>
                                <label for="est_servicios_terceros">Servicios Terceros</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_costo_subtotal" id="est_costo_subtotal" value=""readonly>
                                <label for="est_costo_subtotal">Costo Subtotal</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_papeles" id="est_papeles" value=""readonly>
                                <label for="est_papeles">Papeles</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_costo_total" id="est_costo_total" value=""readonly>
                                <label for="est_costo_total">Costo Total</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <h6><center><b>Utilidad</b></center></h6>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_p_util_costo" id="est_p_util_costo" value=""readonly>
                                <label for="est_p_util_costo">Porcentaje</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_util_costo" id="est_util_costo" value=""readonly>
                                <label for="est_util_costo">Costo</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_p_util_papel" id="est_p_util_papel" value=""readonly>
                                <label for="est_p_util_papel">Porcentaje</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_util_papel" id="est_util_papel" value=""readonly>
                                <label for="est_util_papel">Papel</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_p_util_publicidad" id="est_p_util_publicidad" value=""readonly>
                                <label for="est_p_util_publicidad">Porcentaje</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_util_publicidad" id="est_util_publicidad" value=""readonly>
                                <label for="est_util_publicidad">Publicidad</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="number" name="precio_cliente" id="precio_cliente" value=""readonly>
                                <label for="precio_cliente">Precio al Cliente</label>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                      <div class="col m6 s12">
                        <div class="card xx-large blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Costos Reales</span>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="real_m_obra" id="real_m_obra" value=""readonly>
                                <label for="real_m_obra">Mano de Obra</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="real_o_materiales" id="real_o_materiales" value=""readonly>
                                <label for="real_o_materiales">Otros Materiales</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="real_tintas" id="real_tintas" value=""readonly>
                                <label for="real_tintas">Tintas</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="real_indirectos" id="real_indirectos" value=""readonly>
                                <label for="real_indirectos">Indirectos</label>
                              </div>
                          </div>
                          <div class="col s12 m6">
                            <div class = "input-field">
                              <input type="number" name="real_servicios_terceros" id="real_servicios_terceros" value=""readonly>
                              <label for="real_servicios_terceros">Servicios Terceros</label>
                            </div>
                          </div>
                          <div class="col s12 m6">
                            <div class = "input-field">
                              <input type="number" name="real_costo_subtotal" id="real_costo_subtotal" value=""readonly>
                              <label for="real_costo_subtotal">Costo Subtotal</label>
                            </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_papeles" id="real_papeles" value=""readonly>
                            <label for="real_papeles">Papeles</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_costo_total" id="real_costo_total" value=""readonly>
                            <label for="real_costo_total">Costo Total</label>
                          </div>
                        </div>
                        <div class="col s12">
                          <h6><center><b>Utilidad</b></center></h6>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_p_util_costo" id="real_p_util_costo" value=""readonly>
                            <label for="real_p_util_costo">Porcentaje</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_util_costo" id="real_util_costo" value=""readonly>
                            <label for="real_util_costo">Costo</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_p_util_papel" id="real_p_util_papel" value=""readonly>
                            <label for="real_p_util_papel">Porcentaje</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_util_papel" id="real_util_papel" value=""readonly>
                            <label for="real_util_papel">Papel</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_p_util_publicidad" id="real_p_util_publicidad" value=""readonly>
                            <label for="real_p_util_publicidad">Porcentaje</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_util_publicidad" id="real_util_publicidad" value=""readonly>
                            <label for="real_util_publicidad">Publicidad</label>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class = "input-field">
                            <input type="number" name="precio_cliente" id="precio_cliente" value=""readonly>
                            <label for="precio_cliente">Precio al Cliente</label>
                          </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </li>
              </ul>
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
<script type="text/javascript">
  $('#id_cliente').change(function(){
    var cli= $(this).val()
    console.log(cli);
    console.log(cod_cliente(cli));
    $('#codigo').val('<?php echo cod_cliente(5)?>');
  })

</script>
</body>
</html>
