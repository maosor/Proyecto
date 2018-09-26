<?php
include '../conexion/conexion.php';
include '../logic/tinta_controlador.php';
include '../logic/maquina_controlador.php';
include '../logic/papel_controlador.php';
include '../logic/distribucion_controlador.php';
include '../logic/terceros_controlador.php';
include '../logic/extra_controlador.php';
include '../logic/operacion_controlador.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $campo => $valor) {
    $variable = "$" . $campo. "='" . htmlentities($valor). "';";
    eval($variable);
  }
/*  $selected_radio= $_POST['tamano_trabajo'];
  if ($selected_radio == 'pequeno') {
			$pequeno_status = 'checked';
      $log->info('Chequeado pequeño');
	   }
		else if ($selected_radio == 'mediano') {
			$mediano_status = 'checked';
      $log->info('Chequeado mediano');
		}
    else if ($selected_radio == 'gramde') {
			$grande_status = 'checked';
      $log->info('Chequeado grande');
		}
    */
  $compania = $_SESSION ['compania'];
  $con-> begin_transaction();
  try{
    $up = $con->prepare(" UPDATE cotizacion SET orden_trabajo=?,orden_compra=?,fecha_pedido=?,id_cliente=?,referencia=?,id_trabajo=?,
      recibido=?,sobre_tecnico=?,negativo=?,plancha=?,recurso=?,libros_articulos=?,hojas=?,copias=?,inicio=?,final=?
     WHERE id=? AND id_compania=? ");
    $up->bind_param("iisiiiiiiiiiiiiiii", $orden_trabajo, $orden_compra, $fecha_pedido, $id_cliente, $referencia, $id_trabajo, $recibido, $sobre_tecnico,
    $negativo, $plancha, $recurso, $libros_articulos, $hojas, $copias, $inicio, $final, $id, $compania );
    if($up == false)
    {
      throw new \Exception("Error Processing Request", 1);
    }
    if ($up->execute()) {
      $up_det = $con->prepare(" UPDATE cotizacion_detalle
      SET tamano_trabajo = ?,forma_trabajo = ?,lados_imprimir = ?,modo_retiro = ?,molde_alto = ?,molde_ancho = ?,
      area_levantado_ancho = ?,area_levantado_alto = ?,observacion_retiro = ?,num_troquel = ?,estado_inicial = ?,
      estado_final = ?,medio_corte = ?,tamano_troquel_alto = ?,tamano_troquel_ancho = ?,negativo_frente = ?,
      negativo_reverso = ?,arte_frente = ?,arte_reverso = ?,tamano_montaje = ?,lado_montaje = ?,complejidad_montaje = ?,
      detalles = ?,tintas_prep = ?,tipo_tinta = ?,gramos_tinta = ?,donde_imprimir = ?,numero_hojas = ?,
      numero_moldes = ?,numero_tintas = ?,numero_tamanos = ?,numero_pliegos = ?,numero_grupos = ?,numero_cort_grupo = ?,
      numero_refiles = ?,perforas_c = ?,perforas_p = ?,perforas_i = ?,perforas_d = ?,huecos_c = ?,huecos_p = ?,
      huecos_i = ?,huecos_d = ?,papeles_numero_copias = ?,papeles_numero_hojas = ?,numero_tintas_montajes = ?,
      numero_tintas_lavados = ?,papeles_numero_moldes = ?,numero_mascaras = ?,numero_planchas = ?,numero_quemados = ?,
      numero_med_cortes = ?,numero_tiros_impresos = ?,numero_tiros_troquel = ?,cobra_planchas = ?,troquelado = ?,impresion = ?,
      cantidad_negativos = ?,tipo_negativo = ?,tamano_negativo_alto = ?,tamano_negativo_ancho = ?,cobra_negativo = ?,
      material_extra = ?,cantidad_x_paquete = ?,tipo_caja = ?,cantidad_material = ?,numero_copias = ?,numero_cajas = ?,
      numero_dobleces = ?,numero_encolados = ?,numero_fajillas = ?,numero_grapas_huecos = ?,numero_grapas_libro = ?,
      numero_huecos = ?,numero_paquetes = ?,numero_remaches = ?,est_m_obra = ?,est_o_materiales = ?,est_tintas = ?,
      est_indirectos = ?,est_servicios_terceros = ?,est_costo_subtotal = ?,est_papeles = ?,est_costo_total = ?,est_p_util_costo = ?,
      est_util_costo = ?,est_p_util_papel = ?,est_util_papel = ?,est_p_util_publicidad = ?,est_util_publicidad = ?,est_precio_cliente = ?,
      real_m_obra = ?,real_o_materiales = ?,real_tintas = ?,real_indirectos = ?,real_servicios_terceros = ?,real_costo_subtotal = ?,
      real_papeles = ?,real_costo_total = ?,real_p_util_costo = ?,real_util_costo = ?,real_p_util_papel = ?,real_util_papel = ?,
      real_p_util_publicidad = ?,real_util_publicidad = ?,real_precio_cliente = ?, control_calidad = ?, tipo_safado = ? WHERE cotizacion = ?");
      $up_det->bind_param('iiiiiiiisiiiiiiiiiiisssiidiiiiiiiiissssssssiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiddddddddddddddddddddddddddddddiii',
        $tamano_trabajo, $forma_trabajo, $lados_imprimir, $modo_retiro, $molde_alto,
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
        $real_util_publicidad, $real_precio_cliente,$control_calidad, $tipo_safado, $cotizacion);
        if ($up_det->execute()){
          $del_lstck =$con ->prepare('DELETE FROM cotizacion_lista_check WHERE id_compania= ? AND cotizacion= ? ');
          $del_lstck -> bind_param('si', $compania, $cotizacion);
          $del_lstck -> execute();
          $del_lstck -> close();
          $sel_lstck = $con->prepare('SELECT id, codigo, descripcion FROM lista_check WHERE id_compania=? AND grupo =6');
          $sel_lstck -> bind_param('s', $compania);
          $sel_lstck -> execute();
          $sel_lstck -> bind_result($id, $codigo, $descripcion);
          $array = array();
          while ($sel_lstck-> fetch()){
            $array[]= $codigo;
          }
          $array[] = 'cobra_planchas';  $array[] = 'troquelado'; $array[] = 'impresion'; $array[] = 'boceto';
          $array[] = 'ser_arte_final';  $array[] = 'seleccion'; $array[] = 'clises'; $array[] = 'prueba_laser';
          $array[] = 'prueba_impresora'; $array[] = 'cabeza'; $array[] = 'pie'; $array[] = 'izquierdo';
          $array[] = 'derecho'; $array[] = 'carbon_intercalado'; $array[] = 'coleccionado';
          $array[] = 'abrir_sobres'; $array[] = 'pegar_cajas';
          $sel_lstck-> close();
          foreach ($array as $key => $value) {
            if(isset($_POST[$value])){
              $ins_lstck =$con ->prepare('INSERT INTO cotizacion_lista_check(id_compania, cotizacion, codigo) VALUES (?,?,?) ');
              $ins_lstck -> bind_param('iis', $compania, $cotizacion, $value);
              $ins_lstck -> execute();
              $ins_lstck -> close();
              //$log->info('Editó lista check #'.$cotizacion);
              }
          }
          $papel = new PapelControlador();
          if($papel->insPapel_Cotizacion($con, $arrpapel, $compania, $cotizacion)){
            $log->info('Agregó colores de #'.$cotizacion);
          }else {
             $log->error('No se agregó colores de #'.$cotizacion.'\n'.$papel->getError());
          }
          $distribucion = new DistribucionControlador();
          if($distribucion->insdistribucion_Cotizacion($con, $arrdistribucion, $compania, $cotizacion)){
            $log->info('Agregó distribucion de #'.$cotizacion);
          }else {
             $log->error('No se agregó distribucion de #'.$cotizacion.'\n'.$distribucion->getError());
          }
         $tintas = new TintaControlador();
         if($tintas->insTinta_Cotizacion($con, $arrcolores, $compania, $cotizacion)){
           $log->info('Agregó colores de #'.$cotizacion);
         }else {
            $log->error('No se agregó colores de #'.$cotizacion.'\n'.$tintas->getError());
         }
         $maquinas = new MaquinaControlador();
         if($maquinas->insMaquina_Cotizacion($con, $arrmaquina, $compania, $cotizacion)){
           $log->info('Agregó maquinas de #'.$cotizacion);
         }else {
            $log->error('No se agregó maquinas de #'.$cotizacion.'\n'.$maquinas->getError().$arrmaquina);
         }
         $terceros = new TercerosControlador();
         if($terceros->insTercero_Cotizacion($con, $arrterceros, $compania, $cotizacion)){
           $log->info('Agregó terceros de #'.$cotizacion);
         }else {
            $log->error('No se agregó terceros de #'.$cotizacion.'\n'.$terceros->getError().$arrterceros);
         }
         $extras = new ExtraControlador();
         if($extras->insExtra_Cotizacion($con, $arrextras, $compania, $cotizacion)){
           $log->info('Agregó extras de #'.$cotizacion);
         }else {
            $log->error('No se agregó extras de #'.$cotizacion.'\n'.$extras->getError().$arrextras);
         }
         $operaciones = new OperacionControlador();
         if($operaciones->insOperacion_Cotizacion($con, $arroperacion, $compania, $cotizacion)){
           $log->info('Agregó operacion de #'.$cotizacion);
         }else {
            $log->error('No se agregó operacion de #'.$cotizacion.'\n'.$operaciones->getError().$arroperacion);
         }

        header('location:../extend/alerta.php?msj=Guardó cotización&c=cot&p=in&t=success');
      }else {
        $log->error('Error guardando detalle cotización: '.$up_det->error);
        header('location:../extend/alerta.php?msj=Editó cotización&c=cot&p=in&t=success');
      }
    }else{
      $log->error('Error guardando cotización: '.$up->error);
      header('location:../extend/alerta.php?msj=No editó la cotización&c=cot&p=in&t=error');
    }
    $con->commit();
    $up->close();
    $con->close();
}
catch(Exception $e)
{
  try{
    $con->rollback();
  }catch(mysqli_sql_exception $ex)
  {
    if($con != null)
    {
      $log->info('Una excepcion de tipo #'.$ex->getCode.':'.$ex->errorMessage().'\n haciendo rollback') ;
    }
  }
  $log->info('Una excepcion de tipo #'.$e->getCode().':'.$e->getMessage().'\n tratando de insertar los datos') ;
  header('location:../extend/alerta.php?msj=Error tratando de insertar los datos&c=cot&p=in&t=error');
}finally
{
  $con->close();
}
}else {
    $log->error('Error intentando ingresar sin formulario desde: '.gethostbyname(trim(`hostname`)));
    header('location:../extend/alerta.php?msj=Utiliza el formulario&c=cot&p=in&t=error');
}

 ?>
