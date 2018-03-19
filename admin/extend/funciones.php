<?php
function tipo_desc($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_desc = 'PAPELES';
      break;
    case '2':
      $tipo_desc = 'SUMINISTROS';
      break;
    case '3':
      $tipo_desc = 'REPUESTOS';
      break;
    case '4':
      $tipo_desc = 'OTROS';
      break;
  }
  return $tipo_desc;
}
function tipo_trans($tipo)
{
  switch ($tipo) {
    case '1':
      $tipo_trans = 'ENTRADA';
      break;
    case '2':
      $tipo_trans = 'SALIDA';
      break;
  }
  return $tipo_trans;
}
 ?>
