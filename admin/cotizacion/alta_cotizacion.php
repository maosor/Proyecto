<?php include '../extend/header.php';
include '../conexion/conexion.php';
include '../extend/funciones.php';
include '../logic/tinta_controlador.php';
include '../logic/inventario_controlador.php';
include '../logic/maquina_controlador.php';
include '../logic/papel_controlador.php';
include '../logic/distribucion_controlador.php';
include '../logic/terceros_controlador.php';
include '../logic/extra_controlador.php';
include '../logic/operacion_controlador.php';
//include '../entidades/tinta.php';
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

  //Detalle
  $sel_cot_det = $con->prepare("SELECT tamano_trabajo, forma_trabajo, lados_imprimir, modo_retiro, molde_alto, molde_ancho, area_levantado_ancho, area_levantado_alto, observacion_retiro, num_troquel, estado_inicial,	estado_final, medio_corte, tamano_troquel_alto, tamano_troquel_ancho, negativo_frente, negativo_reverso,
    arte_frente, arte_reverso, tamano_montaje, lado_montaje, complejidad_montaje, detalles, tintas_prep,tipo_tinta, gramos_tinta, donde_imprimir, numero_hojas, numero_moldes, numero_tintas, numero_tamanos,	numero_pliegos, numero_grupos, numero_cort_grupo, numero_refiles, perforas_c, perforas_p, perforas_i,	perforas_d, huecos_c, huecos_p, huecos_i, huecos_d, papeles_numero_copias, papeles_numero_hojas,
    numero_tintas_montajes,numero_tintas_lavados, papeles_numero_moldes, numero_mascaras, numero_planchas,numero_quemados, numero_med_cortes, numero_tiros_impresos, numero_tiros_troquel, cobra_planchas, troquelado, impresion, cantidad_negativos, tipo_negativo, tamano_negativo_alto, tamano_negativo_ancho, 	cobra_negativo, material_extra, cantidad_x_paquete, tipo_caja, cantidad_material, numero_copias,
    numero_cajas, numero_dobleces, numero_encolados, numero_fajillas, numero_grapas_huecos, numero_grapas_libro,numero_huecos, numero_paquetes, numero_remaches, est_m_obra, est_o_materiales, est_tintas, est_indirectos, 	est_servicios_terceros, est_costo_subtotal, est_papeles, est_costo_total, est_p_util_costo, est_util_costo,	est_p_util_papel, est_util_papel, est_p_util_publicidad, est_util_publicidad, est_precio_cliente, real_m_obra,
    real_o_materiales, real_tintas, real_indirectos, real_servicios_terceros, real_costo_subtotal, real_papeles,real_costo_total, real_p_util_costo, real_util_costo, real_p_util_papel, real_util_papel, real_p_util_publicidad, real_util_publicidad, real_precio_cliente,control_calidad,tipo_safado FROM cotizacion_detalle WHERE cotizacion = ? ");
  $sel_cot_det->bind_param('i', $cotizacion);
  $sel_cot_det->execute();
  $log->info('Va consultar'.$cotizacion);
  $sel_cot_det->bind_result( $tamano_trabajo, $forma_trabajo, $lados_imprimir, $modo_retiro, $molde_alto,
  $molde_ancho, $area_levantado_ancho, $area_levantado_alto, $observacion_retiro, $num_troquel, $estado_inicial,
  $estado_final, $medio_corte, $tamano_troquel_alto, $tamano_troquel_ancho, $negativo_frente, $negativo_reverso,
  $arte_frente, $arte_reverso, $tamano_montaje, $lado_montaje, $complejidad_montaje, $detalles, $tintas_prep,
  $tipo_tinta, $gramos_tinta, $donde_imprimir, $numero_hojas, $numero_moldes, $numero_tintas, $numero_tamanos,
  $numero_pliegos, $numero_grupos, $numero_cort_grupo, $numero_refiles, $perforas_c, $perforas_p, $perforas_i,
  $perforas_d, $huecos_c, $huecos_p, $huecos_i, $huecos_d, $papeles_numero_copias, $papeles_numero_hojas,
  $numero_tintas_montajes,$numero_tintas_lavados, $papeles_numero_moldes, $numero_mascaras, $numero_planchas,
  $numero_quemados, $numero_med_cortes, $numero_tiros_impresos, $numero_tiros_troquel, $cobra_planchas,
  $troquelado, $impresion, $cantidad_negativos, $tipo_negativo, $tamano_negativo_alto, $tamano_negativo_ancho,
  $cobra_negativo, $material_extra, $cantidad_x_paquete, $tipo_caja, $cantidad_material, $numero_copias,
  $numero_cajas, $numero_dobleces, $numero_encolados, $numero_fajillas, $numero_grapas_huecos, $numero_grapas_libro,
  $numero_huecos, $numero_paquetes, $numero_remaches, $est_m_obra, $est_o_materiales, $est_tintas, $est_indirectos,
  $est_servicios_terceros, $est_costo_subtotal, $est_papeles, $est_costo_total, $est_p_util_costo, $est_util_costo,
  $est_p_util_papel, $est_util_papel, $est_p_util_publicidad, $est_util_publicidad, $est_precio_cliente, $real_m_obra,
  $real_o_materiales, $real_tintas, $real_indirectos, $real_servicios_terceros, $real_costo_subtotal, $real_papeles,
  $real_costo_total, $real_p_util_costo, $real_util_costo, $real_p_util_papel, $real_util_papel, $real_p_util_publicidad,
  $real_util_publicidad, $real_precio_cliente, $control_calidad, $tipo_safado);
  $sel_cot_det->fetch();
  $accion = 'Actualizar';
  $log->info('valor del $molde_ancho '.$molde_ancho);


  $sel_cot_det -> close();


}
else {
  $orden_trabajo= ''; $cotizacion= ''; $orden_compra= ''; $fecha_pedido= ''; $fecha_aprobado= ''; $fecha_ofrecido= '';
  $fecha_facturado= ''; $fecha_liquidado= ''; $estado= null; $id_cliente= ''; $referencia= ''; $id_trabajo= ''; $recibido= ''; $sobre_tecnico= '';
  $negativo= ''; $plancha= ''; $recurso= ''; $libros_articulos= ''; $hojas= ''; $copias= ''; $inicio= ''; $final= '';
  $accion = 'Insertar';

  //Detalles
  $tamano_trabajo=''; $forma_trabajo=''; $lados_imprimir=''; $modo_retiro=''; $molde_alto='';
    $molde_ancho=''; $area_levantado_ancho=''; $area_levantado_alto=''; $observacion_retiro=''; $num_troquel=''; $estado_inicial='';
    $estado_final=''; $medio_corte=''; $tamano_troquel_alto=''; $tamano_troquel_ancho=''; $negativo_frente=''; $negativo_reverso='';
    $arte_frente=''; $arte_reverso=''; $tamano_montaje=''; $lado_montaje=''; $complejidad_montaje=''; $detalles=''; $tintas_prep='';
    $tipo_tinta=''; $gramos_tinta=''; $donde_imprimir=''; $numero_hojas=''; $numero_moldes=''; $numero_tintas=''; $numero_tamanos='';
    $numero_pliegos=''; $numero_grupos=''; $numero_cort_grupo=''; $numero_refiles=''; $perforas_c=''; $perforas_p=''; $perforas_i='';
    $perforas_d=''; $huecos_c=''; $huecos_p=''; $huecos_i=''; $huecos_d=''; $papeles_numero_copias=''; $papeles_numero_hojas='';
    $numero_tintas_montajes='';$numero_tintas_lavados=''; $papeles_numero_moldes=''; $numero_mascaras=''; $numero_planchas='';
    $numero_quemados=''; $numero_med_cortes=''; $numero_tiros_impresos=''; $numero_tiros_troquel=''; $cobra_planchas='';
    $troquelado=''; $impresion=''; $cantidad_negativos=''; $tipo_negativo=''; $tamano_negativo_alto=''; $tamano_negativo_ancho='';
    $cobra_negativo=''; $material_extra=''; $cantidad_x_paquete=''; $tipo_caja=''; $cantidad_material=''; $numero_copias='';
    $numero_cajas=''; $numero_dobleces=''; $numero_encolados=''; $numero_fajillas=''; $numero_grapas_huecos=''; $numero_grapas_libro='';
    $numero_huecos=''; $numero_paquetes=''; $numero_remaches=''; $est_m_obra=''; $est_o_materiales=''; $est_tintas=''; $est_indirectos='';
    $est_servicios_terceros=''; $est_costo_subtotal=''; $est_papeles=''; $est_costo_total=''; $est_p_util_costo=''; $est_util_costo='';
    $est_p_util_papel=''; $est_util_papel=''; $est_p_util_publicidad=''; $est_util_publicidad=''; $est_precio_cliente=''; $real_m_obra='';
    $real_o_materiales=''; $real_tintas=''; $real_indirectos=''; $real_servicios_terceros=''; $real_costo_subtotal=''; $real_papeles='';
    $real_costo_total=''; $real_p_util_costo=''; $real_util_costo=''; $real_p_util_papel=''; $real_util_papel=''; $real_p_util_publicidad='';
    $real_util_publicidad=''; $real_precio_cliente='';$control_calidad='';$tipo_safado='';
}
$compania= $_SESSION['compania'];
$sel = $con->prepare("SELECT id, nombre FROM clientes WHERE id_compania = ? ");
$sel->bind_param('i', $compania);
$sel->execute();
$sel->bind_result($id_cli, $nombre);
?>
<!-- MID: <?php echo gethostname()?>-->
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
            <input type="hidden" name="id" id="id"value="<?php echo $id ?>">
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
                              <input type="radio" class="with-gap" name="tamano_trabajo"
                              id="peq" <?php $accion == 'Actualizar'? $tamano_trabajo == '1'? print 'checked':'' : print 'checked'; ?> value = '1'>
                              <label for="peq">PEQUEÑO</label>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="tamano_trabajo"
                              id="med" <?php $tamano_trabajo == '2'? print 'checked':''; ?> value = '2'>
                              <label for="med">MEDIANO</label>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="tamano_trabajo"
                              id="gra" <?php $tamano_trabajo == '3'? print 'checked':''; ?> value = '3'>
                              <label for="gra">GRANDE</label>
                            </div>
                            <div class="col s12">
                              <h6><center><b>forma del trabajo</b></center></h6>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="forma_trabajo"
                              id="rec" <?php $accion == 'Actualizar'? $forma_trabajo == '1'? print 'checked':'' : print 'checked'; ?> value = '1'/>
                              <label for="rec">RECTANGULAR </label>
                              <br>
                              <br>
                              <input type="radio" class="with-gap" name="forma_trabajo"
                              id="esp" <?php $forma_trabajo == '2'? print 'checked':''; ?> value = '2' />
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
                                <?php if ($accion == 'Actualizar'): ?>
                                  <option value="<?php echo $lados_imprimir ?>" selected ><?php echo lados_imprimir($lados_imprimir) ?></option>
                                <?php else: ?>
                                  <option value="" selected disabled>SELECIONE LADOS A IMPRIMIR</option>
                                <?php endif; ?>
                                  <option value="1">UN LADO</option>
                                  <option value="2">FRENTE Y REVERSO</option>
                                  <option value="3">TIRO Y RETIRO</option>
                              </select>
                            </div>
                            <div class="col s12">
                              <select id="modo_retiro" name="modo_retiro">
                                <?php if ($accion == 'Actualizar'): ?>
                                  <option value="<?php echo $modo_retiro ?>" selected ><?php echo modo_retiro($modo_retiro) ?></option>
                                <?php else: ?>
                                  <option value="" selected disabled>SELECIONE MODO DE RETIRO</option>
                                <?php endif; ?>
                                  <option value="1">CABEZA CON CABEZA</option>
                                  <option value="2">CABEZA CON PIE</option>
                              </select>
                            </div>
                            <div class="col s12">
                              <h6><center><b>Tamaño Molde y Distribución</b></center></h6>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="molde_ancho" id="molde_ancho" value="<?php echo $molde_ancho ?>">
                                <label for="molde_ancho">Ancho</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="molde_alto" id="molde_alto" value="<?php echo $molde_alto?>">
                                <label for="molde_alto">Alto</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <h6><center><b>Área de Levantado de Texto</b></center></h6>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="area_levantado_ancho" id="area_levantado_ancho" value="<?php echo $area_levantado_ancho ?>">
                                <label for="area_levantado_ancho">Ancho</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="area_levantado_alto" id="area_levantado_alto" value="<?php echo $area_levantado_alto ?>">
                                <label for="area_levantado_alto">Alto</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="text" name="observacion_retiro" id="observacion_retiro" value="<?php echo $observacion_retiro ?>">
                                <label for="observacion_retiro">Observación Modo de Retiro</label>
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
                                <input type="number" name="num_troquel" id="num_troquel" value="<?php echo $num_troquel ?>">
                                <label for="num_troquel">Numero Troquel</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <select id="estado_inicial" name="estado_inicial">
                              <?php if ($accion == 'Actualizar'): ?>
                                <option value="<?php echo $estado_inicial ?>" selected ><?php echo estado($estado_inicial) ?></option>
                              <?php else: ?>
                                <option value="" selected disabled>ESTADO INICIAL</option>
                              <?php endif; ?>
                                <option value="1">BUENO</option>
                                <option value="2">REGULAR</option>
                                <option value="3">MALO</option>
                              </select>
                            </div>
                            <div class="col s12 m6">
                              <select id="estado_final" name="estado_final">
                              <?php if ($accion == 'Actualizar'): ?>
                                <option value="<?php echo $estado_final ?>" selected ><?php echo estado($estado_final) ?></option>
                              <?php else: ?>
                                <option value="" selected disabled>ESTADO FINAL</option>
                              <?php endif; ?>
                                <option value="1">BUENO</option>
                                <option value="2">REGULAR</option>
                                <option value="3">MALO</option>
                              </select>
                            </div>
                            <div class="col s6">
                              <select id="medio_corte" name="medio_corte">
                              <?php if ($accion == 'Actualizar'): ?>
                                <option value="<?php echo $medio_corte ?>" selected ><?php echo medio_corte($medio_corte) ?></option>
                              <?php else: ?>
                                <option value="" selected disabled>SELECIONE MEDIO CORTE</option>
                              <?php endif; ?>
                                <option value="1">FRENTE</option>
                                <option value="2">REVERSO</option>
                              </select>
                            </div>
                            <div class="col m3 s6">
                              <input type="checkbox" class="filled-in" name="es_troquelado"
                              id="es_troquelado" />
                              <label for="es_troquelado">Troquelado </label>
                            </div>
                            <div class="col s12">
                              <h6><center><b>Tamaño del Troquel</b></center></h6>
                            </div>
                            <div class="col s6 ">
                              <div class = "input-field">
                                <input type="number" name="tamano_troquel_ancho" id="tamano_troquel_ancho" value="<?php echo $tamano_troquel_ancho ?>">
                                <label for="tamano_troquel_ancho">Ancho</label>
                              </div>
                            </div>
                            <div class="col s6 ">
                              <div class = "input-field">
                                <input type="number" name="tamano_troquel_alto" id="tamano_troquel_alto" value="<?php echo $tamano_troquel_alto ?>">
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
                            <div class="col s6" style="display: none;">
                              <div class = "input-field">
                                <input type="number" name="negativo_frente" id="negativo_frente" value="<?php echo $negativo_frente ?>">
                                <label for="negativo_frente">Negativo Frente</label>
                              </div>
                            </div>
                            <div class="col s6" style="display: none;">
                              <div class = "input-field">
                                <input type="number" name="negativo_reverso" id="negativo_reverso" value="<?php echo $negativo_reverso ?>">
                                <label for="negativo_reverso">Negativo Reverso</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="arte_frente" id="arte_frente" value="<?php echo $arte_frente ?>">
                                <label for="arte_frente">Arte Frente</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="arte_reverso" id="arte_reverso" value="<?php echo $arte_reverso ?>">
                                <label for="arte_reverso">Arte Reverso</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="number" name="tamano_montaje" id="tamano_montaje" value="<?php echo $tamano_montaje ?>">
                                <label for="tamano_montaje">Tamaño de Montaje</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                                <input type="text" name="lado_montaje" id="lado_montaje" value="<?php echo $tamano_montaje ?>">
                                <label for="lado_montaje">Lado del Montaje</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="text" name="complejidad_montaje" id="complejidad_montaje" value="<?php echo $complejidad_montaje ?>">
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
                          $sel_lstck = $con->prepare('SELECT codigo FROM cotizacion_lista_check WHERE id_compania= ? AND cotizacion= ? ');
                          $sel_lstck -> bind_param('si', $compania, $cotizacion);
                          $sel_lstck -> execute();
                          $sel_lstck -> bind_result($codigo);

                          $array = array();
                          while ($sel_lstck-> fetch()){
                            $array[]= $codigo;
                          }
                          $sel_lstck ->close();
                              $sel_lstck = $con->prepare('SELECT id, codigo, descripcion FROM lista_check WHERE id_compania= ? AND grupo =6');
                              $sel_lstck -> bind_param('s', $compania);
                              $sel_lstck -> execute();
                              $sel_lstck -> bind_result($id, $codigo, $descripcion);

                               ?>
                              <span class="card-title">M.S.C.</span>
                              <?php while ($sel_lstck-> fetch()): ?>
                                <div class="col s12 m6">
                                  <input type="checkbox" class="filled-in" name="<?php echo $codigo?>"
                                  id="<?php echo $codigo?>" value = "<?php echo $codigo?>" <?php  in_array($codigo, $array)? print 'checked':''?>/>
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
                                <a class="btn" onclick="add_fullcolor()">full color</a>
                              <div class = "input-field">
                                <input type="text" name="color" id="color" value="">
                                <label class ='active' for="color">Color</label>
                              </div>
                              <div class = "input-field">
                                <input type="number" name="tintas_prep" id="tintas_prep" value="<?php echo $tintas_prep ?>">
                                <label class ='active' for="tintas_prep">Tintas a Preparar</label>
                                <div class = "input-field">
                                  <input type="number" name="num_tirajes" id="num_tirajes" value="<?php echo $num_tirajes ?>">
                                  <label class="active" for="num_tirajes">Numero de tirajes</label>
                                </div>
                              </div>
                            </div>
                            <div class="col m1 s2">
                              <br>
                              <br>
                              <br>
                              <a class="btn-floating" onclick="add_item()"><i class="material-icons">add </i></a>
                            </div>
                            <div id="lstcolores" class="col s12 m4">
                              <h6><center><b>Colores Pantones</b></center></h6>
                              <ul class="collection small">
                                <?php $tinta = new TintaControlador();
                                if ($accion == 'Actualizar'){
                                  $activo = 'active';
                                  foreach ($tinta->getLista_Tintas_Cotizacion($con, $compania, $cotizacion) as $key => $value){
                                   ?>

                                  <li id="color_<?php echo $value->id?>" class="listacolores collection-item <?php echo $activo?>"><div><?php echo $value->color?><a id= "<?php echo $value->color?>" class="eliminar_color secondary-content" ><i class="material-icons red-text">remove</i></a></div> </li>
                                <?php $activo = '';
                              } ?>
                              <input type="hidden" id ="arrcolores" name="arrcolores" value ="<?php echo $tinta->getListaColores()?>">
                              <?php
                              } ?>
                              </ul>
                            </div>
                            <div class="col s6 m4">
                              <select id="tipo_tinta" name="tipo_tinta">
                              <?php

                               if ($accion == 'Actualizar'): ?>
                                <option value="<?php echo $tipo_tinta ?>" selected ><?php echo $tinta->getTipo_Tinta($con,$tipo_tinta) ?></option>
                              <?php else: ?>
                                <option value="" selected disabled>SELECIONE TIPO TINTA</option>
                              <?php endif; ?>
                              <?php
                              foreach ($tinta->getLista_Tintas($con, $compania) as $valor) {
                              ?>
                                <option value="<?php echo $valor[0]?>"><?php echo $valor[1]?></option>
                              <?php
                             }
                             ?>
                              </select>
                              <div class="col s12">
                              <h6><center><b>¿Donde Imprimir?</b></center></h6>
                              <input type="radio" class="with-gap" name="donde_imprimir"
                              id="frente" <?php $accion == 'Actualizar'? $donde_imprimir == '1'? print 'checked':'' : print 'checked'; ?> value="1"/>
                              <label class ='active' for="frente">FRENTE</label>
                              <input type="radio" class="with-gap" name="donde_imprimir"
                              id="revez" <?php $donde_imprimir == '2'? print 'checked':''; ?> value="2"/>
                              <label class ='active'for="revez">REVEZ</label>
                              <div class = "input-field">
                              <input type="number" name="gramos_tinta" id="gramos_tinta" value="<?php echo $gramos_tinta ?>">
                              <label class ='active' for="gramos_tinta">Gramos Tinta</label>

                            </div>
                              <div class="col s6">
                                <div class = "input-field">
                                <input type="number" name="tinta_alto" id="tinta_alto" value="<?php echo $tinta_alto ?>">
                                <label class ='active' for="tinta_alto">Alto</label>
                              </div>
                            </div>
                            <div class="col s6">
                              <div class = "input-field">
                              <input type="number" name="tinta_ancho" id="tinta_ancho" value="<?php echo $tinta_ancho ?>">
                              <label class ='active' for="tinta_ancho">Ancho</label>
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
                              <h6><center><b>Papeles</b></center></h6>
                              <ul class="collection small">
                                <?php $inventario = new InventarioControlador();
                                 foreach ($inventario->getLista_Inventario($con, $compania, 1) as $inv){?>
                                  <li id="<?php echo $inv[1]?>" class="collection-item" style="max-width: 280px;" data-alto = "<?php echo $inv[3]?>" data-ancho="<?php echo $inv[4]?>"><div><?php echo $inv[2]?><a id ="<?php echo $inv[1]?>" class="agregar-papel secondary-content" ><i class="material-icons">add</i></a></div> </li>
                                <?php } ?>
                              </ul>
                              <div class="col s10">
                                <div class = "input-field">
                                  <input type="text" name="distribucion" id="distribucion" value="">
                                  <label for="distribucion">Distribucion</label>
                                </div>
                              </div>
                              <br><a class="btn-floating" onclick="add_distribucion()"><i class="material-icons">add</i></a>
                              <h6><center><b>Perforas</b></center></h6>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="perforas_c" id="perforas_c" value="<?php echo $perforas_c ?>">
                                  <label for="perforas_c" style="padding-left: 45%;">C</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="perforas_p" id="perforas_p" value="<?php echo $perforas_p ?>">
                                  <label for="perforas_p" style="padding-left: 45%;">P</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="perforas_i" id="perforas_i" value="<?php echo $perforas_i ?>">
                                  <label for="perforas_i" style="padding-left: 45%;">I</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="perforas_d" id="perforas_d" value="<?php echo $perforas_d ?>">
                                  <label for="perforas_d" style="padding-left: 45%;">D</label>
                                </div>
                              </div>
                              <h6><center><b>Huecos</b></center></h6>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="huecos_c" id="huecos_c" value="<?php echo $huecos_c ?>">
                                  <label for="huecos_c" style="padding-left: 45%;">C</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="huecos_p" id="huecos_p" value="<?php echo $huecos_p ?>">
                                  <label for="huecos_p" style="padding-left: 45%;">P</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="huecos_i" id="huecos_i" value="<?php echo $huecos_i ?>">
                                  <label for="huecos_i" style="padding-left: 45%;">I</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="text" name="huecos_d" id="huecos_d" value="<?php echo $huecos_d ?>">
                                  <label for="huecos_d" style="padding-left: 45%;">D</label>
                                </div>
                              </div>

                            </div>
                            <div class="col s12 m4">
                              <div id="lstpapeles" class="s12">
                                <h6><center><b>Papeles seleccionados</b></center></h6>
                                <ul class="collection small">
                                  <?php $clspapel= new PapelControlador();
                                     if ($accion == 'Actualizar'){
                                       $papelactivo = 'active';
                                      // print_r($clspapel->getLista_Papel_Cotizacion($con, $compania, $cotizacion));
                                       foreach ($clspapel->getLista_Papel_Cotizacion($con, $compania, $cotizacion) as $key => $value){ ?>
                                         <li id="papel_<?php echo $value->papel?>" class="listapapeles collection-item <?php echo $papelactivo?>"><div><?php echo $clspapel->getNombrePapel($con, $compania,$value->papel)?><a id="<?php echo $value->papel?>" class="eliminar_papel secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
                                        <?php $log->info('Papel: '.$value->papel);
                                        $papelactivo = '';
                                   } ?>
                                   <input type="hidden" id ="arrpapel" name="arrpapel" value ="<?php echo $clspapel->getListaPapeles()?>">
                                  <?php } ?>
                                </ul>
                                </div>
                                <div id="lstdistribuciones"class="s12">
                                  <h6><center><b>Distribuición de Copias</b></center></h6>
                                  <ul class="collection small">
                                    <?php $clsdistribucion= new DistribucionControlador();
                                       if ($accion == 'Actualizar'){
                                         $distribucionactiva = 'active';
                                         foreach ($clsdistribucion->getLista_Distribuciones_Cotizacion($con, $compania, $cotizacion) as $key => $value){ ?>
                                           <li id="distribucion_<?php echo $value->distribucion?>" class="listadistribuciones collection-item <?php echo $distribucionactivo?>"><div><?php echo$value->distribucion?><a id="<?php echo $value->distribucion?>" class="eliminar_distribucion secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
                                          <?php $log->info('Distribucion: '.$value->distribucion);
                                          $distribucionactiva = '';
                                     } ?>
                                     <input type="hidden" id ="arrdistribucion" name="arrdistribucion" value ="<?php echo $clsdistribucion->getListaDistribuciones()?>">
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col s12 m4">
                              <div class="col blue-grey lighten-4">
                                <center>
                                  Tamaño pliego
                                </center>
                                <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" step="0.01" name="ancho_tamano_pliego" id="ancho_tamano_pliego" value="<?php echo $ancho_tamano_pliego ?>">
                                    <label for="ancho_tamano_pliego">Ancho</label>
                                  </div>
                                </div>
                                <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" step="0.01" name="alto_tamano_pliego" id="alto_tamano_pliego" value="<?php echo $alto_tamano_pliego ?>">
                                    <label for="alto_tamano_pliego">Alto</label>
                                  </div>
                                </div>
                                <center>
                                  Tamaño Corte
                                </center>
                                <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" step="0.01" name="ancho_tamano_corte" id="ancho_tamano_corte" value="<?php echo $ancho_tamano_corte ?>">
                                    <label for="ancho_tamano_corte">Ancho</label>
                                  </div>
                                </div>
                                <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" step="0.01"name="alto_tamano_corte" id="alto_tamano_corte" value="<?php echo $alto_tamano_corte ?>">
                                    <label for="alto_tamano_corte">Alto</label>
                                  </div>
                                </div>
                                <center>
                                  Corte final
                                </center>
                                <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" step="0.01" name="ancho_corte_final" id="ancho_corte_final" value="<?php echo $ancho_corte_final ?>">
                                    <label for="ancho_corte_final">Ancho</label>
                                  </div>
                                </div>
                                <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" step="0.01" name="alto_corte_final" id="alto_corte_final" value="<?php echo $alto_corte_final ?>">
                                    <label for="alto_corte_final">Alto</label>
                                  </div>
                                </div>
                              </div>

                              <center>
                                Numero o cantidad
                              </center>
                              <div class="col m4 s12">
                                <div class = "input-field">
                                  <input type="number" name="numero_hojas" id="numero_hojas" value="<?php echo $numero_hojas ?>">
                                  <label for="numero_hojas">Hojas</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class = "input-field">
                                  <input type="number" name="numero_moldes" id="numero_moldes" value="<?php echo $numero_moldes ?>">
                                  <label for="numero_moldes">Moldes</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class = "input-field">
                                  <input type="number" name="numero_tintas" id="numero_tintas" value="<?php echo $numero_tintas ?>">
                                  <label for="numero_tintas">Tintas</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class = "input-field">
                                  <input type="number" name="numero_tamanos" id="numero_tamanos" value="<?php echo $numero_tamanos ?>">
                                  <label for="numero_tamanos">Tamaños</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class = "input-field">
                                  <input type="number" name="numero_pliegos" id="numero_pliegos" value="<?php echo $numero_pliegos ?>">
                                  <label for="numero_pliegos">Pliegos</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class = "input-field">
                                  <input type="number" name="numero_grupos" id="numero_grupos" value="<?php echo $numero_grupos ?>">
                                  <label for="numero_grupos">Grupos</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                              <div class = "input-field">
                                <input type="text" name="numero_cort_grupo" id="numero_cort_grupo" value="<?php echo $numero_cort_grupo ?>">
                                <label for="numero_cort_grupo">Cortes x Grupos</label>
                              </div>
                            </div>
                            <div class="col m4 s12">
                              <div class = "input-field">
                                <input type="number" name="numero_refiles" id="numero_refiles" value="<?php echo $numero_refiles ?>">
                                <label for="numero_refiles">Refiles</label>
                              </div>
                            </div>
                            <div class="col m4 s12">
                              <div class = "input-field">
                                <input type="number" name="numero_grupos" id="numero_grupos" value="<?php echo $numero_grupos ?>">
                                <label for="numero_grupos">Grupo Refiles</label>
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
                                <?php $maquina = new MaquinaControlador();
                                 foreach ($maquina->getLista_Maquina($con, $compania) as $maq){?>
                                   <li id="<?php echo $maq[1]?>" class="collection-item" style="max-width: 280px;"><div><?php echo $maq[2]?><a href="#" class="agregar-maquina secondary-content" id = "<?php echo $maq[2] ?>"><i class="material-icons">add</i></a></div> </li>
                                   <li></li>
                                <?php } ?>
                              </ul>

                            </div>
                            <div id ="lstmaquinas" class="col s12 m4">
                              <h6><center><b>Máquinas seleccionadas</b></center></h6>
                              <ul class="collection small">
                                <?php //$maquina = new MaquinaControlador();
                               if ($accion == 'Actualizar'){
                                 $maquinaactiva = 'active';
                                 foreach ($maquina->getLista_Maquina_Cotizacion($con, $compania, $cotizacion) as $key => $value){ ?>
                                   <li id="maquina_<?php echo $value->id?>" class="listamaquinas collection-item <?php echo $maquinaactiva?>"><div><?php echo $value->maquina?><a id="<?php echo $value->id?>" class="eliminar_maquina secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
                                  <?php $log->info('Maquina: '.$value->maquina);
                                  $maquinaactiva = '';
                             } ?>
                             <input type="hidden" id ="arrmaquina" name="arrmaquina" value ="<?php echo $maquina->getListaMaquinas()?>">
                           <?php } ?>
                              </ul>
                            </div>
                            <div class="col s12 m4">
                              <div class="col m6 s12">
                                <div class = "input-field">
                                  <input type="number" name="papeles_numero_hojas" id="papeles_numero_hojas" value="<?php echo $numero_grupos ?>">
                                  <label for="papeles_numero_hojas">N° Hojas</label>
                                </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" name="papeles_numero_copias" id="papeles_numero_copias" value="<?php echo $papeles_numero_copias ?>">
                                    <label for="papeles_numero_copias">N° Copias</label>
                                  </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" name="numero_tintas_montajes" id="numero_tintas_montajes" value="<?php echo $numero_tintas_montajes ?>">
                                    <label for="numero_tintas_montajes">N° Montajes</label>
                                  </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" name="numero_tintas_lavados" id="numero_tintas_lavados" value="<?php echo $numero_tintas_lavados ?>">
                                    <label for="numero_tintas_lavados">N° Lavados</label>
                                  </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" name="papeles_numero_moldes" id="papeles_numero_moldes" value="<?php echo $papeles_numero_moldes ?>">
                                    <label for="papeles_numero_moldes">N° Moldes</label>
                                  </div>
                              </div>
                              <div class="col m6 s12">
                                  <div class = "input-field">
                                    <input type="number" name="numero_mascaras" id="numero_mascaras" value="<?php echo $numero_mascaras ?>">
                                    <label for="numero_mascsras">N° Mascaras</label>
                                  </div>
                              </div>
                            </div>
                            <div class="col s12 m12">
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="number" name="numero_planchas" id="numero_planchas" value="<?php echo $numero_planchas ?>">
                                  <label for="numero_planchas">N° Planchas</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="number" name="numero_quemados" id="numero_quemados" value="<?php echo $numero_quemados ?>">
                                  <label for="numero_quemados">N° Quemados</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="number" name="numero_med_cortes" id="numero_med_cortes" value="<?php echo $numero_med_cortes ?>">
                                  <label for="numero_med_cortes">N° 1/2 Cortes</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="number" name="numero_tiros_impresos" id="numero_tiros_impresos" value="<?php echo $numero_tiros_impresos ?>">
                                  <label for="numero_tiros_impresos">N° Tiros Impresos</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <div class = "input-field">
                                  <input type="number" name="numero_tiros_troquel" id="numero_tiros_troquel" value="<?php echo $numero_tiros_troquel ?>">
                                  <label for="numero_tiros_troquel">N° Tiros Troquel</label>
                                </div>
                              </div>
                              <div class="col m3 s6">
                                <input type="checkbox" class="filled-in" name="cobra_planchas"
                                id="cobra_planchas"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                                <label for="cobra_planchas">¿Cobra Planchas? </label>
                              </div>
                              <div class="col m3 s6">
                                <input type="checkbox" class="filled-in" name="troquelado"
                                id="troquelado"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                                <label for="troquelado">Troquelado </label>
                              </div>
                              <div class="col m3 s6">
                                <input type="checkbox" class="filled-in" name="impresion"
                                id="impresion"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                                <label for="impresion">Impresión </label>
                              </div>
                              <div class="col m3 s6">
                                <input type="checkbox" class="filled-in" name="escaja"
                                id="escaja"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                                <label for="escaja">¿Es Caja? </label>
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
                              id="boceto"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="boceto">Boceto </label>
                              <input type="checkbox" class="filled-in" name="ser_arte_final"
                              id="ser_arte_final"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="ser_arte_final">Arte Final</label>
                              <input type="checkbox" class="filled-in" name="seleccion"
                              id="seleccion"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="seleccion">Selección</label>
                              <input type="checkbox" class="filled-in" name="clises"
                              id="clises"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="clises">Clises</label>
                              <div class = "input-field">
                                <input type="text" name="numero_copias" id="numero_copias" value="<?php echo $numero_copias ?>">
                                <label for="numero_copias">N° Copias Laser</label>
                              </div>
                            </div>
                            <div class="col m2 s6">
                              <h6><center><b>Pruebas</b></center></h6>
                              <input type="checkbox" class="filled-in" name="prueba_laser"
                              id="prueba_laser"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="prueba_laser">Laser </label>
                              <br><br>
                              <input type="checkbox" class="filled-in" name="prueba_impresora"
                              id="prueba_impresora"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="prueba_impresora">Impresora</label>
                            </div>
                            <div class="col m2 s6">
                              <h6><center><b>Encolado</b></center></h6>
                              <input type="checkbox" class="filled-in" name="cabeza"
                              id="cabeza"  <?php  in_array($codigo, $array)? print 'checked':''?> <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="cabeza">Cabeza </label>
                              <input type="checkbox" class="filled-in" name="pie"
                              id="pie"  <?php  in_array($codigo, $array)? print 'checked':''?> <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="pie">Pie</label>
                              <input type="checkbox" class="filled-in" name="izquierdo"
                              id="izquierdo"  <?php  in_array($codigo, $array)? print 'checked':''?> <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="izquierdo">L. Izquierdo</label>
                              <input type="checkbox" class="filled-in" name="derecho"
                              id="derecho"  <?php  in_array($codigo, $array)? print 'checked':''?> <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="derecho">L. Derecho</label>
                              <div class = "input-field">
                                <input type="text" name="numero_encolados" id="numero_encolados" value="<?php echo $numero_encolados ?>">
                                <label for="numero_encolados">N° Encolados</label>
                              </div>
                            </div>
                            <div class="col m3 s6">
                              <h6><center><b>Acabados</b></center></h6>
                              <input type="checkbox" class="filled-in" name="carbon_intercalado"
                              id="carbon_intercalado"  <?php  in_array($codigo, $array)? print 'checked':''?> <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="carbon_intercalado">Carbón Intercalado </label>
                              <input type="checkbox" class="filled-in" name="coleccionado"
                              id="coleccionado"  <?php  in_array($codigo, $array)? print 'checked':''?> <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="coleccionado">Coleccionado</label>
                              <input type="checkbox" class="filled-in" name="abrir_sobres"
                              id="abrir_sobres"  <?php  in_array($codigo, $array)? print 'checked':''?> <?php  in_array($codigo, $array)? print 'checked':''?>/>
                              <label for="abrir_sobres">AbrirSobres</label>
                              <div class = "input-field">
                                <input type="text" name="numero_dobleces" id="numero_dobleces" value="<?php echo $numero_dobleces ?>">
                                <label for="numero_dobleces">N° Dobleces</label>
                              </div>
                            </div>
                            <div class="col m3 s6">
                                <h6><center><b>Tipo Safado</b></center></h6>
                                <input type="radio" class="with-gap" name="tipo_safado"
                                id="libros" <?php $accion == 'Actualizar'? $tipo_safado == '1'? print 'checked':'' : print 'checked'; ?> value="1"/>
                                <label for="libros">Por Libros</label>
                                <input type="radio" class="with-gap" name="tipo_safado"
                                id="juegos" <?php $tipo_safado == '2'? print 'checked':''; ?> value="2"/>
                                <label for="juegos">Por Juegos</label>
                                <h6><center><b>Control Calidad</b></center></h6>
                                <input type="radio" class="with-gap" name="control_calidad"
                                id="militar" <?php $accion == 'Actualizar'? $control_calidad == '1'? print 'checked':'' : print 'checked'; ?> value="1"/>
                                <label for="militar">Militar</label>
                                <input type="radio" class="with-gap" name="control_calidad"
                                id="individual" <?php $control_calidad == '4'? print 'checked':''; ?> value="2"/>
                                <label for="individual">Individual</label>
                                <div class = "input-field">
                                  <input type="text" name="numero_grupos" id="numero_grupos" value="<?php echo $numero_grupos ?>">
                                  <label for="numero_grupos">N° grupos</label>
                                </div>
                            </div>
                            <div class="col m2 s2">
                                <h6><center><b>Pegado de Cajas</b></center></h6>
                                <input type="checkbox" class="filled-in" name="pegar_cajas"
                                id="pegar_cajas"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                                <label for="pegar_cajas">Pegar?</label>
                                <div class = "input-field">
                                  <input type="text" name="tipo_caja" id="tipo_caja" value="<?php echo $tipo_caja ?>">
                                  <label for="tipo_caja">Tipo Caja</label>
                                </div>
                            </div>
                            <div class="col m5 s2">
                                <h6><center><b>Acabados </b></center></h6>
                                <div class="row">
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_remaches" id="numero_remaches" value="<?php echo $numero_remaches ?>">
                                      <label for="numero_remaches">N° Remaches</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_grapas_libro" id="numero_grapas_libro" value="<?php echo $numero_grapas_libro ?>">
                                      <label for="numero_grapas_libro">N° Grapas Libro</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_grapas_huecos" id="numero_grapas_huecos" value="<?php echo $numero_grapas_huecos ?>">
                                      <label for="numero_grapas_huecos">N° Grapas Huecos</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_huecos" id="numero_huecos" value="<?php echo $numero_huecos ?>">
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
                                      <input type="text" name="numero_fajillas" id="numero_fajillas" value="<?php echo $numero_fajillas ?>">
                                      <label for="numero_fajillas">N° Fajillas</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_cajas" id="numero_cajas" value="<?php echo $numero_cajas ?>">
                                      <label for="numero_cajas">N° Cajas</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="numero_paquetes" id="numero_paquetes" value="<?php echo $numero_paquetes ?>">
                                      <label for="numero_paquetes">N° Paquetes</label>
                                    </div>
                                  </div>
                                  <div class="col m6 s12">
                                    <div class = "input-field">
                                      <input type="text" name="cantidad_x_paquete" id="cantidad_x_paquete" value="<?php echo $cantidad_x_paquete ?>">
                                      <label for="cantidad_x_paquete">Cantidad X Paquete</label>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="dvnegativos col s6">
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Negativos</span>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="cantidad_negativos" id="cantidad_negativos" value="<?php echo $cantidad_negativos ?>">
                                <label for="cantidad_negativos">Cantidad</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <select id="tipo_negativo" name="tipo_negativo">
                              <?php if ($accion == 'Actualizar'): ?>
                                <option value="<?php echo $tipo_negativo ?>" selected ><?php echo tipo_negativo($tipo_negativo) ?></option>
                              <?php else: ?>
                                <option value="" selected disabled>TIPO NEGATIVO</option>
                              <?php endif; ?>
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
                              <input type="number" name="tamano_negativo_ancho" id="tamano_negativo_ancho" value="<?php echo $tamano_negativo_ancho ?>">
                              <label for="tamano_negativo_ancho">Ancho</label>
                            </div>
                          </div>
                          <div class="col s12 m4">
                            <div class = "input-field">
                              <input type="number" name="tamano_negativo_alto" id="tamano_negativo_alto" value="<?php echo $tamano_negativo_alto ?>">
                              <label for="tamano_negativo_alto">Alto</label>
                            </div>
                          </div>
                          <div class="col s12 m4">
                            <br>
                            <input type="checkbox" class="filled-in" name="cobra_negativo"
                            id="cobra_negativo"  <?php  in_array($codigo, $array)? print 'checked':''?>/>
                            <label for="cobra_negativo">¿Cobra?</label>
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
                                <input type="text" name="costo_servicio" id="costo_servicio" value="0">
                                <label for="costo_servicio">Costo</label>
                              </div>
                            </div>
                            <div class="col m1 s2">
                              <br>
                              <br>
                              <a style="cursor: pointer;" onclick="add_tercero()"><i class="material-icons">add </i></a>
                            </div>
                            <div id="lstterceros" class="col s12 m8">
                              <h6><center><b>Servicios</b></center></h6>
                              <ul class="collection small">
                                <?php
                                $tercero = new TercerosControlador();
                                if ($accion == 'Actualizar'){
                                  $terceroactiva = 'active';
                                  foreach ($tercero->getLista_terceros_Cotizacion($con, $compania, $cotizacion) as $key => $value){ ?>
                                    <li id="tercero_<?php echo $value->id?>"  class="listaterceros collection-item"><div><?php echo $value->descripcion?> ===>> <?php echo $value->monto?><a id="<?php echo $value->id?>" class="eliminar_tercero secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
                                    <?php $log->info('Tercero: '.$value->descripcion);
                                    $terceroactiva = '';
                                  } ?>
                                  <input type="hidden" id ="arrterceros" name="arrterceros" value ="<?php echo $tercero->getListaterceros()?>">
                                <?php } ?>
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
                                <input type="text" name="material_extra" id="material_extra" value="<?php echo $material_extra ?>">
                                <label for="material_extra">Material</label>
                              </div>
                              <div class = "input-field">
                                <input type="text" name="cantidad_material" id="cantidad_material" value="<?php echo $cantidad_material ?>">
                                <label for="cantidad_material">cantidad</label>
                              </div>
                            </div>
                            <div class="col m1 s2">
                              <br>
                              <br>
                              <a style="cursor: pointer;" onclick="add_extra()"><i class="material-icons">add </i></a>
                            </div>
                            <div id="lstextras" class="col s12 m8">
                              <h6><center><b>Material Extra</b></center></h6>
                              <ul class="collection small">
                                <?php
                                $extra = new ExtraControlador();
                                if ($accion == 'Actualizar'){
                                  $extraactiva = 'active';
                                  foreach ($extra->getLista_Extras_Cotizacion($con, $compania, $cotizacion) as $key => $value){ ?>
                                    <li id="extras_<?php echo $value->id?>"  class="listaextras collection-item"><div><?php echo $value->cantidad ?> ===>> <?php echo  $value->descripcion ?><a id="<?php echo $value->id?>" class="eliminar_extra secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
                                    <?php $log->info('Extras: '.$value->descripcion);
                                    $extraactiva = '';
                                  } ?>
                                  <input type="hidden" id ="arrextras" name="arrextras" value ="<?php echo $extra->getListaextras()?>">
                                <?php } ?>
                                  </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col s12"><!--S12 Porque se ocultó negativos-->
                        <div class="card small blue-grey lighten-5">
                          <div class="card-content">
                            <span class="card-title">Operaciones Extras</span>
                            <div class="col s12 m6">
                              <h6><center><b>Extras</b></center></h6>
                              <ul class="collection small">
                                <?php $operacion = new OperacionControlador();
                                 foreach ($operacion->getLista_Operaciones($con, $compania, 5) as $ope){?>
                                  <li id="<?php echo $ope[1]?>" class="collection-item" data-costoxcentesima = "<?php echo $ope[3]?>" ><div><?php echo $ope[2]?> <a class="agregar-operacion secondary-content" id = "<?php echo $ope[1]?>"><i class="material-icons">add</i></a></div> </li>
                                <?php } ?>
                              </ul>
                            </div>

                            <div id="lstoperaciones" class="col s12 m6">
                              <h6><center><b>Extras Asignadas</b></center></h6>
                              <ul class="collection small">
                                <?php
                                $operacion = new OperacionControlador();
                                if ($accion == 'Actualizar'){
                                  foreach ($operacion->getLista_Operaciones_Cotizacion($con, $compania, $cotizacion) as $key => $value){ ?>
                                    <li id="operacion_<?php echo $value->id?>"  class="listaoperaciones collection-item"><div><?php echo  $value->descripcion ?><a id="<?php echo $value->id?>" class="eliminar_operacion secondary-content"><i class="material-icons red-text">remove</i></a></div> </li>
                                    <?php $log->info('Operacion: '.$value->descripcion);
                                    $extraactiva = '';
                                  } ?>
                                  <input type="hidden" id="arroperacion" name="arroperacion" value ="<?php echo $operacion->getListaOperaciones()?>">
                                <?php } ?>

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
                                <input type="number" name="est_m_obra" id="est_m_obra" value="<?php echo $est_m_obra ?>">
                                <label for="est_m_obra">Mano de Obra</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_o_materiales" id="est_o_materiales" value="<?php echo $est_o_materiales ?>">
                                <label for="est_o_materiales">Otros Materiales</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_tintas" id="est_tintas" value="<?php echo $est_tintas ?>">
                                <label for="est_tintas">Tintas</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_indirectos" id="est_indirectos" value="<?php echo $est_indirectos ?>">
                                <label for="est_indirectos">Indirectos</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_servicios_terceros" id="est_servicios_terceros" value="<?php echo $est_servicios_terceros ?>">
                                <label for="est_servicios_terceros">Servicios Terceros</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_costo_subtotal" id="est_costo_subtotal" value="<?php echo $est_costo_subtotal ?>">
                                <label for="est_costo_subtotal">Costo Subtotal</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_papeles" id="est_papeles" value="<?php echo $est_papeles ?>">
                                <label for="est_papeles">Papeles</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_costo_total" id="est_costo_total" value="<?php echo $est_costo_total ?>">
                                <label for="est_costo_total">Costo Total</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <h6><center><b>Utilidad</b></center></h6>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_p_util_costo" id="est_p_util_costo" value="<?php echo $est_p_util_costo ?>">
                                <label for="est_p_util_costo">Porcentaje</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_util_costo" id="est_util_costo" value="<?php echo $est_util_costo ?>">
                                <label for="est_util_costo">Costo</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_p_util_papel" id="est_p_util_papel" value="<?php echo $est_p_util_papel ?>">
                                <label for="est_p_util_papel">Porcentaje</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_util_papel" id="est_util_papel" value="<?php echo $est_util_papel ?>">
                                <label for="est_util_papel">Papel</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_p_util_publicidad" id="est_p_util_publicidad" value="<?php echo $est_p_util_publicidad ?>">
                                <label for="est_p_util_publicidad">Porcentaje</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="est_util_publicidad" id="est_util_publicidad" value="<?php echo $est_util_publicidad ?>">
                                <label for="est_util_publicidad">Publicidad</label>
                              </div>
                            </div>
                            <div class="col s12">
                              <div class = "input-field">
                                <input type="number" name="est_precio_cliente" id="est_precio_cliente" value="<?php echo $est_precio_cliente ?>">
                                <label for="est_precio_cliente">Precio al Cliente</label>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                      <div class="col m6 s12">
                        <div class="card xx-large blue-grey lighten-5">
                          <div class="
                          card-content">
                            <span class="card-title">Costos Reales</span>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="real_m_obra" id="real_m_obra" value="<?php echo $real_m_obra ?>">
                                <label for="real_m_obra">Mano de Obra</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="real_o_materiales" id="real_o_materiales" value="<?php echo $real_o_materiales ?>">
                                <label for="real_o_materiales">Otros Materiales</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="real_tintas" id="real_tintas" value="<?php echo $real_tintas ?>">
                                <label for="real_tintas">Tintas</label>
                              </div>
                            </div>
                            <div class="col s12 m6">
                              <div class = "input-field">
                                <input type="number" name="real_indirectos" id="real_indirectos" value="<?php echo $real_indirectos ?>">
                                <label for="real_indirectos">Indirectos</label>
                              </div>
                          </div>
                          <div class="col s12 m6">
                            <div class = "input-field">
                              <input type="number" name="real_servicios_terceros" id="real_servicios_terceros" value="<?php echo $real_servicios_terceros ?>">
                              <label for="real_servicios_terceros">Servicios Terceros</label>
                            </div>
                          </div>
                          <div class="col s12 m6">
                            <div class = "input-field">
                              <input type="number" name="real_costo_subtotal" id="real_costo_subtotal" value="<?php echo $real_costo_subtotal ?>">
                              <label for="real_costo_subtotal">Costo Subtotal</label>
                            </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_papeles" id="real_papeles" value="<?php echo $real_papeles ?>">
                            <label for="real_papeles">Papeles</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_costo_total" id="real_costo_total" value="<?php echo $real_costo_total ?>">
                            <label for="real_costo_total">Costo Total</label>
                          </div>
                        </div>
                        <div class="col s12">
                          <h6><center><b>Utilidad</b></center></h6>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_p_util_costo" id="real_p_util_costo" value="<?php echo $real_p_util_costo ?>">
                            <label for="real_p_util_costo">Porcentaje</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_util_costo" id="real_util_costo" value="<?php echo $real_util_costo ?>">
                            <label for="real_util_costo">Costo</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_p_util_papel" id="real_p_util_papel" value="<?php echo $real_p_util_papel ?>">
                            <label for="real_p_util_papel">Porcentaje</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_util_papel" id="real_util_papel" value="<?php echo $real_util_papel ?>">
                            <label for="real_util_papel">Papel</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_p_util_publicidad" id="real_p_util_publicidad" value="<?php echo $real_p_util_publicidad ?>">
                            <label for="real_p_util_publicidad">Porcentaje</label>
                          </div>
                        </div>
                        <div class="col s12 m6">
                          <div class = "input-field">
                            <input type="number" name="real_util_publicidad" id="real_util_publicidad" value="<?php echo $real_util_publicidad ?>">
                            <label for="real_util_publicidad">Publicidad</label>
                          </div>
                        </div>
                        <div class="col s12">
                          <div class = "input-field">
                            <input type="number" name="real_precio_cliente" id="real_precio_cliente" value="<?php echo $real_precio_cliente ?>">
                            <label for="real_precio_cliente">Precio al Cliente</label>
                          </div>
                        </div>
                       </div>
                      </div>
                      </div>
                    <center><button type="reset" onclick="window.location='calculos.php'" enabled class="btn green">Calcular</button></center>
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
            </div>
            </center>
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
  });
</script>
<script src="../js/tintas.js"></script>
<script src="../js/maquinas.js"></script>
<script src="../js/papeles_calcular.js"></script>
<script src="../js/papeles.js"></script>
<script src="../js/global.js"></script>
<script src="../js/distribuciones.js"></script>
<script src="../js/terceros.js"></script>
<script src="../js/extras.js"></script>
<script src="../js/operaciones.js"></script>
</script>
</body>
</html>
