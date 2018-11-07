<?php
/**********************************************************************;
* Project           : SAIL
* Class Name        : PapelCotizacion
* Author            : Mauricio
* Date created      : 2018-08-22
* Purpose           : Manipular los datos de los pqpeles por cotización
                      entre la vista y la DB
* Revision History  :
* Date        Author      Ref    Revision (Date in YYYY-MM-DD format)
* yyyy-MM-dd    xxxx      1      ...
*|*********************************************************************/
include '../entidades/papelcotizacion.php';
class PapelControlador{
  public $error = '';
  public $listapapeles;
  function __construct(){
    $this->listapapeles='';
  }
  public function getError(){
    return $this->$error;
  }
  public function getListaPapeles(){
    return $this->listapapeles;
  }
  public function getLista_Papeles($con, $compania){
    $sel = $con->prepare('SELECT id, codigo, descripcion FROM inventario WHERE id_compania = ? AND tipo = 1');
    $sel->bind_param("s", $compania);
    $sel->execute();
    $sel->bind_result($id, $codigo, $descripcion);
    $arrpapel = array();
    while ($sel->fetch()) {
      $arrpapeles[]= array($id, $codigo, $descripcion);//($arrtintas, $id_tinta,$descripcion_tinta);
    }
    $sel->close();
    return $arrpapel;
  }
  public function getCodigoPapel($con, $compania, $descripcion){
    $cod=0;
    $sel = $con->prepare('SELECT codigo FROM inventario WHERE id_compania = ? AND descripcion = ? AND tipo = 1');
    $sel->bind_param("ss", $compania, $maquina);
    $sel->execute();
    $sel->bind_result($codigo);

    if ($sel->fetch()) {
      $cod =$codigo;
    }

    $sel->close();
    return $cod;
  }
  public function getNombrePapel($con, $compania, $codigo){
    $nom='';
    $sel = $con->prepare('SELECT descripcion FROM inventario WHERE id_compania = ? AND codigo = ? AND tipo = 1');
    $sel->bind_param("ss", $compania, $codigo);
    $sel->execute();
    $sel->bind_result($nombre);

    if ($sel->fetch()) {
      $nom =$nombre;
    }

    $sel->close();
    return $nom;
  }
  public function insPapel_Cotizacion($con, $arrpapel, $compania, $id){
    try {
      $inserto= false;
      $del =$con ->prepare('DELETE FROM cotizacion_papel WHERE id_compania =? AND id_cotizacion = ? ');
      $del -> bind_param('si', $compania, $id);
      $del -> execute();
      $del -> close();
      foreach (explode("*;*", $arrpapel) as $key => $value) {
        $variable= array();
        $variable[] = $compania;
        $variable[] = $id;
        foreach (explode("*,*", $value) as $subkey => $subvalue) {
          $variable[] = $subvalue;
          }

        $ins_cot_pap = $con->prepare("INSERT INTO cotizacion_papel(id_compania, id_cotizacion, papel,numero_hojas,
          numero_moldes, numero_tintas, numero_tamanos, numero_pliegos, numero_grupos, numero_cort_grupo,
        ancho_tamano_pliego, alto_tamano_pliego, ancho_tamano_corte, alto_tamano_corte, ancho_corte_final, alto_corte_final)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $ins_cot_pap -> bind_param('sisiiiiiiiiiiiii', $variable[0], $variable[1], $variable[2], $variable[3], $variable[4], $variable[5],
         $variable[6], $variable[7], $variable[8], $variable[9], $variable[10], $variable[11], $variable[12], $variable[13], $variable[14], $variable[15]);
        if($ins_cot_pap -> execute())
        {
          $inserto= true;
        }
        if ($ins_cot_pap->error!=''){
          $this->error= $ins_cot_desc->error;
        }
        $ins_cot_pap ->close();
      }
      return $inserto;
    } catch (\Exception $e) {
        throw new \Exception("Error Processing Request".$e, 1);

    }
  }
  public function getLista_Papel_Cotizacion($con, $compania, $cotizacion){
    $sel = $con->prepare(" SELECT cp.id, p.descripcion, papel, numero_hojas, numero_moldes, numero_tintas,
      numero_tamanos, numero_pliegos, numero_grupos, numero_cort_grupo, ancho_tamano_pliego, alto_tamano_pliego,
      ancho_tamano_corte, alto_tamano_corte, ancho_corte_final, alto_corte_final FROM cotizacion_papel cp
      INNER JOIN inventario p ON (p.codigo=cp.papel) WHERE cp.id_compania =? AND cp.id_cotizacion = ? AND p.tipo = 1 ");
    $sel->bind_param("si", $compania, $cotizacion);
    $sel->execute();
    $sel->bind_result($id, $descripcion, $papel, $numero_hojas,  $numero_moldes, $numero_tintas,
      $numero_tamanos, $numero_pliegos, $numero_grupos, $numero_cort_grupo, $ancho_tamano_pliego,
      $alto_tamano_pliego, $ancho_tamano_corte, $alto_tamano_corte, $ancho_corte_final, $alto_corte_final);
    $arrpapeles_cotizacion = array();
    while ($sel->fetch()) {
      $papelcotizacion = new PapelCotizacion($cotizacion,$id,
            $papel,$numero_hojas,$numero_moldes,$numero_tintas,$numero_tamanos,
            $numero_pliegos,$numero_grupos,$numero_cort_grupo, $ancho_tamano_pliego, $alto_tamano_pliego,
            $ancho_tamano_corte, $alto_tamano_corte, $ancho_corte_final, $alto_corte_final);
      $arrpapeles_cotizacion[]= $papelcotizacion;
      $this->listapapeles= $this->listapapeles==''?$papel.'*,*'.$numero_hojas.'*,*'.$numero_moldes.'*,*'.$numero_tintas.'*,*'.
        $numero_tamanos.'*,*'.$numero_pliegos.'*,*'. $numero_grupos.'*,*'.$numero_cort_grupo.'*,*'.$ancho_tamano_pliego.'*,*'.$alto_tamano_pliego
        .'*,*'.$ancho_tamano_corte.'*,*'.$alto_tamano_corte.'*,*'.$ancho_corte_final.'*,*'.$alto_corte_final:
      $this->listapapeles.'*;*'.$papel.'*,*'.$numero_hojas.'*,*'.$numero_moldes.'*,*'.$numero_tintas.'*,*'.
        $numero_tamanos.'*,*'.$numero_pliegos.'*,*'. $numero_grupos.'*,*'.$numero_cort_grupo.'*,*'.$ancho_tamano_pliego.'*,*'.$alto_tamano_pliego
        .'*,*'.$ancho_tamano_corte.'*,*'.$alto_tamano_corte.'*,*'.$ancho_corte_final.'*,*'.$alto_corte_final;
    }
    $sel->close();
    return $arrpapeles_cotizacion;
  }
}

 ?>
